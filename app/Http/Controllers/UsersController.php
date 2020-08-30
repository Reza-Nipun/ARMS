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
        $user = Auth::user();
        $user_unit = $user->unit_id;

        $units = Unit::all();
        $departments = Department::all();
        return view('users.create')->with('units', $units)->with('departments', $departments)->with('user_unit', $user_unit);
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
            'password' => 'required|string|min:8'
        ]);

        $unit_id = $request->input('unit_id');
        $department_id = $request->input('department_id');
        $email = $request->input('email');

        $user_exist = User::query()
                      ->where('unit_id', $unit_id)
                      ->where('department_id', $department_id)
                      ->get();

        if (sizeof($user_exist) > 0){
            return redirect('/users/create')->with('exception', 'User Already Assigned of this Unit-Department!');
        }else{
            $email_exist = User::query()
                ->where('email', $email)
                ->get();

            if (sizeof($email_exist) > 0){
                return redirect('/users/create')->with('exception', 'Email Already Exist!');
            }else{
                $users = new User;
                $users->name = $request->input('name');
                $users->email = $email;
                $users->unit_id = $unit_id;
                $users->department_id = $department_id;
                $users->password = Hash::make($request->input('password'));
                $users->save();

                return redirect('/users')->with('message', 'User Created');
            }

        }

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
        return redirect('users')->with('message', 'User Deleted!');
    }
}
