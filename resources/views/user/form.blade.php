<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<form method="post" action="{{action('UserController@update', $id)}}">
			{{csrf_field()}}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">{{isset($data->kd_user)?$data->kd_user:''}}</h4>
				<input type="text" name="kd_user" value="" placeholder="" hidden>
			</div>	
			<div class="modal-body">
				<div class="col-md-4">
					<div class="form-group">
						<label>Nama User</label>
						<input type="text" class="form-control" name="user" autocomplete="off" value="{{isset($data->name)?$data->name:''}}" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" autocomplete="off" value="{{isset($data->email)?$data->email:''}}" placeholder="" class="form-control" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">No Telp</label>
						<input type="text" class="form-control" name="no_telp" autocomplete="off" class="form-control" value="{{isset($data->no_telp)?$data->no_telp:''}}" required >
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" name="username" autocomplete="off" placeholder="" value="{{isset($data->username)?$data->username:''}}">
					</div>
				</div>
				{{-- <div class="col-md-4"> --}}
					{{-- <div class="form-group">
						<label for="">Password</label>
						<input type="text" name="lpassword" placeholder="" value="" class="form-control" readonly>
					</div> --}}
				{{-- </div> --}}
				<div class="col-md-4">
					<div class="form-group">
						<label for="">New Password</label>
						<input type="password" name="npassword" value="" placeholder="" class="form-control">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="">Level</label>
						<select name="level" id="" class="form-control">
							@foreach($role as $r)
							<option value="{{$r->id}}" {{isset($data->roleUser->role_id) && $data->roleUser->role_id==$r->id?'selected':''}}>{{$r->display_name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<label for="" style="margin-left:30%">Jenis Kelamin</label>
					<div class="radio">
						<label for="" class="radio-inline" style="margin-left:10%"><input type="radio" name="gender" value="L" placeholder="" style="" {{isset($data->jenis_kelamin)?$data->jenis_kelamin=='L'?'checked':'':'checked'}} > Laki - Laki</label>
						<label for="" class="radio-inline" style="margin-left:10%"><input type="radio" name="gender" value="P" placeholder="" {{isset($data->jenis_kelamin)?$data->jenis_kelamin=='P'?'checked':'':''}}> Perempuan</label>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Alamat</label>
						<textarea name="alamat" id="" class="form-control">{{isset($data->alamat)?$data->alamat:''}}</textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="col-md-12">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close <span class="fa fa-close"></span></button>
					<button type="submit" class="btn btn-success" name="update" >Save changes <span class="fa fa-pencil"></span></button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#example').DataTable();
		tinymce.init({  
			selector: "textarea"  

		});  
	});
</script>