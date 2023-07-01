<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        return view('employees.add_employees');
    }

    public function listEmployees()
    {
        $emp = Employee::all();

        $war = Employee::where('name', 'Warren')->get();
        return view('employees.all_employees',compact('emp','war'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:11',
            'photo' => 'required',
        ]);

        $data = array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $image = $request->file('photo');
        
        
        if($image){
            $image_name = Str::random(5);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/employeePhotos/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if($success){
                $data['photo'] = $image_url;
                $employee = DB::table('employees')->insert($data);
                if($employee){
                    //$notification = array('message'=>'Successfully Inserted', 'alert-type'=>'success');
                    return redirect()->back()->with('success','Employee Data Saved Successfully');
                }else{
                    //$notification = array('message'=>'error','alert-type'=>'error');
                    return redirect()->back()->with('success','Employee Data Saved Successfully');
                }
            }else{
                return redirect()->back();
            }

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        
        $emp = DB::table('employees')->where('id', $id)->first();

        return view('employees.edit_employees', compact('emp'));
    }
    public function updateEmployee(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $image = $request->file('photo');

        if($image){
            $image_name = Str::random(5);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/employeePhotos/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if($success){
                $data['photo'] = $image_url;
                $img = DB::table('employees')->where('id', $id)->first();
                $image_path = $img->photo;
                $done = unlink($image_path);
                $emp = DB::table('employees')->where('id', $id)->update($data);
                if($emp){
                    //$notification = array('message'=>'Successfully Inserted', 'alert-type'=>'success');
                    return redirect()->route('list_employees')->with('success','Employee Updated Successfully');
                }else{
                    //$notification = array('message'=>'error','alert-type'=>'error');
                    return redirect()->route('list_employees')->with('error','Employee Updated Failed');
                }
            }else{
                return redirect()->back();
            }
        }else{
            $oldphoto = $request->old_photo;
            if($oldphoto){
                $data['photo']=$oldphoto;
                $user=DB::table('employees')->where('id', $id)->update($data);
                if($user){
                    return redirect()->route('list_employees')->with('success', 'Employee Updated Successfully');
                }else{
                    return redirect()->back();
                }
            }
        }

    }
    public function destroy(Request $request)
    {   
        $employee_id = $request->input('delete_employee');

        $employ = Employee::find($employee_id);
        $employ->delete();

        return redirect()->back()->with('success', 'Employee Data Deleted Successfully');
    }

    public function viewEmployee($id)
    {
        $singleEmploy = DB::table('employees')
                    ->where('id', $id)
                    ->first();
        return view('employees.view_employee',compact('singleEmploy'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}   
