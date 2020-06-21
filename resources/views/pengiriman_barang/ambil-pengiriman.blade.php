@extends('layouts.app')
@section('content')
<form action="{{url('pengiriman-barang/simpan')}}" method="post">
{{csrf_field()}}
<div class="col-md-7 col-md-offset-2">
	<div class="row">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="text-center">Ambil Barang <span class="fa fa-cube"></span></h3>
		</div>
		<div class="panel-body" >
		<div class="col-md-5 col-md-offset-1">
			<div class="row">
			<h4>Kode Pre Pengiriman </h4>
			<h4>No Resi </h4>
			<h4>Dari Kota </h4>
			<h4>Ke Kota </h4>
			<h4>Current City </h4>
			<h4>Tanggal Pengiriman </h4>
			<h4>Tarif </h4>
			<h4>Status </h4>
			<h4>Kode User </h4>
			<h4>Kode Kurir </h4>
			<h4>Nama Penerima </h4>
			<h4>Alamat Penerima </h4>
			</div>
			
		</div>
		<div class="col-md-1">
			<h4>:</h4>
			<h4>:</h4>
			<h4>:</h4>
			<h4>:</h4>
			<h4>:</h4>
			<h4>:</h4>
			<h4>:</h4>
			<h4>:</h4>
			<h4>:</h4>
			<h4>:</h4>
			<h4>:</h4>
			<h4>:</h4>
		</div>
		<div class="col-md-5" >
			<div class="row">
			<h4>{{$data->kd_pre_pengiriman}}</h4>
			<h4>{{$data->no_resi}}</h4>
			<h4>{{$data->dari_kota}}</h4>
			<h4>{{$data->ke_kota}}</h4>
			<h4>{{$data->current_city}}</h4>
			<h4>{{date('d-m-Y',strtotime($data->tgl_pengiriman))}}</h4>
			<h4>Rp.{{number_format($data->tarif,0,',','.')}}</h4>
			<h4>{{$data->status}}</h4>
			<h4>{{\App\Models\User::find($data->id_user)->kd_user}}</h4>
			<h4>{{\App\Models\User::find($data->id_kurir)->kd_user}}</h4>
			<h4>{{$data->nama_penerima}}</h4>
			<h4>{!! $data->alamat_penerima !!}</h4>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="row">
			<div class="divider"></div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Perbarui Status</label>
					<select name="status" id="" class="form-control">
						<option value="">Pilih Status</option>
						<option value="In Transit">In Transit</option>
						<option value="On Delayed">On Delayed</option>
						<option value="On The Way">On The Way</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<label for="">Perbarui Lokasi</label>
				<select name="lokasi" id="" class="form-control">
					<option value="">Pilih Wilayah</option>
					@if(isset($wilayah) && !$wilayah->isEmpty())
					@foreach($wilayah as $val)
					<option value="{{$val->wilayah}}">{{$val->wilayah}}</option>
					@endforeach
					@endif
				</select>
			</div>
			<input type="text" name="kd_pre_pengiriman" value="{{$data->kd_pre_pengiriman}}" style="display: none">
			</div>
			<button type="submit" name="update" class="btn btn-primary btn-block">Update <span class="fa fa-pencil"></span></button>
			<button type="submit" class="btn btn-success btn-block" name="delivered">Mark As Delivered <span class="fa fa-check-circle"></span></button>
		</div>
		</div>
		</div>
	</div>
	</div>
</div>
</form>
@endsection