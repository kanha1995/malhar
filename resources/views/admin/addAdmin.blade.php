@extends('master')

@section('addAdminContent')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add a new Admin
        <small>&nbsp;</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Add a new Admin</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">&nbsp;</h3>
          @if($errors->any())
            <span class="invalid-feedback" role="alert">
                <strong><h5>{{$errors->first()}}</h5></strong>
            </span>

           @endif
        </div>
        <div class="box-body">
        <form class="form-horizontal"  method="POST" action="{{route('createAdmin')}}">
                @csrf
                <div class="box-body">
                <div class="form-group col-lg-6">
                  <label class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Partner Name" id="name" name="name" required>
                  </div>
                </div>

                <div class="form-group col-lg-6">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Email Address" id="email" name="email" required eamil>
                  </div>
                </div>

                <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" placeholder="Enter Password" id="password" name="password" required>
                    </div>
                  </div>


                <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">Role</label>
                    <div class="col-sm-10">
                     <select class="form-control" id='adminRole' name="adminRole">
                        <option value="1">Super Admin</option>
                        <option value="2">Lead Admin</option>
                        <option value="3">Partner Admin</option>
                        <option value="4">Project Manager</option>
                     </select>
                    </div>
                </div>
                </div>

          <!-- /.box -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div  style="width: 100%; height: auto; display: flex;align-items: center;justify-content: center;">
                <button type="submit" class="btn btn-primary btn-flat" id="saveButton" >&nbsp; &nbsp; &nbsp; &nbsp; Save &nbsp; &nbsp; &nbsp; &nbsp;</button>
            </div>
{{-- onclick="createPartner()" --}}
        </div>
    </form>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>

$(document).ready(function(){
  clearAllField();
});

function clearAllField(){
    document.getElementById('partnerName').value = '';
    document.getElementById('partnerEmail').value = '';
    document.getElementById('partnerPhone').value = '';
    document.getElementById('partnerCity').value = '';
    document.getElementById('partnerCountry').selectedIndex = "0";
    document.getElementById('partnerType').selectedIndex = "0";
    document.getElementById('c2c').selectedIndex = "0";
    document.getElementById('linkedin').value = '';
    document.getElementById('facebook').value = '';
    document.getElementById('fiverr').value = '';
    document.getElementById('twitter').value = '';
    document.getElementById('partnerTags').value = '';
    document.getElementById('teamSize').value = '1';
}

</script>

@endSection
