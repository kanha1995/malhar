@extends('master')

@section('previewPartnersContent')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <section class="content-header">
      <h1>
        &nbsp;
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        @if (Request::is('previewPartner/*'))
            <li><a href="/managePartners"><i class="fa fa-users"></i> Manage Partners</a></li>
        @elseif (Request::is('previewMyPartner/*'))
            <li><a href="/manageLeadPartner"><i class="fa fa-handshake-o"></i> Manage Lead-Partner</a></li>
        @endif
        <li><a href="#">Preview Partner</a></li>
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
                    <small>&nbsp; &mdash; &nbsp;{{$user->partner_id}}</small>
                </h1>
                <h5><b>Email: </b><a href="mailto:{{$user->email}}"><b>{{$user->email}}</b></a></h5>
                <h5>
                    <b>Phone: </b>
                    @if (isset($user->phone))
                    <b>
                        <a href="tel:{{$user->phone}}">
                            {{$user->phone}}
                        </a>
                    </b>
                    @else
                         N/A
                    @endif
                </h5>
            </span>
            <span class="pull-right">
                @if (Request::is('previewPartner/*'))
                    <h1 class="box-title">
                        &nbsp;
                    </h1>
                    <h5><b>&nbsp;</b></h5>
                    <h5>
                        <a href="#" data-toggle="modal" data-target="#modal-default">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                    </h5>
                @endif


            </span>
        </div>

        <div class="box-body">
            <form class="form-horizontal">
                @csrf
                <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2">Address</label>
                    <div class="col-sm-10">
                      <p>
                          @if (isset($user->city))
                            {{$user->city}}, {{$country}}
                          @else
                            {{$country}}
                          @endif

                      </p>
                    </div>
                </div>
                @isset($user->tags)
                    <div class="form-group">
                        <label class="col-sm-2">Tags</label>
                        <div class="col-sm-10">
                          <p>{{$user->tags}}</p>
                        </div>
                    </div>
                @endisset


                @if (isset($user->linked_in))
                    <div class="form-group">
                        <label class="col-sm-2">LinkedIn</label>
                        <div class="col-sm-10">
                          <p><a href="{{$user->linked_in}}" target="_blank">{{$user->linked_in}}</a></p>
                        </div>
                    </div>
                @endif

                @if (isset($user->fb))
                    <div class="form-group">
                        <label class="col-sm-2">Facebook</label>
                        <div class="col-sm-10">
                          <p><a href="{{$user->fb}}" target="_blank">{{$user->fb}}</a></p>
                        </div>
                    </div>
                @endif

                @if (isset($user->fiverr))
                    <div class="form-group">
                        <label class="col-sm-2">Fiverr</label>
                        <div class="col-sm-10">
                          <p><a href="{{$user->fiverr}}" target="_blank">{{$user->fiverr}}</a></p>
                        </div>
                    </div>
                @endif

                @if (isset($user->twitter))
                    <div class="form-group">
                        <label class="col-sm-2">Twitter</label>
                        <div class="col-sm-10">
                          <p><a href="{{$user->twitter}}" target="_blank">{{$user->twitter}}</a></p>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label class="col-sm-2">Partner Type</label>
                    <div class="col-sm-10">
                        @if ($user->type == 1)
                            <p>Company</p>
                        @elseif ($user->type == 2)
                            <p>Freelancer</p>
                        @elseif ($user->type == 3)
                            <p>Both Company & Freelancer</p>
                        @else
                            <p>Unknown</p>
                        @endif
                    </div>
                </div>

                @isset($user->team_size)
                    <div class="form-group">
                        <label class="col-sm-2">Team Size</label>
                        <div class="col-sm-10">
                          <p>{{$user->team_size}}</p>
                        </div>
                    </div>
                @endisset


                <div class="form-group">
                    <label class="col-sm-2">Block Status</label>
                    <div class="col-sm-10">
                        @if ($user->block_status == 1)
                            <p>Blocked</p>
                        @elseif ($user->block_status == 0)
                            <p>UnBlocked</p>
                        @endif
                    </div>
                </div>

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
              <h4 class="modal-title" id="addPartnerLabel">Edit Partner</h4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal"  method="POST" action="{{route('updatePartner')}}">
                    @csrf
                    <div hidden><input type="label" class="form-control" id="partnerId" name="id" value="{{$user->id}}"></div>
                    <div class="box-body">
                    <div class="form-group col-lg-6">
                      <label class="col-sm-3 control-label">Name</label>
                      <div class="col-sm-12">
                      <input type="text" class="form-control" placeholder="Enter Partner Name" id="partnerName" name="name" value="{{$user->name}}" required>
                      </div>
                    </div>
                    <div class="form-group col-lg-6">
                      <label class="col-sm-3 control-label">Email</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="Enter Email Address" id="partnerEmail" name="email" value="{{$user->email}}" required eamil disabled>
                      </div>
                    </div>

                    <div class="form-group col-lg-6">
                      <label class="col-sm-5 control-label">Phone&nbsp;Number</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="Enter Phone Number" id="partnerPhone" name="phone" value="{{$user->phone}}">
                      </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label class="col-sm-5 control-label">Partner&nbsp;Type</label>
                        <div class="col-sm-12">
                         <select class="form-control" id='partnerType' name="partnerType">
                            @if ($user->type == 1)
                                <option value="1" selected>Company</option>
                                <option value="2">Freelancer</option>
                                <option value="3">Both</option>
                            @elseif ($user->type == 2)
                                <option value="1">Company</option>
                                <option value="2" selected>Freelancer</option>
                                <option value="3">Both</option>
                            @elseif ($user->type == 3)
                                <option value="1">Company</option>
                                <option value="2">Freelancer</option>
                                <option value="3" selected>Both</option>
                            @endif
                         </select>
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label class="col-sm-3 control-label">City</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="Enter City" id="partnerCity" name="city" value="{{$user->city}}">
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                       <label class="col-sm-3 control-label">Country</label>
                       <div class="col-sm-12">
                        <select class="form-control" id='partnerCountry' name="country">
                            @foreach ($countryData as $country)
                                @if ($user->country == $country->id)
                                    <option value="{{$country->id}}" selected>{{$country->value}}</option>
                                @else
                                    <option value="{{$country->id}}">{{$country->value}}</option>
                                @endif

                            @endforeach
                        </select>
                       </div>
                     </div>

                     <div class="form-group col-lg-6">
                        <label class="col-sm-3 control-label">LinkedIn</label>
                        <div class="col-sm-12">
                        <input type="url" class="form-control" placeholder="LinkedIn URL" id="linkedin" name="linkedin" value="{{$user->linked_in}}">
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label class="col-sm-3 control-label">FaceBook</label>
                        <div class="col-sm-12">
                          <input type="url" class="form-control" placeholder="FaceBook URL" id="facebook" name="facebook" value="{{$user->facebook}}">
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label class="col-sm-3 control-label">Fiverr</label>
                        <div class="col-sm-12">
                          <input type="url" class="form-control" placeholder="Fiverr URL" id="fiverr" name="fiverr" value="{{$user->fiverr}}">
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label class="col-sm-3 control-label">Twitter</label>
                        <div class="col-sm-12">
                          <input type="url" class="form-control" placeholder="Twitter URL" id="twitter" name="twitter" value="{{$user->twitter}}">
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label class="col-sm-5 control-label">Team Size</label>
                        <div class="col-sm-12">
                        <input type="number" class="form-control" placeholder="Enter Team Size" id="teamSize" name="teamSize" min="1" number value="{{$user->team_size}}">
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label class="col-sm-5 control-label">Can Do C2C</label>
                        <div class="col-sm-12">
                         <select class="form-control" id='c2c' name="c2c">
                            @if ($user->c2c == 1)
                                <option value="1" selected>Yes</option>
                                <option value="0">No</option>
                            @else
                                <option value="1">Yes</option>
                                <option value="0" selected>No</option>
                            @endif

                         </select>
                        </div>
                    </div>
                    {{-- <div class="form-group col-lg-6">
                        <label class="col-sm-3 control-label">&nbsp; </label>
                        <div class="col-sm-12">
                            <div class="checkbox">
                                <label>
                                    @if ($user->c2c == 1)
                                    <input type="checkbox" id='c2c' name="c2c" value="1" checked> Can Do C2C
                                    @else
                                    <input type="checkbox" id='c2c' name="c2c" value="1"> Can Do C2C
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div> --}}

                    <div class="form-group col-lg-6">
                        <label class="col-sm-3 control-label">Tags </label>

                        <div class="col-sm-12">
                            <textarea class="form-control" rows="3" id="partnerTags" placeholder="Enter Tags (Use Comma to separate tags)" style="resize: none;" name="tags"></textarea>
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



                {{-- '''''''''''''''''''''''''''''''''''''''' --}}
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
    document.getElementById("partnerTags").defaultValue = '{{$user->tags}}';

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
