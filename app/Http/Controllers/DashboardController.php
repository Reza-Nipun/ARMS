<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            ->select('documents.*', 'units.name as unit', 'departments.name as department', 'service_types.name as service_type')
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
                                  service_types.name as service_type  
                                  FROM documents 
                                  LEFT JOIN units 
                                  ON units.id=documents.unit_id
                                  LEFT JOIN
                                  departments
                                  ON departments.id=documents.department_id
                                  LEFT JOIN 
                                  service_types
                                  ON service_types.id=documents.service_type_id
                                  WHERE 1 $where" );

        return \GuzzleHttp\json_encode($documents);
    }
}
