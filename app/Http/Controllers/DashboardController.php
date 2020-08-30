<?php

namespace App\Http\Controllers;

use App\Mail\ReminderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Mail;
use App\Document;
use App\ServiceType;
use App\Unit;
use App\Department;
use DB;

class DashboardController extends Controller
{
    public function index(){
        $units = Unit::all();
        $departments = Department::all();
        $service_types = ServiceType::all();

        $documents = DB::table('documents')
            ->leftJoin('units', 'units.id', '=', 'documents.unit_id')
            ->leftJoin('departments', 'departments.id', '=', 'documents.department_id')
            ->leftJoin('service_types', 'service_types.id', '=', 'documents.service_type_id')
            ->leftJoin("users",function($join){
                $join->on("users.unit_id","=","documents.unit_id")
                    ->on("users.department_id","=","documents.department_id");
            })
            ->select('documents.*', 'units.name as unit', 'departments.name as department', 'service_types.name as service_type', 'users.email as user_email')
            ->paginate(10);

        return view('dashboard.index')
            ->with('documents', $documents)
            ->with('units', $units)
            ->with('departments', $departments)
            ->with('service_types', $service_types);
    }

    public function getFilteredDocuments(Request $request){
        $item_name = $request->item_name;
        $unit = $request->unit;
        $department = $request->department;
        $service_type = $request->service_type;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $where = '';

        if($item_name != ''){
            $where .= " AND documents.item_name LIKE '%$item_name%'";
        }

        if($unit != ''){
            $where .= " AND documents.unit_id=$unit";
        }

        if($department != ''){
            $where .= " AND documents.department_id=$department";
        }

        if($service_type != ''){
            $where .= " AND documents.service_type_id=$service_type";
        }

        if($from_date != '' && $to_date != ''){
            $where .= " AND documents.next_renewal_date between '$from_date' AND '$to_date'";
        }

        $documents = DB::select( "SELECT documents.*, units.name as unit, departments.name as department, 
                                  service_types.name as service_type, users.email as user_email
                                  FROM documents 
                                  LEFT JOIN units 
                                  ON units.id=documents.unit_id
                                  LEFT JOIN
                                  departments
                                  ON departments.id=documents.department_id
                                  LEFT JOIN 
                                  service_types
                                  ON service_types.id=documents.service_type_id
                                  LEFT JOIN 
                                  users
                                  ON users.unit_id=documents.unit_id AND users.department_id=documents.department_id
                                  WHERE 1 $where" );

        return \GuzzleHttp\json_encode($documents);
    }

    public function renewReminderMail(){
        $super_admins = DB::select( "SELECT * FROM users
                                  WHERE 1 AND unit_id = 0 AND email != 'saiful.amin@interfabshirt.com'" );


        $documents = DB::select( "SELECT documents.*, units.name as unit, departments.name as department,
                                  service_types.name as service_type, users.email as user_email
                                  FROM documents
                                  LEFT JOIN units
                                  ON units.id=documents.unit_id
                                  LEFT JOIN
                                  departments
                                  ON departments.id=documents.department_id
                                  LEFT JOIN
                                  service_types
                                  ON service_types.id=documents.service_type_id
                                  LEFT JOIN
                                  users
                                  ON users.unit_id=documents.unit_id AND users.department_id=documents.department_id
                                  WHERE 1
                                  AND DATE_FORMAT(next_renewal_date, '%Y-%m-%d') BETWEEN CURDATE() AND (CURDATE() + INTERVAL 310 day)
                                  OR CURDATE() > DATE_FORMAT(next_renewal_date, '%Y-%m-%d')   
                                  
                                  ORDER BY documents.unit_id, documents.department_id" );

        $mail_to_array = array();
        $mail_cc_array = array();

        foreach ($super_admins as $s){

            if($s->email != ''){

                if(array_search($s->email, $mail_cc_array) < -1){
                    array_push($mail_cc_array, $s->email);
                }

            }

        }

        if (sizeof($documents) > 0){

            foreach ($documents as $d){

                if($d->user_email != ''){

                    if(array_search($d->user_email, $mail_to_array) < -1){
                        array_push($mail_to_array, $d->user_email);
                    }

                }

            }

            $mail_to = implode(',', $mail_to_array);
            $mail_cc = implode(',', $mail_cc_array);


            Mail::to($mail_to)->cc($mail_cc)->send(new ReminderMail());

            return 'Email sent Successfully';
        }else{
            return 'No Record Found to Send Mail!';
        }

    }
}
