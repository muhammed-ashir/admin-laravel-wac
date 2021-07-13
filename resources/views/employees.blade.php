@extends('layouts.app')

@section('addemp')
<li class="nav-item">
  <a class="nav-link" href="#"><i class="fas fa-user-plus" style="color: #0275d8;"></i></a>
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
  <a href="employees" class="nav-link active">
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
                  <select name="filter_col" class="form-control ml-3">
                      <option value="">dh</option>
                      <option value="">dh</option>
                  </select>
                  <select name="order_by" class="form-control ml-3" id="input_order">
                      <option value="Asc">Asc</option>
                      <option value="Desc">Desc</option>
                  </select>
                  <input type="submit" value="Go" class="btn btn-primary ml-3">
              </form>
              <div style="margin-top: 8px;"></div>
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Mail id</th>
                    <th>Photo</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Name</td>
                      <td>Mail id</td>
                      <td>Photo</td>
                      <td>Department</td>
                      <td>Designation</td>
                      <td>
                            <a href="" onclick="return confirm('Do you really want to Un-Confirm the Account')" style="color: green">Active &nbsp;<i class="fa fa-user-check"></i></a>
                            <a href="" onclick="return confirm('Do you really want to Confirm the Account')" style="color: red">Blocked &nbsp;<i class="fa fa-user-times"></i></a>
                      </td>
                      <td>
                            <a href="">&nbsp; <i class="fa fa-eye" style="color:black;margin:7px;"></i></a>
                            <a href="" onclick="return confirm('Do you want to Edit');">&nbsp; <i class="fa fa-edit" style="margin: 7px;"></i></a>
                            <a href="" onclick="return confirm('Do you want to Delete');"><i class="fa fa-trash" style="color:red;margin: 7px;"></i></a>
                      </td>
                    </tr>
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