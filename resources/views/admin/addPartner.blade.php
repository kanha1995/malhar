@extends('master')

@section('addPartnersContent')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add a new Partner
        <small>&nbsp;</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Add a new Partner</a></li>
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
                  <label class="col-sm-2 control-label">Phone Number</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Phone Number" id="partnerPhone" name="phone">
                  </div>
                </div>

                <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">Partner Type</label>
                    <div class="col-sm-10">
                     <select class="form-control" id='partnerType' name="partnerType">
                        <option value="1">Company</option>
                        <option value="2">Freelancer</option>
                        <option value="3">Both</option>
                     </select>
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">City</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Enter City" id="partnerCity" name="city">
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
                    <label class="col-sm-2 control-label">LinkedIn</label>
                    <div class="col-sm-10">
                      <input type="url" class="form-control" placeholder="LinkedIn URL" id="linkedin" name="linkedin">
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">FaceBook</label>
                    <div class="col-sm-10">
                      <input type="url" class="form-control" placeholder="FaceBook URL" id="facebook" name="facebook">
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">Fiverr</label>
                    <div class="col-sm-10">
                      <input type="url" class="form-control" placeholder="Fiverr URL" id="fiverr" name="fiverr">
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">Twitter</label>
                    <div class="col-sm-10">
                      <input type="url" class="form-control" placeholder="Twitter URL" id="twitter" name="twitter">
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">Can Do C2C</label>
                    <div class="col-sm-10">
                     <select class="form-control" id='c2c' name="c2c">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                     </select>
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">Team Size</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" placeholder="Enter Team Size" id="teamSize" name="teamSize" min="1" number>
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">Tags </label>

                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" id="partnerTags" placeholder="Enter Tags (Use Comma to separate tags)" style="resize: none;" name="tags"></textarea>
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
