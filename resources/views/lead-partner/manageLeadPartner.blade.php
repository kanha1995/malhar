@extends('master')

@section('manageLeadPartnerContent')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Lead-Partner List
        <small>Manage the Lead-Partner list</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Manage Lead-Partner List</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Lead-Partners' List</h3>
        </div>
        <div class="box-body">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                  <button type="button" class="btn btn-flat btn-primary"
                  id='sendButton' name="sendButton">
                    Send Email
                  </button>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="partnerTable" class="table table-bordered table-striped display">
                <thead>
                <tr>
                  <th><input type="checkbox" id="topCheckBox" onclick="checkAllAction()"></th>
                  <th>#</th>
                  <th>Lead Name</th>
                  <th>Lead ID</th>
                  <th>Lead Email</th>
                  <th>Partner Name</th>
                  <th>Partner ID</th>
                  <th>Partner Email</th>

                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $index = 1;
                    @endphp

                    @foreach ($partners as $partner)

                    <tr>
                        <td>
                            <input type="checkbox" class="checkBoxes" data-value="{{$status[$index - 1]}}"  onclick="checkboxAction('{{$index - 1}}')">
                        </td>
                        <td>{{$index++}}</td>
                        <td>
                            {{$leads[$index - 2]->name}}
                            @php
                            $currentLeadID = $leads[$index - 2]->lead_id;
                            @endphp
                        </td>
                        <td>
                            {{$leads[$index - 2]->lead_id}}
                        </td>
                        <td>
                            {{$leads[$index - 2]->email}}
                        </td>
                        <td>
                            {{$partner->name}}
                        </td>
                        <td>
                            {{$partner->partner_id}}
                        </td>
                        <td>
                            {{$partner->email}}
                        </td>
                        <td>
                            @if ($status[$index - 2] == 1)
                                Created
                            @elseif ($status[$index - 2] == 2)
                                Accepted
                            @elseif ($status[$index - 2] == 3)
                                Email Sent
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-flat">Action</button>
                                <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="previewMyPartner/{{$partner->id}}">View</a></li>
                                  <li><a href="#" data-toggle="modal" data-target="#modal-default"onclick="setLeadPartnerID('{{$partner->partner_id}}', '{{$currentLeadID}}', '{{$leads[$index - 2]->name}}' , '{{$partner->name}}')">Convert to project</a></li>
                                  <li><a href="#" onclick="deleleteAction('{{$partner->partner_id}}')">Delete</a></li>
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

      {{-- Make the Model --}}
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Convert to Project</h4>
            </div>
            <div class="modal-body">
              <div class="input-group">

                <div class="form-group col-lg-12">
                    <label class="col-sm-3 control-label">Lead Name </label>

                    <div class="col-sm-6">
                        <input type="text" class="form-control pull-right" id="leadName" name="leadName" value="" readonly>
                        <input id="leadID" name="leadID" value="" hidden>
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label class="col-sm-3 control-label">Partner Name </label>

                    <div class="col-sm-6">
                        <input type="text" class="form-control pull-right" id="partnerName" name="partnerName" value="" readonly>
                        <input id="partnerID" name="partnerID" value="" hidden>
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label class="col-sm-3 control-label">Start Date </label>

                    <div class="col-sm-6">
                        <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepickerStart" name="datepickerStart" value="{{date('m/d/Y', time())}}" readonly onchange="numberOfDaysCalculationShow()">
                        </div>
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label class="col-sm-3 control-label">End Date </label>
                    <div class="col-sm-6">
                        <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepickerEnd" name="datepickerEnd" value="{{date('m/d/Y', time())}}" readonly onchange="numberOfDaysCalculationShow()">
                        </div>
                    </div>
                </div>
                <div class="form-group col-lg-12">
                    <label class="col-sm-12 control-label" id="numberOfDays">Number of Days required to complete the project: 1 </label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="saveButton" onclick="saveButtonAction()">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->





    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
function getNumberOfDays(startDate, endDate){
    var date1 = new Date(startDate);
    var date2 = new Date(endDate);

    // To calculate the time difference of two dates
    var Difference_In_Time = date2.getTime() - date1.getTime();

    // To calculate the no. of days between two dates
    var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

    return Difference_In_Days;
}
$(document).ready(function(){
    document.getElementById("saveButton").disabled = true;
    //Date picker
    $('#datepickerStart').datepicker({
      autoclose: true,
      startDate: new Date()
    })

    $('#datepickerEnd').datepicker({
        autoclose: true,
        startDate: new Date()
    })


    let sendButton = document.getElementById('sendButton');
    sendButton.disabled = true;
    let example = $('#partnerTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      'responsive'  : true
    });

    let allCheckBoxes = document.getElementsByClassName('checkBoxes');
    for (let index = 0; index < allCheckBoxes.length; index++) {
        const element = allCheckBoxes[index];
        if(element.getAttribute('data-value') != '1'){
            element.disabled = true;
        }

    }
});

function deleleteAction(partnerId){

    Swal.fire({
        title: 'Alert!',
        text: 'Are you sure you want to delete the record?',
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        confirmButtonColor: '#d33724',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            var url = '{{ route("deleteLeadPartner", ":id") }}';
            url = url.replace(':id',partnerId);
            window.location.href = url;
  }});
}

function blockAction(partnerId){
    alert(partnerId);
}

function sendEmailButtonAction(leadPartnerDataTable){

    var emailListArray = new Array();
    for (let index = 0; index < leadPartnerDataTable.rows('.selected').data().length; index++) {
        const element = leadPartnerDataTable.rows('.selected').data()[index];
        let currentEmail = {"leadId": element[3], "partnerId": element[6], "name": element[5], "email": element[7]};
        emailListArray.push(currentEmail);
    }
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/sendLeadEmail';
    const csrfField = document.createElement('input');
    csrfField.type = 'hidden';
    csrfField.name = '_token';
    csrfField.value = document.querySelector('meta[name="csrf-token"]').content;
    form.appendChild(csrfField);

    const hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = 'emailData';
    hiddenField.value = JSON.stringify(emailListArray);
    form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();
}

function setLeadPartnerID(partnerId, leadId, leadName, partnerName){
    document.getElementById('leadID').value = leadId;
    document.getElementById('partnerID').value = partnerId;
    document.getElementById('leadName').value = leadName;
    document.getElementById('partnerName').value = partnerName;
}

function numberOfDaysCalculationShow(){
    let startDate = document.getElementById("datepickerStart").value;
    let endDate = document.getElementById("datepickerEnd").value;
    let numberOfDays = getNumberOfDays(startDate, endDate) + 1;

    if(numberOfDays <= 0){
        document.getElementById("saveButton").disabled = true;
        document.getElementById("numberOfDays").innerText = 'Number of Day(s) required to complete the project: ' + 'Invalid';
        return;
    }
    document.getElementById("saveButton").disabled = false;
    document.getElementById("numberOfDays").innerText = 'Number of Day(s) required to complete the project: ' + numberOfDays;
}

function saveButtonAction(){
    let startDate = document.getElementById("datepickerStart").value;
    let endDate = document.getElementById("datepickerEnd").value;
    let numberOfDays = getNumberOfDays(startDate, endDate) + 1;
    let leadID = document.getElementById("leadID").value;
    let partnerID = document.getElementById("partnerID").value;
    let projectData = {"start_date": startDate, "end_date": endDate, "lead_id": leadID, "partner_id": partnerID};

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/createProject';
    const csrfField = document.createElement('input');
    csrfField.type = 'hidden';
    csrfField.name = '_token';
    csrfField.value = document.querySelector('meta[name="csrf-token"]').content;
    form.appendChild(csrfField);

    const hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = 'projectData';
    hiddenField.value = JSON.stringify(projectData);
    form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();
}

function checkAllAction(){
    let example = $('#partnerTable').DataTable();
    let headerCheckBox = document.getElementById('topCheckBox');
    let allCheckBoxes = document.getElementsByClassName('checkBoxes');

    for (let index = 0; index < allCheckBoxes.length; index++) {
        const element = allCheckBoxes[index];
        if(element.getAttribute('data-value') === '1'){
            if(element.checked && !headerCheckBox.checked){
                element.checked = false;
                example.rows(index).deselect();
            }else{
                element.checked = true;
                example.rows(index).select();
            }
        }

    }
    updateSendButtonStatus(example);
}

function checkboxAction(id){
    let example = $('#partnerTable').DataTable();
    let currentCheckBox = document.getElementsByClassName('checkBoxes')[id];
    if(currentCheckBox.getAttribute('data-value') === '1'){
        if(!currentCheckBox.checked){
            currentCheckBox.checked = false;
            example.rows(id).deselect();
        }else{
            currentCheckBox.checked = true;
            example.rows(id).select();
        }
    }
    updateSendButtonStatus(example);
}


function updateSendButtonStatus(example){
    if((example.rows({
            selected: true
        }).count()) == 0){
        sendButton.disabled = true;
    }else{
        sendButton.disabled = false;
    }
    sendButton.addEventListener('click', function(){
        sendEmailButtonAction(example);
    })

    var checkBoxCount = 0;
    let allCheckBoxes = document.getElementsByClassName('checkBoxes');
    for (let index = 0; index < allCheckBoxes.length; index++) {
        const element = allCheckBoxes[index];
        if(element.getAttribute('data-value') === '1'){
            checkBoxCount = checkBoxCount + 1;
        }

    }


    let headerCheckBox = document.getElementById('topCheckBox');
    if((example.rows({
            selected: true
        }).count()) == checkBoxCount){
            headerCheckBox.value = 1;
            headerCheckBox.checked = true;
    }else{
            headerCheckBox.value = 0;
            headerCheckBox.checked = false;
    }
}



</script>

@endSection
