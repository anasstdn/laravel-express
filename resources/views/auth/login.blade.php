<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | SistemEkspedisi</title>
    <link rel="stylesheet" href="{{asset('template/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('template/')}}/fa/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="{{asset('template/')}}/css/style.css">
    <link href="{{asset('toastr-master/')}}/build/toastr.css" rel="stylesheet" type="text/css" />
</head>
<body background="{{asset('template/')}}/image/pr.jpg" style="margin-left:02%">

<div class="container">
    <form action="{{ route('login') }}" method="post" name="logins">
    {{ csrf_field() }}

    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    @if(session('warning'))
    <div class="alert alert-warning">
        {{session('warning')}}
    </div>
    @endif

    <div class="col-md-6 col-md-offset-3">
    <div class="row">
        <div class="panel panel-primary" style="margin-top:30%" >
            <div class="panel-heading" style="background-color:#0066CC">
                <h4 class="text-center" style="color:white">Login</h4>
            </div>
            <div class="panel-body" >
                <div class="col-md-12">
                    
                    <div class="row">
                        <div class="input-group {{$errors->has('username') || $errors->has('email')?'has-error':''}}">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="login" value="{{ old('username')?:old('email') }}" placeholder="Username" class="form-control" required="">
                            @if ($errors->has('email') || $errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username')?:$errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <br>
                        <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <span class="input-group-addon"><i class="fa fa-unlock"></i></span>
                            <input type="password" name="password" id="password" value="" placeholder="Password" class="form-control" required="">
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary"><span class="fa fa-sign-in" id="lname"> Login </span></button>
            </div>
        </div>
        
    </div>
    </form>
    </div>
</div>
<script src="{{asset('template/')}}/js/jquery-3.2.1.min.js" ></script>
<script src="{{asset('template/')}}/js/bootstrap.min.js"></script> 
<script src="{{asset('toastr-master/')}}/build/toastr.min.js"></script>
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
</body>
</html>