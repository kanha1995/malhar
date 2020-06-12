@extends('master')

@section('manageLeads')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Leads
        <small>Manage the lead list</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Manage Leads</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">My Leads' List</h3>
        </div>
        <div class="box-body">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">&nbsp;</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body  table-responsive">
              <table id="partnerTable" class="table table-bordered table-striped display">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Lead Name</th>
                  <th>Lead Email</th>
                  <th>Lead Status</th>
                  <th>Lead Address</th>
                  <th>Lead URL</th>
                  <th>Lead Description</th>
                  <th>Date Of Communication</th>
                  <th>Lead Tags</th>
                  <th style="width: 15%;">Action</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$index++}}</td>
                        <td>
                            {{$user->name}} <br>
                        </td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if ($user->status == 1)
                                <b>Created</b>
                            @elseif ($user->status == 2)
                                <b>Partner Searched</b>
                            @elseif ($user->status == 3)
                                <b>Requested</b>
                            @elseif ($user->status == 5)
                                <b>Introduced</b>
                            @endif
                        </td>
                        <td>
                            @if (isset($user->city))
                                {{$user->city}}, {{$user->country}}
                            @else
                                {{$user->country}}
                            @endif
                        </td>
                        <td>
                            @if (isset($user->url))
                                <a href="{{$user->url}}" target="_blank">{{$user->url}}</a>
                            @endif
                        </td>
                        <td>
                            @if (isset($user->description))
                                {{$user->description}}
                            @endif
                        </td>
                        <td>
                            @if (isset($user->date_of_communicatin))
                                {{date('M d Y, l', strtotime($user->date_of_communicatin))}}
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
                                  <li><a href="previewLead/{{$user->id}}">View</a></li>
                                  {{-- <li><a href="editPartner/{{$user->id}}">Edit</a></li> --}}
                                  @if ($user->block_status == 1)
                                    <li><a href="#" onclick="blockAction({{$user->id}})">Block</a></li>
                                  @else

                                  @endif

                                  <li><a href="/createPartnerSearch/{{$user->lead_id}}">Send for partner search</a></li>
                                  <li><a href="/createLeadPartnerPair/{{$user->id}}">Communicate partner</a></li>
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
    let example = $('#partnerTable').DataTable({
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
        text: 'Are you sure you want to delete the lead?',
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        confirmButtonColor: '#d33724',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            var url = '{{ route("deleteLead", ":id") }}';
            url = url.replace(':id',partnerId);
            window.location.href = url;
  }});
}

function blockAction(partnerId){
    alert(partnerId);
}


</script>

@endSection
