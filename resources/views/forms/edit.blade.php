@extends('layouts.app')

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
  <a href="{{ route('employees.index') }}" class="nav-link">
    <i class="fa fa-user" style="margin: 7px;"></i>
    <p>
      Employees
    </p>
  </a>
</li>

{{-- <li class="nav-item menu-open">
  <a href="mm" class="nav-link active">
    <i class="fa fa-user-plus" style="margin: 7px;"></i>
    <p>
      Add Admin
    </p>
  </a>
</li> --}}

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Employees</h1>
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

                <form style="padding-left: 150px;padding-right: 150px;" action="{{ route('employees.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ $data->name }}">
                    @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Email address" name="email" value="{{ $data->email }}">
                    @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="pwd">Password</label>
                    
                    <input type="password" class="form-control" autocomplete="off" id="pwd" placeholder="Password" name="pwd" value="{{ $data->password }}">
                    @if ($errors->has('pwd'))
                            <span class="text-danger">{{ $errors->first('pwd') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="photo">Photo</label>
                    <div><img src="{{ asset('images/'.$data->photo) }}" width="100px" height="100px"></div>
                    <input type="file" class="form-control" id="photo" name="photo">
                    @if ($errors->has('photo'))
                            <span class="text-danger">{{ $errors->first('photo') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                  <label for="address">Address</label>
                  <textarea class="form-control" id="address" rows="3" name="address">{{ $data->address }}</textarea>
                  </div>
                  <div class="form-group">
                  <label for="department">Department</label>
                  <select class="form-control" id="department" name="department">
                    <option value="{{ $data->department->id }}">{{ $data->department->department }}</option>
                    @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->department }}</option>
                    @endforeach
                  </select> 
                  </div>
                  <div class="form-group">
                    <label for="designation">Designation</label>
                    <select class="form-control" id="designation" name="designation">
                      <option value="{{ $data->designation->id }}">{{ $data->designation->designation }}</option>
                      @foreach ($designations as $designation)
                      <option value="{{ $designation->id }}">{{ $designation->designation }}</option>
                      @endforeach
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </form>
              
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