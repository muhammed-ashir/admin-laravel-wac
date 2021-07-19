<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\Designation;
use App\Mail\WelcomeEmployee;
use Illuminate\Support\Facades\Mail;
use App\Jobs\WelcomeEmailJob;
use DataTables;

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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('department', function ($row) {
                        return $row->department->department;
                    })
                    ->addColumn('designation', function ($row) {
                        return $row->designation->designation;
                    })
                    ->addColumn('photo', function ($row) {
                        $src =  url('images/'.$row->photo);
                        return "<img src=$src width='50px'>";
                    })
                    ->addColumn('status', function ($row) {
                        $status= $row->status==1?"checked":"";
                        return'<label class="switch">
                        <input onclick="isEnabled('.$row->id.')" type="checkbox"'.$status.'>
                        <span class="slider round"></span>
                      </label>';
                    })
                    ->addColumn('action', function ($row) {
                        $href = route('employees.edit', $row->id);

                        return '<a href="" class="btn" data-toggle="modal" data-target="#view"
                        style="color: black;margin:5px;padding:0;"
                        onclick="viewBtn('.$row->id.')"><i
                        class="fa fa-eye"></i></a>
                        <a href='.$href.' style="margin: 5px;"><i class="fa fa-edit"></i></a>
                        <a class="btn" style="margin: 5px;" onclick="deleteEmployee('.$row->id.')"><i class="fa fa-trash" style="color:red;"></i></a>
                          ';
                    })
                    ->filter(function ($instance) use ($request) {
                      
                        if ($request->get('department')) {
                            $instance->whereIn('department_id', $request->get('department'));
                        }

                        if ($request->get('designation')) {
                            $instance->whereIn('designation_id', $request->get('designation'));
                        }
                        
                    })
                    ->rawColumns(['photo','department','designation','status','action'])
                    ->make(true);
        }

        $departments = Department::all();
        $designations = Designation::all();
        return view('employees', compact('departments', 'designations'));
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
        return view('forms.add', compact('departments', 'designations'));
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
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ], [
            'name.required' => 'Name is required',
            'pwd.required' => 'Password is required',
            'pwd.required' => 'Password is required',
            'pwd.min' => 'Password should have 5 characters',
            'photo.mimes' => 'Image type should be jpg or png'
        ]);


        $image  = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('images'), $image);


        $employee =  new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->photo = $image;
        $employee->password = bcrypt($request->pwd);
        $employee->address = $request->address;
        $employee->department_id = $request->department;
        $employee->designation_id = $request->designation;
        $employee->save();
        
        dispatch(new WelcomeEmailJob($employee));

        return redirect()->route('employees.index')
            ->with('success', 'Added Successfully');
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
        $data = Employee::find($id);

        $departments = Department::all();
        $designations = Designation::all();

        return view('forms.edit', compact('data', 'departments', 'designations'));
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
        $request->validate([
            'name' => 'required',
            'pwd' => 'required|min:5',
            'email' => 'required|email',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ], [
            'name.required' => 'Name is required',
            'pwd.required' => 'Password is required',
            'pwd.required' => 'Password is required',
            'pwd.min' => 'Password should have 5 characters',
            'photo.mimes' => 'Image type should be jpg or png'
        ]);

        $data = Employee::find($id);

        if ($request->photo) {
            $image  = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $image);
            $data->photo = $image;
        }

        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = $request->pwd;
        $data->address = $request->address;
        $data->department_id = $request->department;
        $data->designation_id = $request->designation;
        $data->save();

        return redirect()->route('employees.index')
            ->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = Employee::find($request->id);
        $image = $data->photo;

        $file_path  = public_path('images/');
        $image_path = $file_path . $image;

        if (file_exists($image_path)) {
            @unlink($image_path);
        }

        $deleted = $data->delete();

        if ($deleted) {
            return [
                'status'=>true,
                'msg'=> 'Successfully Deleted Employee'
            ];
        }
    }

    public function status(Request $request)
    {
        $data = Employee::find($request->id);
        $data->status = $data->status==1?0:1;
        $changed = $data->save();

        if ($changed) {
            return [
                'status'=>true,
                'msg'=> $data->status==1?'Successfully Enabled Employee':'Successfully Blocked Employee'
            ];
        }
    }

    public function view(Request $request)
    {
        $data = Employee::find($request->id);
        $department = Department::find($data->department_id);
        $designation = Designation::find($data->designation_id);

        return [ 'data'=>$data, 'department'=>$department->department, 'designation'=>$designation->designation ];
    }
    

    public function search(Request $request)
    {
        $datas = Employee::query();

        if (!empty($request->department)) {
            $datas = $datas->whereIn('department_id', $request->department);
        }

        if (!empty($request->designation)) {
            $datas = $datas->whereIn('designation_id', $request->designation);
        }

        
        $datas = $datas->get();


        $departments = Department::all();
        $designations = Designation::all();
        return view('employees', compact('datas', 'departments', 'designations'));
    }
}
