@extends('master')

@section('mangePartnerSearchRequest')
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
          <h3 class="box-title">Partner Search Request List</h3>
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
                  <th>Lead ID</th>
		  <th>Lead Name</th>
                  <th>Address</th>
                  <th>Note to partner manager</th>
                  <th>Keywords</th>
                  <th>Partner Count</th>
                  <th style="width: 15%">Action</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($leadData as $lead)
                    <tr>

                        <td>{{$index++}}</td>
                        <td>{{$lead->lead_id}}</td>
			<td>{{$lead->name}}</td>
                        <td>
                            @if (@isset($lead->city))
                                {{$lead->city}}, {{$lead->country}}
                            @else
                                {{$lead->country}}
                            @endif
                        </td>
                        <td>{{$lead->note_to_partner}}</td>
                        <td>{{$lead->partner_search_keywords}}</td>
                        <td>{{$partnerCount[$index - 2]}}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-flat">Action</button>
                                <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="finishAction/{{$partnerSearchData[$index - 2]->id}}">Finish</a></li>
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
        text: 'Are you sure you want to delete the partner search action?',
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

function blockAction(partnerId){
    alert(partnerId);
}


</script>

@endSection
