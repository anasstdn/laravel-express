<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard | SistemEkspedisi</title>
   <link rel="stylesheet" href="{{asset('template/')}}/css/bootstrap.min.css">
   <link rel="stylesheet" href="{{asset('template/')}}/fa/css/font-awesome.css">
   <link href="{{asset('template/')}}/css/custom.min.css" rel="stylesheet">
   <link href="{{asset('toastr-master/')}}/build/toastr.css" rel="stylesheet" type="text/css" />
   {{-- <link href="{{asset('sweetalert-master/')}}/src/sweetalert.css" rel="stylesheet" type="text/css" /> --}}
   <link rel="stylesheet" href="{{asset('template/')}}/css/dataTables.bootstrap4.min.css">
   <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('layouts.header')
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-left">
            &copy; Copyright 2020
          </div>
          <div class="pull-right">
            Tugas PWSS  <a href="https://colorlib.com"></a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
   <script src="{{asset('template/')}}/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{asset('template/')}}/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('template/')}}/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('template/')}}/js/bootstrap.min.js"></script> 
     <script src="{{asset('template/')}}/js/tinymce/tinymce.min.js"></script>
     <script src="{{asset('toastr-master/')}}/build/toastr.min.js"></script>
     <script src="{{asset('sweetalert-master/')}}/docs/assets/sweetalert/sweetalert.min.js"></script>
    <!-- <script src="js/tinymce/jquery.tinymce.min.js"></script> -->

    <!-- FastClick -->
    <script src="{{asset('template/')}}/js/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{asset('template/')}}/js/bootstrap-progressbar.min.js"></script>
    <!-- Chart.js -->
    
    <script src="{{asset('template/')}}/js/custom.min.js"></script>


    <script type="text/javascript">
      @if ($errors->any())
      @foreach ($errors->all() as $error)
      toastr_notif("{!! $error !!}","gagal");
      @endforeach
      @endif
      @if(Session::get('messageType'))
      toastr_notif("{!! Session::get('message') !!}","{!! Session::get('messageType') !!}");
      <?php
      Session::forget('messageType');
      Session::forget('message');
      ?>
      @endif

     $(document).ready(function(){
    $('#example').DataTable();
      tinymce.init({  
        selector: "textarea"  
       
     });  
    });

     function show_modal(url) { // clear error string
      $.ajax({
        url:url,
        dataType: 'text',
        success: function(data) {
          $("#addPage").html(data);
          $("#addPage").modal('show');
        // todo:  add the html to the dom...
      }
    });
    };

function hapus(url) { // clear error string
    var token = $("meta[name='csrf-token']").attr("content");
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          // swal("Poof! Your imaginary file has been deleted!", {
          //   icon: "success",
          // });
          $.ajax({
            url : url,
            type: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': token
            },
            success:function(){
              swal('Berhasil dihapus!', ' ', 'success');

              setTimeout(function() {
  //your code to be executed after 1 second
  location.reload();
}, 1000);
            },
          });
        } else {
          swal("Data batal dihapus");
        }
      });
  }

  function disable(url) { // clear error string
    var token = $("meta[name='csrf-token']").attr("content");
    swal({
      title: "Nonaktif?",
      text: "Set status menjadi nonaktif?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          // swal("Poof! Your imaginary file has been deleted!", {
          //   icon: "success",
          // });
          $.ajax({
            url : url,
            type: 'GET',
            headers: {
              'X-CSRF-TOKEN': token
            },
            success:function(){
              swal('Nonaktif', ' ', 'success');

              setTimeout(function() {
  //your code to be executed after 1 second
  location.reload();
}, 1000);
            },
          });
        } else {
          swal("Batal");
        }
      });
  }

   function activate(url) { // clear error string
    var token = $("meta[name='csrf-token']").attr("content");
    swal({
      title: "Aktifkan user?",
      text: "Set status menjadi aktif?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          // swal("Poof! Your imaginary file has been deleted!", {
          //   icon: "success",
          // });
          $.ajax({
            url : url,
            type: 'GET',
            headers: {
              'X-CSRF-TOKEN': token
            },
            success:function(){
              swal('Aktif', ' ', 'success');

              setTimeout(function() {
  //your code to be executed after 1 second
  location.reload();
}, 1000);
            },
          });
        } else {
          swal("Batal");
        }
      });
  }

     function kirim(url) { // clear error string
      var token = $("meta[name='csrf-token']").attr("content");
      swal({
        title: "Kirim barang?",
        text: "Apakah anda yakin akan mengirimkan barang?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          // swal("Poof! Your imaginary file has been deleted!", {
          //   icon: "success",
          // });
          $.ajax({
            url : url,
            type: 'GET',
            headers: {
              'X-CSRF-TOKEN': token
            },
            success:function(){
              swal('Aktif', ' ', 'success');

              setTimeout(function() {
  //your code to be executed after 1 second
  location.reload();
}, 1000);
            },
          });
        } else {
          swal("Batal");
        }
      });
    }

     function toastr_notif(message,type)
     {
      if(type=='sukses')
      {
        var opts = {
          "closeButton": true,
          "debug": false,
          "positionClass": "toast-top-right",
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        };

        toastr.success(message, "Sukses", opts);
      }
      else
      {
        var opts = {
          "closeButton": true,
          "debug": false,
          "positionClass": "toast-top-right",
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        };

        toastr.warning(message, 'Peringatan', opts);
      }
    }

</script> 
@yield('js')  
@stack('js')
    
  </body>
</html>


