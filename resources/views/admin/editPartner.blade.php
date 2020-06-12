@extends('master')

@section('editPartnersContent')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Partner
        <small>&nbsp;</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Edit Partner</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">&nbsp;</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal"  method="POST" action="{{ route('createPartner') }}">
                @csrf
                <div class="box-body">
                <div class="form-group col-lg-6">
                  <label class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Partner Name" id="partnerName" name="name" required>
                  </div>
                </div>
                <div class="form-group col-lg-6">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Email Address" id="partnerEmail" name="email" required eamil>
                  </div>
                </div>

                <div class="form-group col-lg-6">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" placeholder="Enter Password" id="partnerPassword" name="password" required password>
                  </div>
                </div>

                <div class="form-group col-lg-6">
                  <label class="col-sm-2 control-label">Phone Number</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Phone Number" id="partnerPhone" name="phone" required>
                  </div>
                </div>

                <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">City</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Enter City" id="partnerCity" name="city" required>
                    </div>
                </div>

                <div class="form-group col-lg-6">
                   <label class="col-sm-2 control-label">Country</label>
                   <div class="col-sm-10">
                    <select class="form-control" id='partnerCountry' name="country">
                        @foreach ($countryData as $country)
                            <option value="{{$country->id}}">{{$country->value}}</option>
                        @endforeach
                    </select>
                   </div>
                 </div>

                 <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">Technology</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" id="partnerTechnology" placeholder="Enter Technology" style="resize: none;" name="technology" required></textarea>
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">Social&nbsp;Links </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" id="partnerSocial" placeholder="Enter Social Links" style="resize: none;" name="social" required></textarea>
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">Descriptions </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" id="partnerDescription" placeholder="Enter Description" style="resize: none;" name="description" required></textarea>
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">Tags </label>

                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" id="partnerTags" placeholder="Enter Tags" style="resize: none;" name="tags" required></textarea>
                    </div>
                </div>
                </div>

          <!-- /.box -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div  style="width: 100%; height: auto; display: flex;align-items: center;justify-content: center;">
                <button type="submit" class="btn btn-primary btn-flat" id="saveButton" >Save Partners</button>
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
    document.getElementById('partnerPassword').value = '';
    document.getElementById('partnerPhone').value = '';
    document.getElementById('partnerCity').value = '';
    document.getElementById('partnerCountry').selectedIndex = "0";
    document.getElementById('partnerTechnology').value = '';
    document.getElementById('partnerSocial').value = '';
    document.getElementById('partnerDescription').value = '';
    document.getElementById('partnerTags').value = '';
}

function createPartner(){

}

</script>

@endSection
