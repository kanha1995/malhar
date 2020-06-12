@extends('master')

@section('addLeadsContent')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add a new Lead
        <small>&nbsp;</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Add a new Lead</a></li>
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
            <form class="form-horizontal"  method="POST" action="{{ route('createLead') }}">
                @csrf
                <div class="box-body">
                <div class="form-group col-lg-6">
                  <label class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Lead Name" id="leadName" name="name" required>
                  </div>
                </div>
                <div class="form-group col-lg-6">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Email Address" id="leadEmail" name="email" required eamil>
                  </div>
                </div>

                <div class="form-group col-lg-6">
                  <label class="col-sm-2 control-label">URL</label>
                  <div class="col-sm-10">
                    <input type="url" class="form-control" placeholder="Enter Lead URL" id="leadURL" name="url">
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
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"  id='worldwide' name="worldwide" value="1"> Consider Worldwide
                        </label>
                   </div>
                   <div class="checkbox">
                    <label>
                        <input type="checkbox"  id='c2c' name="c2c" value="1"> Can Do C2C
                    </label>
                    </div>
                   </div>
                 </div>

                 <div class="form-group col-lg-6">
                    <label class="col-sm-2 control-label">Language</label>
                    <div class="col-sm-10">
                     <select class="form-control" id='language' name="language">
                            @foreach ($languageList as $language)
                                @if ($language->id == "en")
                                    <option value="{{$language->id}}" selected>{{$language->value}}</option>
                                @else
                                    <option value="{{$language->id}}">{{$language->value}}</option>
                                @endif
                            @endforeach
                     </select>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id='translation' name="translation" value="1"> Translation Email Send
                        </label>
                    </div>
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label class="col-sm-1 control-label">Tags </label>

                    <div class="col-sm-11">
                        <textarea class="form-control" rows="3" id="partnerTags" placeholder="Enter Tags (Use Comma to separate tags)" style="resize: none;" name="tags"></textarea>
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label class="col-sm-1 control-label"><small>Initial Requirements</small> </label>
                    <div class="col-sm-11">
                        <textarea class="form-control" rows="5" id="initial_requirement" placeholder="Enter Initial Requirements" style="resize: none;" name="initial_requirement"></textarea>
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label class="col-sm-1 control-label"><small>Note to partner manager</small> </label>
                    <div class="col-sm-11">
                        <textarea class="form-control" rows="5" id="note_to_partner" placeholder="Enter note to partner manager" style="resize: none;" name="note_to_partner"></textarea>
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label class="col-sm-1 control-label"><small>Partner Search Keywords</small> </label>
                    <div class="col-sm-11">
                        <textarea class="form-control" rows="3" id="partner_search_keywords" placeholder="Enter Partner Search Keuwords (Use Comma to separate keywords)" style="resize: none;" name="partner_search_keywords"></textarea>
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label class="col-sm-1 control-label"><small>Description</small> </label>
                    <div class="col-sm-11">
                        <textarea class="form-control" rows="3" id="description" placeholder="Enter Lead Description" style="resize: none;" name="description"></textarea>
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label class="col-sm-1 control-label"><small>Requirement for</small> </label>
                    <div class="col-sm-11">
                        <textarea class="form-control" rows="3" id="requirement" placeholder="Enter Requirement For..." style="resize: none;" name="requirement"></textarea>
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
    document.getElementById('leadName').value = '';
    document.getElementById('leadEmail').value = '';
    document.getElementById('leadURL').value = '';
    document.getElementById('partnerCity').value = '';
    document.getElementById('partnerCountry').selectedIndex = "0";
    document.getElementById('worldwide').checked = false;
    document.getElementById('c2c').checked = false;
    document.getElementById('translation').checked = false;
    document.getElementById('initial_requirement').value = '';
    document.getElementById('note_to_partner').value = '';
    document.getElementById('partnerTags').value = '';
    document.getElementById('partner_search_keywords').value = '';
    document.getElementById('requirement').value = '';
}

</script>

@endSection
