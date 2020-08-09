<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Document;
use App\ServiceType;
use App\Unit;
use App\Department;
use DB;



class ApiController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function documentList(){

        $query = Document::leftJoin('units', 'units.id', '=', 'documents.unit_id')
                ->leftJoin('departments', 'departments.id', '=', 'documents.department_id')
                ->leftJoin('service_types', 'service_types.id', '=', 'documents.service_type_id')

                ->select('documents.*', 'units.name as unit', 'departments.name as department', 'service_types.name as service_type');

        $documents = $query->paginate(10);

        return response($documents, 200);
    }

    public function getUnits(){
        $units = Unit::all();

        return response($units, 200);
    }

    public function getDepartments(){
        $departments = Department::all();

        return response($departments, 200);
    }

    public function getServiceTypes(){
        $service_types = ServiceType::all();

        return response($service_types, 200);
    }


    public function getDocuments($unit){

        $query = Document::leftJoin('units', 'units.id', '=', 'documents.unit_id')
            ->leftJoin('departments', 'departments.id', '=', 'documents.department_id')
            ->leftJoin('service_types', 'service_types.id', '=', 'documents.service_type_id')

            ->select('documents.*', 'units.name as unit', 'departments.name as department', 'service_types.name as service_type');

        if($unit != ''){
            $query->where('documents.unit_id', '=', $unit);
        }

        $documents = $query->get();

        return \GuzzleHttp\json_encode($documents);
    }

}
