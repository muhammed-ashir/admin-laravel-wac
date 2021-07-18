@extends('layouts.app')

{{-- @section('addemp')
<li class="nav-item">
  <a class="nav-link" href="{{ route('employees.create') }}"><i class="fas fa-user-plus"
  style="color: #0275d8;"></i></a>
</li>
@endsection --}}
@section('sideitem')
<li class="nav-item menu-open">
  <a href="{{ url('/') }}" class="nav-link">
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
        <h5 class="modal-title" id="exampleModalLabel">Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- modal body --}}

        <div class="col-xl-12 col-md-12">
          <div class="card user-card-full">
            <div class="row m-l-0 m-r-0">
              <div class="col-sm-4 bg-c-lite-green user-profile">
                <div class="card-block text-center text-white">
                  <div class="m-b-20"> <img src="" id="photo" class="img-radius" alt="UserImage"> </div>
                  <h6 class="f-w-600" id="name"></h6>
                  <p id="designation"></p>
                </div>
              </div>
              <div class="col-sm-8">
                <div class="card-block">
                  <h6 class="p-b-5 b-b-default f-w-600">Status</h6>
                  <div class="row">
                    <div class="col-sm-12 mb-3">

                      <h6 class="text-muted f-w-400" id="status"></h6>

                    </div>
                  </div>
                  <h6 class="p-b-5 b-b-default f-w-600">Department</h6>
                  <div class="row">
                    <div class="col-sm-12 mb-3">

                      <h6 class="text-muted f-w-400" id="department"></h6>

                    </div>
                  </div>
                  <h6 class="p-b-5 b-b-default f-w-600">Mail id</h6>
                  <div class="row">
                    <div class="col-sm-12 mb-3">

                      <h6 class="text-muted f-w-400" id="email"></h6>

                    </div>
                  </div>
                  <h6 class="p-b-5 b-b-default f-w-600">Address</h6>
                  <div class="row">
                    <div class="col-sm-12 mb-3">

                      <h6 class="text-muted f-w-400" id="address"></h6>

                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- modal body ends --}}
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
        <div class="col-sm-2">
          <h1>Employees</h1>
        </div>

        <div class="col-sm-10">
          <form class="form form-inline" method="POST" action="{{ url('employees/search') }}" style="float: right;">
            @csrf

            <select name="department[]" class="form-control" id="dept" multiple="multiple" style="width: 300px;">
              <option value=""> Select Department</option>
              @foreach ($departments as $department)
              <option value="{{ $department->id }}">{{ $department->department }}</option>
              @endforeach
            </select>
            <div class="ml-3"></div>
            <select name="designation[]" class="form-control" id="desig" multiple="multiple" style="width: 300px;">
              <option value=""> Select Designation</option>
              @foreach ($designations as $designation)
              <option value="{{ $designation->id }}">{{ $designation->designation }}</option>
              @endforeach
            </select>
            <button type="submit" class="btn btn-primary ml-2"><i class="fa fa-search"></i></button>
            <div><a class="btn btn-primary ml-3" href="{{ route('employees.create') }}" style="text-align: right;"><i
                  class="fas fa-user-plus" style="color: white;font-size:20px;"></i></a></div>
          </form>


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

              <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
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
                  {{-- @foreach ($datas as $emp)
                  

                  <tr>
                    <td>{{ $emp->name }}</td>
                  <td>{{ $emp->email }}</td>
                  <td><img src="{{ asset('images/'.$emp->photo) }}" alt="" height="50px" width="70px"></td>
                  <td>{{ $emp->address }}</td>
                  <td>{{ $emp->department->department }}</td>
                  <td>{{ $emp->designation->designation }}</td>

                  <td>
                    @if ($emp->status)
                    <a href="{{ url('employees/status/0')."/".$emp->id}}"
                      onclick="return confirm('Do you really want to Block')" style="color: green">Active &nbsp;<i
                        class="fa fa-user-check"></i></a>
                    @else
                    <a href="{{ url('employees/status/1')."/".$emp->id}}"
                      onclick="return confirm('Do you really want to Un-Block')" style="color: red">Blocked &nbsp;<i
                        class="fa fa-user-times"></i></a>
                    @endif


                  </td>
                  <td>
                    <a href="" class="btn" data-toggle="modal" data-target="#view"
                      style="color: black;margin:5px;padding:0;"
                      onclick="viewBtn('{{ $emp->name }}','{{ $emp->email }}','{{ $emp->photo }}','{{ $emp->address }}','{{ $emp->department->department }}','{{ $emp->designation->designation }}','{{ $emp->status }}')"><i
                        class="fa fa-eye"></i></a>
                    <a href="{{ route('employees.edit',$emp->id) }}" onclick="return confirm('Do you want to Edit');"
                      style="margin: 5px;"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('employees.destroy',$emp->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" onclick="return confirm('Do you want to Delete');"
                        style="border: none;background: none;margin:5px;">
                        <i class="fa fa-trash" style="color:red;"></i>
                      </button>

                    </form>
                  </td>
                  </tr>
                  @endforeach --}}
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

<script>
  function viewBtn(id){

    

    // document.getElementById('name').innerHTML=name;
    // document.getElementById('designation').innerHTML=designation;

    // if(status == 1){
    //     document.getElementById('status').innerHTML = '<span style="color: green">Active &nbsp;<i class="fa fa-user-check"></i></span>';
    // }
    // else{
    //     document.getElementById('status').innerHTML = '<span style="color: red">Blocked &nbsp;<i class="fa fa-user-times"></i></span>';
    // }
    // document.getElementById('department').innerHTML=department;
    // document.getElementById('email').innerHTML=email;
    // document.getElementById('address').innerHTML=address;
    // document.getElementById('photo').src="{{ url('images/') }}/"+photo;
}
</script>
@endsection

@section('script')

<script>
  var table = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('employees.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'photo', name: 'photo'},
            {data: 'address', name: 'address'},
            {data: 'department', name: 'department'},
            {data: 'designation', name: 'designation'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
        ]
    });

    // 
  function isEnabled(id) {
    
    if(confirm('Do you want to change'))
    {
          $.ajax({
          type: "POST",
          url: "{{ url('employees/status') }}",
          data: {
            "_token": "{{ csrf_token() }}",
            'id':id
          },
          cache: false,
          dataType:'json',
          success: function(data){
            if(data.status==true)
               alert(data.msg)
          },
          error: function(error){
          }
        });
    }
  }


    
    $('#dept').select2({
      placeholder:'Select Department',
      allowClear:true,
      closeOnSelect: false
    });

    $('#desig').select2({
      placeholder:'Select Designation',
      allowClear:true,
      closeOnSelect: false
    });


</script>
@endsection