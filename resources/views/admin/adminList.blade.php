@extends('master')

@section('mangeAdmins')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Admins
        <small>Manage the admin list</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Manage Admins</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-navy"><i class="fa fa-user-secret"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Super Admins</span>
                    <span class="info-box-number">{{$superAdmins}}</span>
                  </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Lead Admins</span>
                    <span class="info-box-number">{{$leadAdmins}}</span>
                  </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-handshake-o"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Partner Admins</span>
                    <span class="info-box-number">{{$partnerAdmins}}</span>
                  </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-orange"><i class="fa fa-list-alt"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Project Managers</span>
                    <span class="info-box-number">{{$projectManagers}}</span>
                  </div>
                </div>
            </div>
        </div>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
            <div class="pull-left">
                <h3 class="box-title">My admins' List</h3>
            </div>
            <div class="pull-right">
                <select class="form-control" id='role' name="role" onchange="selectionChanged()">
                    @if ($role == 0)
                        <option value="0" selected>All</option>
                    @else
                        <option value="0">All</option>
                    @endif

                    @if ($role == 1)
                        <option value="1" selected>Super Admin</option>
                    @else
                        <option value="1">Super Admin</option>
                    @endif

                    @if ($role == 2)
                        <option value="2" selected>Lead Admin</option>
                    @else
                        <option value="2">Lead Admin</option>
                    @endif

                    @if ($role == 3)
                        <option value="3" selected>Partner Admin</option>
                    @else
                        <option value="3">Partner Admin</option>
                    @endif

                    @if ($role == 4)
                        <option value="4" selected>Project Manager</option>
                    @else
                        <option value="4">Project Manager</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="box-body">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">&nbsp;</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="partnerTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Admin Name</th>
                  <th>Admin Email</th>
                  <th>Admin Role</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$index++}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if ($user->role == 1)
                                Super Admin
                            @elseif ($user->role == 2)
                                Lead Admin
                            @elseif ($user->role == 3)
                                Partner Admin
                            @elseif ($user->role == 4)
                                Project Manage
                            @else
                                Unknown Admin
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-flat">Action</button>
                                <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="#" data-toggle="modal" data-target="#modal-default" onclick="return editAction('{{$user->id}}', '{{$user->name}}', '{{$user->email}}', '{{$user->role}}')" data>Edit</a></li>
                                  {{-- <li><a href="editPartner/{{$user->id}}">Edit</a></li> --}}

                                  <li><a href="#" onclick="deleleteAction({{$user->id}})">Delete</a></li>
                                </ul>
                              </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          &nbsp;
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="addPartnerLabel">Edit Lead</h4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal"  method="POST" action="{{route('updateAdminDetails')}}">
                    @csrf
                    <div hidden><input type="label" class="form-control" id="id" name="id"></div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" placeholder="Enter Admin Name" id="name" name="name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" placeholder="Enter Admin Email" id="email" name="email" readonly email>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" placeholder="Enter Admin Password" id="password" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Role</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="adminRole" id="adminRole">
                                    <option value="1">Super Admin</option>
                                    <option value="2">Lead Admin</option>
                                    <option value="3">Partner Admin</option>
                                    <option value="4">Project Manager</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div  style="width: 100%; height: auto; display: flex;align-items: center;justify-content: center;">
                    <button type="submit" class="btn btn-primary btn-flat" id="saveButton" >&nbsp; &nbsp; &nbsp; &nbsp; Save &nbsp; &nbsp; &nbsp; &nbsp;</button>
                </div>
            </div>
            </form>
            </div>
        </div>
      </div>
      <!-- /.modal -->









    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>

$(document).ready(function(){
    $('#partnerTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      'responsive'  : true
    });

});


function deleleteAction(partnerId){

    Swal.fire({
        title: 'Alert!',
        text: 'Are you sure you want to delete the admin?',
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        confirmButtonColor: '#d33724',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            var url = '{{ route("deleteAdmin", ":id") }}';
            url = url.replace(':id',partnerId);
            window.location.href = url;
  }});
}

function selectionChanged(){
    let currentSelection = document.getElementById('role').selectedIndex;
    if(currentSelection == '0'){
        var url = '{{ route("manageAdmins") }}';
        window.location.href = url;
    }else{
        var url = '{{ route("manageAdmin", ":id") }}';
        url = url.replace(':id',currentSelection);
        window.location.href = url;
    }

}
function blockAction(partnerId){
    alert(partnerId);
}

function editAction(adminUserId,adminName, adminEmail, adminRole){
    document.getElementById('id').value = adminUserId;
    document.getElementById('adminRole').selectedIndex = (adminRole - 1);
    document.getElementById('name').value = adminName;
    document.getElementById('email').value = adminEmail;


}


</script>

@endSection
