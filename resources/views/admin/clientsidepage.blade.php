<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Malhar Infoway</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>

    <div class="wrapper">
        <section class="content">
            <div class="box">
              <div class="box-header with-border">
                <h1 class="box-title"></h1>
              </div>
              <div class="box-body">
                  <h1>
                      Please wait while processsing your request &nbsp;
                    <i class="fa fa-refresh fa-spin" style="font-size:24px"></i>
                  </h1>
              </div>
            </div>
        </section>

    </div>
<script>
    window.onload = setTimeout(function(){
        Swal.fire({
            title: 'Success!',
            text: '{{$messageStatus}}',
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then((result) => {
           window.close();
        });
}, 5000);

</script>
</body>
</html>
