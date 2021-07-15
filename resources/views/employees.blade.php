@extends('layouts.app')

@section('addemp')
<li class="nav-item">
  <a class="nav-link" href="{{ route('employees.create') }}"><i class="fas fa-user-plus" style="color: #0275d8;"></i></a>
</li>
@endsection
@section('sideitem')
<li class="nav-item menu-open">
  <a href="/" class="nav-link">
    <i class="fa fa-tachometer-alt" style="margin: 7px;"></i>
    <p>
      Dashboard
    </p>
  </a>
</li>

<li class="nav-item menu-open">
  <a href="{{ route('employees.index') }}" class="nav-link active">
    <i class="fa fa-user" style="margin: 7px;"></i>
    <p>
      Employees
    </p>
  </a>
</li>

{{-- <li class="nav-item menu-open">
  <a href="mm" class="nav-link">
    <i class="fa fa-user-plus" style="margin: 7px;"></i>
    <p>
      Add Admin
    </p>
  </a>
</li> --}}

@endsection

@section('content')

{{-- modal start here--}}

<!-- Button trigger modal -->

<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ....
      </div>
      
    </div>
  </div>
</div>

{{-- modal ends here --}}

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employees</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
             
              <!-- /.card-header -->
              <div class="card-body">

                <form class="form form-inline" action="" style="float: right;">
                  <label for="input_search" class="ml-3">Search</label>
                  <input type="text" class="form-control ml-3" id="input_search" name="search_string" value="">
                  <label for="input_order" class="ml-3">Order By</label>
                  <select name="department" class="form-control ml-3">
                    @foreach ($departments as $department)
                    <option value="$department">{{ $department->department }}</option>
                    @endforeach
                  </select>
                  <select name="designation" class="form-control ml-3" id="input_order">
                    @foreach ($designations as $designation)
                    <option value="$designation">{{ $designation->designation }}</option>
                    @endforeach
                  </select>
                  <input type="submit" value="Go" class="btn btn-primary ml-3">
              </form>
              <div style="margin-top: 5px;"></div>
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Mail id</th>
                    <th>Photo</th>
                    <th>Address</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($datas as $emp)
                      
                   
                    <tr>
                      <td>{{ $emp->name }}</td>
                      <td>{{ $emp->email }}</td>
                      <td><img src="{{ asset('images/'.$emp->photo) }}" alt="" height="50px" width="70px"></td>
                      <td>{{ $emp->address }}</td>
                      <td>{{ $emp->department->department }}</td>
                      <td>{{ $emp->designation->designation }}</td>
                      <td>
                        @if ($emp->status)
                        <a href="employees/status/0/{{ $emp->id }}" onclick="return confirm('Do you really want to Block')" style="color: green">Active &nbsp;<i class="fa fa-user-check"></i></a>
                        @else
                        <a href="employees/status/1/{{ $emp->id }}" onclick="return confirm('Do you really want to Un-Block')" style="color: red">Blocked &nbsp;<i class="fa fa-user-times"></i></a>
                        @endif
                            
                            
                      </td>
                      <td>
                            <a href="" class="btn" data-toggle="modal" data-target="#view" style="color: black;margin:5px;padding:0;"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('employees.edit',$emp->id) }}" onclick="return confirm('Do you want to Edit');" style="margin: 5px;"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('employees.destroy',$emp->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Do you want to Delete');" style="border: none;background: none;margin:5px;">
                              <i class="fa fa-trash" style="color:red;"></i>
                            </button>
  
                            </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
         
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection