@extends('master')

@section('manageProjectsContent')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Projects
        <small>Manage the project list</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Manage Projects</a></li>
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
            <div class="box-body  table-responsive">
              <table id="partnerTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Project ID</th>
                  <th>Lead ID</th>
                  <th>Partner ID</th>
                  <th>Start Date </th>
                  <th>End Date</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($users as $user)
                    <tr>

                        <td>{{$index++}}</td>
                        <td>{{$user->project_id}}</td>
                        <td>{{$user->lead_id}}</td>
                        <td>{{$user->partner_id}}</td>
                        <td>{{$user->start_date}}</td>
                        <td>{{$user->end_date}}</td>
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
</script>

@endSection
