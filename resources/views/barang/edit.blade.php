@extends('layouts.app')
@section('content')
<form action="{{action('BarangController@update', $id)}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Edit Barang {{$data->no_resi}}<p style="margin-left:78%;margin-top:-2%">{{$data->created_at}}</p></h3>
		</div>
		<div class="panel-body">
			<div class="col-md-4">
				<div class="form-group">
					<select name="user" id="" placeholder="" class="form-control" required="">
						<option value="">Pilih User</option>
						@if(isset($user) && !$user->isEmpty())
						@foreach($user as $val)
						<option value="{{$val->id}}" {{$data->id_user==$val->id?'selected':''}}>{{$val->name}}</option>
						@endforeach
						@endif
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="nama" value="{{$data->nama_barang}}" placeholder="Nama Barang" class="form-control" required>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="file" name="gambar" value="" placeholder="" class="form-control" >
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="panjang" value="{{$data->panjang}}" placeholder="Panjang Barang(Cm)" class="form-control" required>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="berat" value="{{$data->berat}}" placeholder="Berat Barang(Kg)" class="form-control" required>
				</div>
			</div>
			<div class="col-md-4">
					<img src="{{ asset('images/') }}/barang/{{$data->gambar}}" alt="" style="margin-left:50%;width:20%;height:80px">
			</div>
			<div class="col-md-12" style="margin-top:-1%">
				<label for="">Keterangan :</label>
				<textarea name="keterangan" id="" cols="30" rows="10" class="form-control" required="">{{$data->keterangan}}</textarea>
			</div>
		</div>
		<hr>
			<a href="?pegawai=lihat_barang" class="btn btn-warning" style="margin-left:73%">Cancel <span class="fa fa-close"></span></a>
			<button class="btn btn-success" style="margin-left:82%;margin-top:-5.7%" name="update">Save Changes <span class="fa fa-pencil"></span></button>
	</div>
	
</div>
</form>
@endsection
