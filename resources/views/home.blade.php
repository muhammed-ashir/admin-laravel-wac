@extends('layouts.app')

@section('sideitem')
<li class="nav-item menu-open">
  <a href="/" class="nav-link active">
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
  <a href="mm" class="nav-link">
    <i class="fa fa-user-plus" style="margin: 7px;"></i>
    <p>
      Add Admin
    </p>
  </a>
</li> --}}

@endsection
 
@section('content')
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
      
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $count['count_active'] }}</h3>

              <p>Employees</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('employees.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
         <!-- ./col -->
         <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $count['count_blocked'] }}</h3>

              <p>Blocked</p>
            </div>
            <div class="icon">
              <i class="fa fa-users-slash"></i>
            </div>
            <a href="{{ route('employees.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection
