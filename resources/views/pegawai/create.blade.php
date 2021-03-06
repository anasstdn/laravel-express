@extends('layouts.app')
@section('content')
<form action="{{url('pegawai/simpan')}}" method="post" name="userin">
{{csrf_field()}}
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 style="color:#2243B6"><span class="fa fa-street-view"></span> Kelola Data Pegawai</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Kode User</label>
					<input type="text" name="kode" value="<?= $kd_pegawai ?>" placeholder="" readonly="" required="" class="form-control">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Nama Lengkap</label>
					<input type="text" name="user" value="" placeholder="" class="form-control" required="" autocomplete="off">
				</div>
			</div>
			<div class="col-md-4">
				<label for="" style="margin-left:30%">Jenis Kelamin</label>
				<div class="radio" style="font-size:16px">
					<label for="gender" class="radio-inline" style="margin-left:10%"><input type="radio" name="gender" value="L" placeholder="" required="">Laki - Laki</label>
					<label for="gender" class="radio-inline" style="margin-left:10%"><input type="radio" name="gender" value="P" placeholder="" required="">Perempuan</label>
					</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Username</label>
					<input type="text" name="username" value="" placeholder="" class="form-control" required="" autocomplete="off">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Password</label>
					<input type="password" name="password" value="" placeholder="" class="form-control" required="">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Re-type Password</label>
					<input type="password" name="rpassword" value="" placeholder="" class="form-control" required="" id="pass" onblur="return check()" style="border-color:green">
					<p style="color:red;display:none;" id="tpass">Password Berbeda</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Telephone</label>
					<input type="number" name="no_telp" value="" placeholder="" class="form-control" required="" id="telp" autocomplete="off" minlength="12" maxlength="12">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" name="email" value="" placeholder="Ex : Pramudyasaputra@gmail.com" class="form-control" required="" autocomplete="off">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Level</label>
					<select name="level" id="" class="form-control" required="">
						<option value="">Pilih Hak Akses</option>
						@foreach($role as $r)
							<option value="{{$r->id}}" {{isset($data->roleUser->role_id) && $data->roleUser->role_id==$r->id?'selected':''}}>{{$r->display_name}}</option>
						@endforeach
					</select>	
				</div>
			</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Region</label>
						<select name="kd_region" id="" class="form-control" required="">
							<option value="">-Silahkan Pilih-</option>
							@if(isset($region) && !$region->isEmpty())
							@foreach($region as $r)
							<option value="{{$r->kd_region}}" {{isset($data->kd_region) && $data->kd_region==$r->kd_region?'selected':''}}>{{$r->wilayah}}</option>
							@endforeach
							@endif
						</select>
					</div>
				</div>

			<div class="col-md-12">
				<div class="form-group">
					<label for="">Alamat</label>
					<textarea name="alamat" id="" cols="20" rows="10" class="form-control tinymce"></textarea>
				</div>
			</div>
		</div>
		<hr>
			<button type="submit" class="btn btn-primary" name="simpan" style="margin-left:85%;margin-bottom:2%" id="simpan">Simpan <span class="fa fa-save"></span></button>
	</div>
</div>
</form>
@endsection
@push('js')
<script>
	function check(){
    var pass1 = document.forms['userin']['password'].value;
    var pass2 = document.forms['userin']['rpassword'].value;
    if (pass1 != pass2) {
     	$(document).ready(function(){
     		$("#telp").on({
     			mouseenter:function(){
    			$('#pass').css("border-color","red");
    			$('#tpass').css("display","unset");
    			$('#simpan').hide();
    			},
    			mouseleave:function(){
    			$('#pass').css("border-color","red");
    			$('#tpass').css("display","unset");
    			$('#simpan').hide();
    			},
    			focus:function(){
    			$('#pass').css("border-color","red");
    			$('#tpass').css("display","unset");
    			$('#simpan').hide();
    			},
    			click:function(){
    			$('#pass').css("border-color","red");
    			$('#tpass').css("display","unset");
    			$('#simpan').hide();
    			},
    			mouseup:function(){
    			$('#pass').css("border-color","red");
    			$('#tpass').css("display","unset");
    			$('#simpan').hide();
    			},
    			keypress:function(){
    			$('#pass').css("border-color","red");
    			$('#tpass').css("display","unset");
    			$('#simpan').hide();
    			}
     			});
     		});
     	}
     	else {
     		$(document).ready(function(){
     		$("#telp").on({
     			mouseenter:function(){
    			$('#pass').css("border-color","green");
    			$('#tpass').css("display","none");
    			$('#simpan').show();
    			},
    			mouseleave:function(){
    			$('#pass').css("border-color","green");
    			$('#tpass').css("display","none");
    			$('#simpan').show();
    			},
    			focus:function(){
    			$('#pass').css("border-color","green");
    			$('#tpass').css("display","none");
    			$('#simpan').show();
    			},
    			click:function(){
    			$('#pass').css("border-color","green");
    			$('#tpass').css("display","none");
    			$('#simpan').show();
    			},
    			mouseup:function(){
    			$('#pass').css("border-color","green");
    			$('#tpass').css("display","none");
    			$('#simpan').show();
    			},
    			keypress:function(){
    			$('#pass').css("border-color","green");
    			$('#tpass').css("display","none");
    			$('#simpan').show();
    			}

     			});
     		});
     	}
     	
     }	

</script>
@endpush