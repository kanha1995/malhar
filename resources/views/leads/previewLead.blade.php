@extends('master')

@section('previewLeadsContent')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <section class="content-header">
      <h1>
        &nbsp;
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/manageLeads"><i class="fa fa-users"></i> Manage Leads</a></li>
        <li><a href="#">Preview Lead</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
            <span class="pull-left">
                <h1 class="box-title">
                    <b>{{$user->name}}</b>
                </h1>
                <h5><b>Email: </b><a href="mailto:{{$user->email}}"><b>{{$user->email}}</b></a></h5>
            </span>
            <span class="pull-right">
                <h1 class="box-title">
                    &nbsp;
                </h1>
                <h5>
                    <a href="#" data-toggle="modal" data-target="#modal-default">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </h5>

            </span>
        </div>

        <div class="box-body">
            <form class="form-horizontal">
                @csrf
                <div class="box-body">
                    @if (isset($user->url))
                        <div class="form-group">
                            <label class="col-sm-2">URL</label>
                            <div class="col-sm-10">
                                <a href="{{$user->url}}">{{$user->url}}</a>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2">Language</label>
                        <div class="col-sm-10">
                            <p>{{$language}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Address</label>
                        <div class="col-sm-10">
                            @if (isset($user->city))
                                <p>{{$user->city}}, {{$country}}</p>
                            @else
                                <p>{{$country}}</p>
                            @endif

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Translation</label>
                        <div class="col-sm-10">
                            @if ($user->translation == 1)
                                <p>Yes</p>
                            @else
                                <p>No</p>
                            @endif

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Tags</label>
                        <div class="col-sm-10">
                            @if (isset($user->tags))
                                <p>{{$user->tags}}</p>
                            @else
                                <p>N/A</p>
                            @endif

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Is WorldWide</label>
                        <div class="col-sm-10">
                            @if($user->worldwide == 1)
                                <p>Yes</p>
                            @else
                                <p>No</p>
                            @endif

                        </div>
                    </div>



                    @if (isset($user->initial_requirement))
                        <div class="form-group">
                            <label class="col-sm-2">Initial Requirement</label>
                            <div class="col-sm-10">
                              <p>{{$user->initial_requirement}}</p>
                            </div>
                        </div>
                    @endif

                    @if (isset($user->note_to_partner))
                        <div class="form-group">
                            <label class="col-sm-2">Note To Partner</label>
                            <div class="col-sm-10">
                              <p>{{$user->note_to_partner}}</p>
                            </div>
                        </div>
                    @endif

                    @if (isset($user->partner_search_keyword))
                        <div class="form-group">
                            <label class="col-sm-2">Partner Search Keyword</label>
                            <div class="col-sm-10">
                              <p>{{$user->partner_search_keyword}}</p>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="col-sm-2">Date Of Communication</label>
                        <div class="col-sm-10">
                            <p>
                                {{date('M d Y, l', strtotime($user->date_of_communicatin))}}
                                {{-- {{date('M d Y, H:i, l', strtotime($user->date_of_communicatin))}} --}}
                                {{-- {{date('M d Y, H:i, l', strtotime($user->date_of_communicatin))}} --}}
                            </p>
                        </div>
                    </div>
                    @if (isset($user->twitter))
                        <div class="form-group">
                            <label class="col-sm-2">Twitter</label>
                            <div class="col-sm-10">
                              <p><a href="{{$user->twitter}}" target="_blank">{{$user->twitter}}</a></p>
                            </div>
                        </div>
                    @endif



                <div class="form-group">
                    <label class="col-sm-2">C2C Status</label>
                    <div class="col-sm-10">
                        @if ($user->c2c == 1)
                            <p>Yes</p>
                        @elseif ($user->c2c == 0)
                            <p>No</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2">Status</label>
                    <div class="col-sm-10">
                        @if ($user->status == 1)
                            <p>Created</p>
                        @elseif ($user->status == 2)
                            <b>Partner Searched</b>
			@elseif ($user->status == 3)
                            <b>Requested</b>
			@elseif ($user->status == 4)
                            <b>Converted</b>
                        @elseif ($user->status == 5)
                            <b>Introduced</b>
                        @endif
                    </div>
                </div>

                @if (isset($user->description))
                    <div class="form-group">
                        <label class="col-sm-2">Description</label>
                        <div class="col-sm-10">
                            {{$user->description}}
                        </div>
                    </div>
                @endif

                @if (isset($user->requirement))
                    <div class="form-group">
                        <label class="col-sm-2">Requirement For</label>
                        <div class="col-sm-10">
                            {{$user->requirement}}
                        </div>
                    </div>
                @endif



                </div>

          <!-- /.box -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            &nbsp;
{{-- onclick="createPartner()" --}}
        </div>
    </form>
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
            <form class="form-horizontal"  method="POST" action="{{route('updateLead')}}">
                    @csrf
                    <div hidden><input type="label" class="form-control" id="partnerId" name="id" value="{{$user->id}}"></div>
                    <div class="box-body">
                        <div class="form-group col-lg-6">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" placeholder="Enter Lead Name" id="leadName" name="name" value='{{$user->name}}' required>
                            </div>
                          </div>
                          <div class="form-group col-lg-6">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" placeholder="Enter Email Address" id="leadEmail" name="email" value='{{$user->email}}' required eamil readonly>
                            </div>
                          </div>

                          <div class="form-group col-lg-6">
                            <label class="col-sm-3 control-label">URL</label>
                            <div class="col-sm-12">
                              <input type="url" class="form-control" placeholder="Enter Lead URL" id="leadURL" name="url" value='{{$user->url ?? ""}}'>
                            </div>
                          </div>

                          <div class="form-group col-lg-6">
                              <label class="col-sm-3 control-label">City</label>
                              <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Enter City" id="partnerCity" name="city" value='{{$user->city ?? ""}}'>
                              </div>
                          </div>



                          <div class="form-group col-lg-6">
                             <label class="col-sm-3 control-label">Country</label>
                             <div class="col-sm-12">
                              <select class="form-control" id='partnerCountry' name="country">
                                  @foreach ($countryData as $country)
                                        @if ($country->id == $user->country)
                                            <option value="{{$country->id}}" selected>{{$country->value}}</option>
                                        @else
                                            <option value="{{$country->id}}">{{$country->value}}</option>
                                        @endif

                                  @endforeach
                              </select>
                              <div class="checkbox">
                                  <label>
                                      @if ($user->worldwide == 1)
                                        <input type="checkbox"  id='worldwide' name="worldwide" value="1" checked> Consider Worldwide
                                      @else
                                        <input type="checkbox"  id='worldwide' name="worldwide" value="1"> Consider Worldwide
                                      @endif

                                  </label>
                             </div>
                             <div class="checkbox">
                              <label>
                                  @if ($user->c2c == 1)
                                  <input type="checkbox"  id='c2c' name="c2c" value="1" checked> Can Do C2C
                                  @else
                                    <input type="checkbox"  id='c2c' name="c2c" value="1"> Can Do C2C
                                  @endif

                              </label>
                              </div>
                             </div>
                           </div>

                           <div class="form-group col-lg-6">
                              <label class="col-sm-3 control-label">Language</label>
                              <div class="col-sm-12">
                               <select class="form-control" id='language' name="language">
                                      @foreach ($languageList as $language)
                                          @if ($language->id == $user->language)
                                              <option value="{{$language->id}}" selected>{{$language->value}}</option>
                                          @else
                                              <option value="{{$language->id}}">{{$language->value}}</option>
                                          @endif
                                      @endforeach
                               </select>
                              <div class="checkbox">
                                  <label>
                                      @if ($user->translation == 1)
                                        <input type="checkbox" id='translation' name="translation" value="1" checked> Translation Email Send
                                      @else
                                        <input type="checkbox" id='translation' name="translation" value="1"> Translation Email Send
                                      @endif

                                  </label>
                              </div>
                              </div>
                          </div>

                          <div class="form-group col-lg-12">
                            <label class="col-sm-1 control-label">Date </label>

                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" value="{{date('m/d/Y', strtotime($user->date_of_communicatin))}}" readonly>
                                </div>
                            </div>
                        </div>

                          <div class="form-group col-lg-12">
                              <label class="col-sm-1 control-label">Tags </label>

                              <div class="col-sm-12">
                                  <textarea class="form-control" rows="3" id="partnerTags" placeholder="Enter Tags (Use Comma to separate tags)" style="resize: none;" name="tags"></textarea>
                              </div>
                          </div>

                          <div class="form-group col-lg-12">
                              <label class="col-sm-1 control-label">Initial&nbsp;Requirements</label>
                              <div class="col-sm-12">
                                  <textarea class="form-control" rows="5" id="initial_requirement" placeholder="Enter Initial Requirements" style="resize: none;" name="initial_requirement"></textarea>
                              </div>
                          </div>

                          <div class="form-group col-lg-12">
                              <label class="col-sm-1 control-label">Note&nbsp;to&nbsp;partner&nbsp;manager</label>
                              <div class="col-sm-12">
                                  <textarea class="form-control" rows="5" id="note_to_partner" placeholder="Enter note to partner manager" style="resize: none;" name="note_to_partner"></textarea>
                              </div>
                          </div>

                          <div class="form-group col-lg-12">
                              <label class="col-sm-1 control-label">Partner&nbsp;Search&nbsp;Keywords</label>
                              <div class="col-sm-12">
                                  <textarea class="form-control" rows="3" id="partner_search_keywords" placeholder="Enter Partner Search Keywords (Use Comma to separate keywords)" style="resize: none;" name="partner_search_keywords"></textarea>
                              </div>
                          </div>

                          <div class="form-group col-lg-12">
                            <label class="col-sm-1 control-label">Description</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="3" id="description" placeholder="Enter Lead Description" style="resize: none;" name="description"></textarea>
                            </div>
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="col-sm-1 control-label">Requirement&nbsp;for</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="3" id="requirement" placeholder="Enter Requirement For..." style="resize: none;" name="requirement"></textarea>
                            </div>
                        </div>

              <!-- /.box -->
            </div>
            <!-- /.box-body -->
            <div class="modal-footer">
                <div  style="width: 100%; height: auto; display: flex;align-items: center;justify-content: center;">
                    <button type="submit" class="btn btn-primary btn-flat" id="saveButton" >&nbsp; &nbsp; &nbsp; &nbsp; Save &nbsp; &nbsp; &nbsp; &nbsp;</button>
                </div>
    {{-- onclick="createPartner()" --}}
            </div>
        </form>
            </div>

        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>

$(document).ready(function(){
    document.getElementById("partnerTags").defaultValue = `{{$user->tags ?? ""}}`;
    document.getElementById("initial_requirement").defaultValue = `{{$user->initial_requirement ?? ""}}`;
    document.getElementById("note_to_partner").defaultValue = `{{$user->note_to_partner}}`;
    document.getElementById("partner_search_keywords").defaultValue = `{{$user->partner_search_keywords ?? ""}}`;
    document.getElementById("description").defaultValue = `{{$user->description ?? ""}}`;
    document.getElementById("requirement").defaultValue = `{{$user->requirement ?? ""}}`;

    var allErrors = ('{{$errors->first()}}');
    if(allErrors.includes('phone')){
        allErrors = allErrors.replace('phone', 'phone number');
    }
    if(allErrors){
        Swal.fire({
            title: 'Error!',
            text: allErrors,
            icon: 'error',
            confirmButtonText: 'Ok'
        }).then((result) => {
            location.reload();
        });
    }


});

function editPartner(){
    alert('Edit Partner');
}

</script>

@endSection
