@extends('master')

@section('emailPartnersContent')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Email Partner
        <small>&nbsp;</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Email Partner</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <form class="form-horizontal">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">
            &nbsp;

          </h3>
        </div>
        <div class="box-body">

                @csrf
                <div class="box-body">
                <div class="form-group">
                    <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8"><h2>&nbsp;</h2></div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-primary add-new"><i class="fa fa-plus"></i> Add New</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered" id="partnerEmail">
                        <thead>
                            <tr>
                                <th style="width: 15%">Name</th>
                                <th style="width: 15%">Email</th>
                                <th style="width: 15%">Location</th>
                                <th style="width: 15%"> AfterIntro Text</th>
                                <th style="width: 15%">Service</th>
                                <th style="width: 15%">Percentage</th>
                                <th style="width: 15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </div>
                </div>


          <!-- /.box -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div  style="width: 100%; height: auto; display: flex;align-items: center;justify-content: center;">
                <button type="button" class="btn btn-primary btn-flat" id="saveButton" onclick="sendEmailAction()">Send Email</button>
            </div>
{{-- onclick="createPartner()" --}}
        </div>

        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>

$(document).ready(function(){


  $('[data-toggle="tooltip"]').tooltip();
	// var actions = $("table td:last-child").html();
    var actions = `
		<a class="add" title="Save" data-toggle="tooltip"><i class="fa fa-check"></i>&nbsp;</a>
        <a class="edit" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil-square-o">&nbsp;</i></a>
        <a class="delete" title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o"></i></a>
    `;
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		$(this).attr("disabled", "disabled");
		var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +
            '<td><input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required data-name="name"></td>' +
            '<td><input type="text" class="form-control" name="email" id="email" placeholder="Enter Email Address" email required data-name="email"></td>' +
			'<td><input type="text" class="form-control" name="location" id="location" placeholder="Enter Location" required data-name="location"></td>' +
            '<td><input type="text" class="form-control" name="body" id="afterInfo" placeholder="AfterIntro Text" data-name="body"></td>' +
            '<td><input type="text" class="form-control" name="services" id="services" placeholder="Services" required data-name="service"></td>' +
            '<td><input type="text" class="form-control" name="percentage" id="percent" placeholder="Percentage" required number data-name="percent"></td>' +
            '<td>' + actions + '</td>' +
        '</tr>';
    	$("table").append(row);
		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });
	// Add row on add button click
	$(document).on("click", ".add", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
			if(!$(this).val() && ($(this).attr('name') != 'body')){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
			input.each(function(){
				$(this).parent("td").html($(this).val());
			});
			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new").removeAttr("disabled");
		}
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
	// Delete row on delete button click
	$(document).on("click", ".delete", function(){
        $(this).parents("tr").remove();
		$(".add-new").removeAttr("disabled");
    });

});

function sendEmailAction(){
    var table = document.getElementById("partnerEmail");
    var emailListArray = new Array();
    for (let i = 1 ; i < table.rows.length; i++) {
        let emailData = {
            'partnerName':  table.rows[i].cells[0].innerHTML,
            'partnerEmail':  table.rows[i].cells[1].innerHTML,
            'partnerLocation':  table.rows[i].cells[2].innerHTML,
            'partnerBody':  table.rows[i].cells[3].innerHTML,
            'partnerService':  table.rows[i].cells[4].innerHTML,
            'partnerPercent':  table.rows[i].cells[5].innerHTML
        };
        emailListArray.push(emailData);
    }
    if(emailListArray.length <= 0){
        Swal.fire({
            title: 'Alert!',
            text: 'Please add partner(s) to send email',
            icon: 'error',
            confirmButtonText: 'Ok'
        });
        return;
    }
    let finalBody = {"contacts": emailListArray}
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/sendPartnerEmail';
    const csrfField = document.createElement('input');
    csrfField.type = 'hidden';
    csrfField.name = '_token';
    csrfField.value = document.querySelector('meta[name="csrf-token"]').content;
    form.appendChild(csrfField);

    const hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = 'emailData';
    hiddenField.value = JSON.stringify(finalBody);
    form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();
}

</script>

@endSection
