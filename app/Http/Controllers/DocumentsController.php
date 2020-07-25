<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Document;
use App\ServiceType;
use App\Unit;
use App\Department;
use DB;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $user_unit = $user->unit_id;
        $department_id = $user->department_id;

        $service_types = ServiceType::all();

        if($user_unit != 0){
            $documents = DB::table('documents')
                        ->leftJoin('units', 'units.id', '=', 'documents.unit_id')
                        ->leftJoin('departments', 'departments.id', '=', 'documents.department_id')
                        ->leftJoin('service_types', 'service_types.id', '=', 'documents.service_type_id')
                        ->select('documents.*', 'units.name as unit', 'departments.name as department', 'service_types.name as service_type')
                        ->where('unit_id', '=', $user_unit)
                        ->where('department_id', '=', $department_id)
                        ->paginate(10);

            $units = DB::table('units')->select('*')->where('id', '=', $user_unit)->get();
            $departments = DB::table('departments')->select('*')->where('id', '=', $department_id)->get();
        }else{
            $documents = DB::table('documents')
                        ->leftJoin('units', 'units.id', '=', 'documents.unit_id')
                        ->leftJoin('departments', 'departments.id', '=', 'documents.department_id')
                        ->leftJoin('service_types', 'service_types.id', '=', 'documents.service_type_id')
                        ->select('documents.*', 'units.name as unit', 'departments.name as department', 'service_types.name as service_type')
                        ->paginate(10);

            $units = Unit::all();
            $departments = Department::all();
        }

        return view('home')->with('documents', $documents)
                    ->with('user_unit', $user_unit)
                    ->with('department_id', $department_id)
                    ->with('units', $units)
                    ->with('service_types', $service_types)
                    ->with('departments', $departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        $user_unit = $user->unit_id;
        $department_id = $user->department_id;

        $service_types = ServiceType::all();
        $units = Unit::all();
        $departments = Department::all();

        return view('documents.create')
                ->with('user_unit', $user_unit)
                ->with('service_types', $service_types)
                ->with('units', $units)
                ->with('departments', $departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'item_name' => 'required',
            'service_type_id' => 'required',
            'unit_id' => 'required',
            'department_id' => 'required',
            'user' => 'required',
            'last_renewal_date' => 'required',
            'next_renewal_date' => 'required',
            'amount' => 'required',
            'file' => 'max:2048'
        );
        $customMessages = array(
            'item_name.required' => 'Item Name is required.',
            'service_type_id.required' => 'Service Type is required.',
            'unit_id.required' => 'Unit is required.',
            'department_id.required' => 'Department is required.',
            'user.required' => 'User is required.',
            'last_renewal_date.required' => 'Last Renewal Date is required.',
            'next_renewal_date.required' => 'Next Renewal Date is required.',
            'amount.required' => 'Amount is required.',
            'file.required' => 'File size maximum 2MB is allowed.'
        );
        $this->validate($request, $rules, $customMessages);

        if($request->hasFile('file')){
            // Get File Name With The Extension
            $fileNameWithExt = $request->file('file')->getClientOriginalName();

            // Get just File Name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just File Extension
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to Store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('file')->storeAs('public/attachments', $fileNameToStore);

        } else {
            $fileNameToStore = '';
        }

        $documents = new Document;
        $documents->item_name = $request->input('item_name');
        $documents->service_type_id = $request->input('service_type_id');
        $documents->brand = $request->input('brand');
        $documents->model = $request->input('model');
        $documents->serial_no = $request->input('serial_no');
        $documents->unit_id = $request->input('unit_id');
        $documents->department_id = $request->input('department_id');
        $documents->user = $request->input('user');
        $documents->original_placement_location = $request->input('original_placement_location');
        $documents->original_document_location = $request->input('original_document_location');
        $documents->last_renewal_date = $request->input('last_renewal_date');
        $documents->next_renewal_date = $request->input('next_renewal_date');
        $documents->vendor = $request->input('vendor');
        $documents->amount = $request->input('amount');
        $documents->remarks = $request->input('remarks');
        $documents->file = $fileNameToStore;
        $documents->save();

        return redirect('/documents')->with('success', 'Document Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $user_unit = $user->unit_id;

        $document = Document::find($id);
        $service_types = ServiceType::all();
        $units = Unit::all();
        $departments = Department::all();

        return view('documents.edit')->with('document', $document)->with('service_types', $service_types)->with('units', $units)->with('departments', $departments)->with('user_unit', $user_unit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $user_unit = $user->unit_id;

        if($user_unit == 0){
            $rules = array(
                'item_name' => 'required',
                'service_type_id' => 'required',
                'unit_id' => 'required',
                'department_id' => 'required',
                'user' => 'required',
                'last_renewal_date' => 'required',
                'next_renewal_date' => 'required',
                'amount' => 'required',
                'file' => 'max:2048'
            );
        }else{
            $rules = array(
                'last_renewal_date' => 'required',
                'next_renewal_date' => 'required',
                'file' => 'max:2048'
            );
        }

        $customMessages = array(
            'item_name.required' => 'Item Name is required.',
            'service_type_id.required' => 'Service Type is required.',
            'unit_id.required' => 'Unit is required.',
            'department_id.required' => 'Department is required.',
            'user.required' => 'User is required.',
            'last_renewal_date.required' => 'Last Renewal Date is required.',
            'next_renewal_date.required' => 'Next Renewal Date is required.',
            'amount.required' => 'Amount is required.',
            'file.required' => 'File size maximum 2MB is allowed.'
        );
        $this->validate($request, $rules, $customMessages);

        if($request->hasFile('file')){
            // Get File Name With The Extension
            $fileNameWithExt = $request->file('file')->getClientOriginalName();

            // Get just File Name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just File Extension
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to Store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('file')->storeAs('public/attachments', $fileNameToStore);

        }

        $documents = Document::find($id);

        if($user_unit == 0) {
            $documents->item_name = $request->input('item_name');
            $documents->service_type_id = $request->input('service_type_id');
            $documents->brand = $request->input('brand');
            $documents->model = $request->input('model');
            $documents->serial_no = $request->input('serial_no');
            $documents->unit_id = $request->input('unit_id');
            $documents->department_id = $request->input('department_id');
            $documents->user = $request->input('user');
            $documents->original_placement_location = $request->input('original_placement_location');
            $documents->original_document_location = $request->input('original_document_location');
            $documents->last_renewal_date = $request->input('last_renewal_date');
            $documents->next_renewal_date = $request->input('next_renewal_date');
            $documents->vendor = $request->input('vendor');
            $documents->amount = $request->input('amount');
            $documents->remarks = $request->input('remarks');

            $previous_file = $request->input('previous_file');

            if ($request->hasFile('file')) {

                if ($previous_file != '') {
                    // Delete File
                    Storage::delete('/public/attachments/' . $previous_file);
                }
                $documents->file = $fileNameToStore;
            }
        }else{
            $documents->original_placement_location = $request->input('original_placement_location');
            $documents->original_document_location = $request->input('original_document_location');
            $documents->last_renewal_date = $request->input('last_renewal_date');
            $documents->next_renewal_date = $request->input('next_renewal_date');
            $documents->remarks = $request->input('remarks');

            $previous_file = $request->input('previous_file');

            if ($request->hasFile('file')) {

                if ($previous_file != '') {
                    // Delete File
                    Storage::delete('/public/attachments/' . $previous_file);
                }
                $documents->file = $fileNameToStore;
            }
        }
        
        $documents->save();

        return redirect('/documents/'.$id.'/edit')->with('success', 'Document Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDocuments(Request $request){
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
