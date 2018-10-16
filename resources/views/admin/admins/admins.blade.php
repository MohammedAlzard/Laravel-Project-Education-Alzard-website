@extends('admin.index')
@section('content')

 <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Admins</li>
  </ol>

  @include('admin.layouts.message')

  <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Table Admins
          <!-- <input type="submit" style="cursor: pointer;" name="item[]" class="btn btn-danger float-right delBtn" value="Deleted All" onclick="delete_at()" data-toggle="modal" data-target="#sureDelete"> -->
          <!-- <form action="admins/create" method="POST">
            <input type="submit"  class="btn btn-primary mr-2" style="float: right;" name="" value="Add New">
          </form> -->
          <a href="{{ url('admin/admins/create') }}" class="btn btn-success mr-2" style="float: right;"><i class="fa fa-edit"></i>Add New</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <form action="{{ url('/admin/admins/add-role') }}" method="post">
            {{ csrf_field() }}
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <!-- Button trigger modal -->
                  <!-- <th><input type="checkbox" id="Select" name="item[]" class="check_all" onclick="check_all()"> <label for="Select">Select</label></th> -->
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Admin</th>
                  <th>Editor</th>
                  <th>User</th>
                  <th>Created At</th>
                  <th>Control</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <!-- <th>Select</th> -->
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Admin</th>
                  <th>Editor</th>
                  <th>User</th>
                  <th>Created At</th>
                  <th>Control</th>
                </tr>
              </tfoot>
              <tbody>
                <span hidden>{{ $count = 0 }}</span>
                @foreach($admins as $admin)
                @if($admin->uniqid !== auth()->user()->uniqid) 
                  <input type="text" name="uniqid" value="{{ $admin->uniqid }}">
                <tr>
                  <!-- <td><input type="checkbox" class="item_checkall" name="item[]" value="{{ $admin->id }}"></td> -->
                  <td>{{ $count = $count + 1 }}</td>
                  <td>{{ $admin->name }}  {!! json_encode(unserialize($admin->preferences)[0]) !!} </td>
                  <td>{{ $admin->email }}</td>
                  <td>
                    <input type="checkbox" class="form-control" name="role_admin" onchange="this.form.submit()" {{ $admin->hasRole('admin') ? 'checked' : ' ' }}>
                  </td>
                  <td>
                    <input type="checkbox" class="form-control" name="role_editor" onchange="this.form.submit()" {{ $admin->hasRole('editor') ? 'checked' : ' ' }} >
                  </td>
                  <td>
                    <input type="checkbox" class="form-control" name="role_user" onchange="this.form.submit()" {{ $admin->hasRole('user') ? 'checked' : ' ' }}>
                  </td>
                  <td>{{ $admin->created_at }}</td>
                  <td>
                    <a href="{{ url('/admin/admins/'.$admin->id.'/edit') }}" class="btn btn-outline-primary"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ url('/admin/admins/'.$admin->id.'/destroy') }}" class="btn btn-outline-danger" ><i class="fa fa-close"></i> Delete</a>
                  </td>
                </tr>
                @endif
                @endforeach

              </tbody>
            </table>
            </form>
            <!-- /form-->
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
	  <!-- /tables-->



    <!-- Modal Delete All -->
    <div class="modal fade" id="sureDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Message sure </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="not_empty_record">
              <h5 style="color: red !important;">Are you sure you want to delete users <span style="padding-left: 5px; color: #000" class="record_count"></span> ? </h5>
            </div>
          </div>
          <div class="modal-footer">
              
              <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">Close</button>
              <form action="/admin/admins/destroy/all" method="POST">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger" style="cursor: pointer;">Yes sure</button>
              </form>
          </div>
        </div>
      </div>
    </div>


     <!-- Modal Delete One -->
      <!-- data-toggle="modal" data-target="#sureDeleteOne" -->
    <div class="modal fade" id="sureDeleteOne" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Message sure </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="not_empty_record">
              <h5 style="color: red !important;">Are you sure you want to delete user <span style="padding-left: 5px; color: #000" class="record_count"></span> ? </h5>
            </div>
          </div>
          <div class="modal-footer">
              
              <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">Close</button>
              <form action="/admin/admins/destroy" method="POST">
                {{ csrf_field() }}
                <input type="submit" name="destroy" value="{{ $admin->id }}">
                <button type="submit" name="item" class="btn btn-danger" style="cursor: pointer;">Yes sure</button>
              </form>
          </div>
        </div>
      </div>
    </div>

@endsection