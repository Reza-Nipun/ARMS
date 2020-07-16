<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Unit;
use App\Department;
use DB;

class UsersController extends Controller
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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function index()
    {
        $user = Auth::user();

        $user_unit = $user->unit_id;

        $users = DB::table('users')
            ->leftJoin('units', 'units.id', '=', 'users.unit_id')
            ->leftJoin('departments', 'departments.id', '=', 'users.department_id')
            ->select('users.*', 'units.name as unit', 'departments.name as department')
            ->where('users.unit_id', '<>', '0')
            ->paginate(10);

        return view('users.index')->with('users', $users)->with('user_unit', $user_unit);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::all();
        $departments = Department::all();
        return view('users.create')->with('units', $units)->with('departments', $departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'unit_id' => 'required',
            'department_id' => 'required',
            'password' => 'required'
        ]);

        $users = new User;
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->unit_id = $request->input('unit_id');
        $users->department_id = $request->input('department_id');
        $users->password = Hash::make($request->input('password'));
        $users->save();

        return redirect('/users/create')->with('message', 'User Created');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $user = User::find($id);
        $user->delete();

        // redirect
        return Redirect::to('users')->with('message', 'User Deleted!');
    }
}
