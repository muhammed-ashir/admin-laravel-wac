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
  <a href="employees" class="nav-link">
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

                <form style="padding-left: 150px;padding-right: 150px;">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Email address" name="email">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Password</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Password" name="pwd">
                  </div>
                  <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                  </div>
                  <div class="form-group">
                  <label for="address">Address</label>
                  <textarea class="form-control" id="address" rows="3" name="address"></textarea>
                  </div>
                  <div class="form-group">
                  <label for="department">Department</label>
                  <select class="form-control" id="department" name="department">
                      <option>Human Resource</option>
                      <option>Marketing</option>
                      <option>Finance</option>
                      <option>Sales</option>
                      <option>Operations</option>
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="designation">Designation</label>
                    <select class="form-control" id="designation" name="designation">
                        <option>Software Engineer</option>
                        <option>System Analyst</option>
                        <option>Project Lead</option>
                        <option>Trainee Engineer</option>
                        <option>Web Developer</option>
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