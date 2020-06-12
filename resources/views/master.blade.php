<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <title>Malhar :: Admin Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{url('public/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css" type="text/css" media="all">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('public/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url('public/bower_components/Ionicons/css/ionicons.min.css')}}">

  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{url('public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('public/dist/css/AdminLTE.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{url('public/dist/css/skins/_all-skins.min.css')}}">

  <!-- jvectormap -->
  <link rel="stylesheet" href="{{url('public/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{url('public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('public/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{url('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="{{url('public/bower_components/select2/dist/css/select2.min.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="sweetalert2.all.min.js"></script>
  <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue fixed sidebar-mini" onunload="">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Malhar</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Malhar</b> Admin Panel</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{url('public/dist/img/myAvtar.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{url('public/dist/img/myAvtar.jpg')}}" class="img-circle" alt="User Image">

                <p>
                    {{Auth::user()->name}}
                  <small>{{Auth::user()->email}}</small>
                  @if(auth()->user()->role == 1)
                    <small>Super Admin Since {{date('M Y', strtotime(Auth::user()->created_at))}}</small>
                  @elseif(auth()->user()->role == 2)
                    <small>Lead Admin Since {{date('M Y', strtotime(Auth::user()->created_at))}}</small>
                  @elseif(auth()->user()->role == 3)
                    <small>Partner Manager Since {{date('M Y', strtotime(Auth::user()->created_at))}}</small>
                  @elseif(auth()->user()->role == 4)
                    <small>Project Manager Since {{date('M Y', strtotime(Auth::user()->created_at))}}</small>
                  @endif
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                    <a href="#" data-toggle="modal" data-target="#modal-default" class="btn btn-primary btn-flat">Change Password</a>
                  </div>
                <div class="pull-right">
                  <a href="#" onClick="logOutAction()" class="btn btn-danger btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('public/dist/img/myAvtar.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{auth()->user()->name}}</p>
          @if(auth()->user()->role == 1)
            <h6>Super Admin</h6>
          @elseif(auth()->user()->role == 2)
            <h6>Lead Admin</h6>
          @elseif(auth()->user()->role == 3)
            <h6>Partner Manager</h6>
          @elseif(auth()->user()->role == 4)
            <h6>Project Manager</h6>
          @endif
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        @if((Auth::user()->role == 1) || (Auth::user()->role == 2))
            <li class="header"><b>Lead Management Section</b></li>
            <li class="{{ Request::is('manageLeads') ? 'active' : '' }}">
              <a href="{{route('manageLeads')}}">
                <i class="fa fa-users"></i> <span>Manage Leads</span>
              </a>
            </li>
            <li class="{{ Request::is('addLead') ? 'active' : '' }}">
                <a href="{{route('addLead')}}">
                  <i class="fa fa-user-plus"></i> <span>Add Leads</span>
                </a>
            </li>
            <li class="{{ Request::is('manageLeadPartner') ? 'active' : '' }}">
                <a href="{{route('manageLeadPartner')}}">
                  <i class="fa fa-handshake-o"></i> <span>Manage Lead-Partner</span>
                </a>
            </li>
        @endif

        @if((Auth::user()->role == 1) || (Auth::user()->role == 3))
            <li class="header"><b>Partner Management Section</b></li>
            <li class="{{ Request::is('managePartners') ? 'active' : '' }}">
              <a href="{{route('managePartners')}}">
                <i class="fa fa-users"></i> <span>Manage Partners</span>
              </a>
            </li>
            <li class="{{ Request::is('addPartner') ? 'active' : '' }}">
                <a href="{{route('addPartner')}}">
                  <i class="fa fa-user-plus"></i> <span>Add Partner</span>
                </a>
            </li>
            <li class="{{ Request::is('contactPartners') ? 'active' : '' }}">
                <a href="{{route('contactPartners')}}">
                  <i class="fa fa-envelope-o"></i> <span>Contact Partners</span>
                </a>
            </li>
            <li class="{{ Request::is('partnerSearchRequest') ? 'active' : '' }}">
                <a href="{{route('partnerSearchRequest')}}">
                  <i class="fa fa-search"></i> <span>Partner search request</span>
                </a>
            </li>
        @endif

        @if((Auth::user()->role == 1) || (Auth::user()->role == 4))
            <li class="header"><b>Project Management Section</b></li>
            <li class="{{ Request::is('manageProjects') ? 'active' : '' }}">
              <a href="{{route('manageProjects')}}">
                <i class="fa fa-tasks"></i> <span>Manage Projects</span>
              </a>
            </li>
        @endif

        @if(Auth::user()->role == 1)
            <li class="header"><b>Admin Management Section</b></li>
            <li class="{{ ((Request::is('manageAdmins')) || (Request::is('manageAdmin/*'))) ? 'active' : '' }}">
                <a href="{{route('manageAdmins')}}">
                  <i class="fa fa-user-circle-o"></i> <span>Manage Admins</span>
                </a>
            </li>
            <li class="{{ Request::is('addAdmin') ? 'active' : '' }}">
                <a href="{{route('addAdmin')}}">
                  <i class="fa fa-user-plus"></i> <span>Add Admin</span>
                </a>
            </li>


        @endif
      </ul>
    </section>
    </aside>
    <!-- /.sidebar -->

  <!-- content-wrapper -->
    @if(Request::is('managePartners'))
        @yield('mangePartner')
    @elseif(Request::is('addPartner'))
        @yield('addPartnersContent')
    @elseif(Request::is('previewPartner/*') || Request::is('previewMyPartner/*'))
        @yield('previewPartnersContent')
    @elseif(Request::is('contactPartners'))
        @yield('emailPartnersContent')
    @elseif(Request::is('manageLeads'))
        @yield('manageLeads')
    @elseif(Request::is('addLead'))
        @yield('addLeadsContent')
    @elseif(Request::is('previewLead/*'))
        @yield('previewLeadsContent')
    @elseif(Request::is('manageLeadPartner'))
        @yield('manageLeadPartnerContent')
    @elseif(Request::is('partnerSearchRequest'))
        @yield('mangePartnerSearchRequest')
    @elseif(Request::is('manageAdmins') || (Request::is('manageAdmin/*') ))
        @yield('mangeAdmins')
    @elseif(Request::is('addAdmin'))
        @yield('addAdminContent')
    @elseif(Request::is('manageProjects'))
        @yield('manageProjectsContent')
    @endif



    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="addPartnerLabel">Change Password</h4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal"  method="POST" action="{{route('changePassword')}}">
                    @csrf
                    <div hidden><input type="label" class="form-control" id="id" name="id"></div>
                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" placeholder="Enter Admin Password" id="password" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" placeholder="Re-Enter Admin Password" name="password_confirmation" id="password-confirm">
                            </div>
                        </div>


                    </div>
            </div>
            <div class="modal-footer">
                <div  style="width: 100%; height: auto; display: flex;align-items: center;justify-content: center;">
                    <button type="submit" class="btn btn-primary btn-flat" id="saveButton" >&nbsp; &nbsp; &nbsp; &nbsp; Save &nbsp; &nbsp; &nbsp; &nbsp;</button>
                </div>
            </div>
            </form>
            </div>
        </div>
      </div>
  <!-- /.content-wrapper -->



  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.1.2
    </div>
    <strong>&copy; Copyright <a href="http://malharinfoway.com/">Malhar Infoway</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{url('public/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('public/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('public/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- Sparkline -->
<script src="{{url('public/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{url('public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{url('public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('public/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('public/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{url('public/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{url('public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{url('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{url('public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url('public/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('public/dist/js/adminlte.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{url('public/dist/js/demo.js')}}"></script>
<!-- DataTables -->
<script src="{{url('public/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<!-- Select2 -->
<script src="{{url('public/bower_components/select2/dist/js/select2.full.min.js')}}"></script>


<!-- CK Editor -->
<script src="{{url('public/bower_components/ckeditor/ckeditor.js')}}"></script>
<script>
  $(document).ready(function(){
    showMessages();
});

function showMessages(){
    var allErrors = ('{{$errors->first()}}');
    if(allErrors.includes('phone')){
        allErrors = allErrors.replace('phone', 'phone number');
    }
    if(allErrors){
        Swal.fire({
            title: 'Sorry!',
            text: allErrors,
            icon: 'error',
            confirmButtonText: 'Ok'
        }).then((result) => {
            location.reload();
        });
    }
    var allSuccess = ('{{session("status")}}');
    if(allSuccess){
        Swal.fire({
            title: 'Success!',
            text: allSuccess,
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then((result) => {
           let flashMessage = '{{Session::forget("status")}}';
        });
    }

}
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    function logOutAction(){
      Swal.fire({
        title: 'Alert!',
        text: 'Are you sure you want to logout?',
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        confirmButtonColor: '#d33724',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            var url = '{{ route("logoutAction") }}';
            window.location.href = url;
  }});
    }
</script>
</body>
</html>
