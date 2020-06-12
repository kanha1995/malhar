@extends('master')

@section('mangePartner')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Partners
        <small>Manage the partner list</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Manage Partners</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">My Partners' List</h3>
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
                  <th>Partner Name</th>
                  <th>Partner Email</th>
                  <th>Partner Phone</th>
                  <th>Partner Address</th>
                  <th>Partner Tags</th>
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
                            @if (isset($user->phone))
                                {{$user->phone}}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if (!isset($user->city))
                                {{$user->country}}
                            @else
                                {{$user->city}}, {{$user->country}}
                            @endif
                        </td>
                        <td>
                            {{$user->tags ?? 'N/A'}}
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-flat">Action</button>
                                <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="previewPartner/{{$user->id}}">View</a></li>
                                  {{-- <li><a href="editPartner/{{$user->id}}">Edit</a></li> --}}
                                  @if ($user->block_status == 1)
                                    <li><a href="#" onclick="unblockAction({{$user->id}})">UnBlock</a></li>
                                  @else
                                    <li><a href="#" onclick="blockAction({{$user->id}})">Block</a></li>
                                  @endif
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
        text: 'Are you sure you want to delete the partner?',
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        confirmButtonColor: '#d33724',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            var url = '{{ route("deletePartner", ":id") }}';
            url = url.replace(':id',partnerId);
            window.location.href = url;
  }});
}

function unblockAction(partnerId){

    Swal.fire({
        title: 'Alert!',
        text: 'Are you sure you want to unblock the partner?',
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        confirmButtonColor: '#d33724',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            var url = '{{ route("unblockPartner", ":id") }}';
            url = url.replace(':id',partnerId);
            window.location.href = url;
  }});
}

function blockAction(partnerId){

Swal.fire({
    title: 'Alert!',
    text: 'Are you sure you want to block the partner?',
    icon: 'question',
    showCancelButton: true,
    cancelButtonText: 'No',
    confirmButtonText: 'Yes',
    confirmButtonColor: '#d33724',
    reverseButtons: true
}).then((result) => {
    if (result.value) {
        var url = '{{ route("blockPartner", ":id") }}';
        url = url.replace(':id',partnerId);
        window.location.href = url;
}});
}


</script>

@endSection
