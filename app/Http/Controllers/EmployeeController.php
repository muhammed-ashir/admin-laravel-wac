<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\Designation;


class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

 
        $datas = Employee::all();
        $departments = Department::all();
        $designations = Designation::all();
        return view('employees', compact('datas','departments','designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $designations = Designation::all();
        return view('forms.add',compact('departments','designations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
	        'name' => 'required',
	        'pwd' => 'required|min:5',
	        'email' => 'required|email|unique:employees',
            'photo' => 'image|mimes:jpeg,png,jpg|max:5120',
	    ], [
	        'name.required' => 'Name is required',
	        'pwd.required' => 'Password is required',
            'pwd.required' => 'Password is required',
            'pwd.min' => 'Password should have 5 characters',
            'photo.mimes' => 'Image type should be jpg or png'
	    ]);
    

        $image  = time().'.'.$request->photo->extension();
        $request->photo->move(public_path('images'), $image);
        

        Employee::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'photo'=>$image,
            'password'=>bcrypt($request['pwd']),
            'address'=>$request['address'],
            'department_id'=>$request['department'],
            'designation_id'=>$request['designation']

        ]);

        return redirect()->route('employees.index')->with('success','successfully done');

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
        $data = Employee::find($id);
        $image = $data->photo;
        
        $file_path  = public_path('images/');
        $image_path = $file_path.$image;

        if(file_exists($image_path)){
            @unlink($image_path);
        }


        $data->delete();
       
  
        return redirect()->route('employees.index')
                        ->with('success','Deleted successfully');
    }

    public function status($status){
    //    $employee = new Employee;
    }
}
