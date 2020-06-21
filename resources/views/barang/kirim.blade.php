@extends('layouts.app')
@section('content')
<form action="{{url('barang/kirim-barang')}}" method="post" name="barang">
	{{csrf_field()}}
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#3399CC">
				<h3 style="color:white"><span class="fa fa-briefcase"></span> Kirim Barang</h3>
			</div>
			<div class="panel-body">
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Kode Pre Pengiriman</label>
						<input type="text" name="kd_pre_pengiriman" value="<?= $kd_pre_pengiriman ?>" placeholder="" class="form-control" required="" readonly="">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">No Resi</label>
						<input type="text" name="no_resi" value="{{$data->no_resi}}" placeholder="" required="" readonly="" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Kode User</label>
						<input type="text" name="kd_user" value="{{$data->user->kd_user}}" placeholder="" required="" readonly="" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label for="">Dari Kota</label>
					<select name="dari" id="dari" class="form-control" required="">
						<option value="">Pilih Wilayah</option>
						@foreach($from as $val)
							<option value="{{$val->wilayah}}">{{$val->wilayah}}</option>
						@endforeach
					</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Ke Kota</label>
						<select name="ke" id="kota" class="form-control" required="">
							<option value="">Pilih Wilayah</option>
							@foreach($to as $val)
							<option value="{{$val->wilayah}}">{{$val->wilayah}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Kecamatan</label>
						<select name="kecamatan" id="kecamatan" class="form-control" required="">
							<option value="">Pilih Kecamatan</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">kelurahan</label>
						<select name="kelurahan" id="kelurahan" class="form-control" required="">
							<option value="">Pilih Kelurahan</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Nama Penerima</label>
						<input type="text" name="nama" value="" autocomplete="off" placeholder="" class="form-control" id="trf" required="">
					</div>
				</div>
			
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Status Barang</label>
					<select name="status" id="" class="form-control" required="">
						<option value="">Pilih Status</option>
						<option value="Waiting To Take">Waiting To Take</option>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Pilih Kurir</label>
					<select name="kurir" id="" class="form-control" required="">
						<option value="">Pilih Kurir</option>	
						 	@foreach($kurir as $val)
							<option value="{{$val->id}}">{{$val->name}}</option>
							@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Alamat Lengkap</label>
					<textarea name="alamat" id="" class="form-control"></textarea>
				</div>
			</div>
			</div>
			<hr>
			<button type="submit" class="btn btn-primary" style="margin-left:2%" name="kirim">Kirim <span class="fa fa-send"></span></button>
		</div>
	</div>
</div>
</form>
@endsection
@push('js')
<script type="text/javascript">

$('#kota').change(function(){
	var wilayah = $('#kota').val();

	$.ajax({
		type : "GET",
		dataType : "JSON",
		url : "{{url('barang/get-kecamatan')}}",
		data : "wilayah=" + wilayah,
		success : function(msg){
			if(msg == ""){

			}
			else{
				$('#kecamatan').html(msg);
			}
		}
	});
});
$('#kecamatan').change(function(){
	var kecamatan = $('#kecamatan').val();
	var wilayah = $('#kota').val();
	$.ajax({
		type : "GET",
		dataType : "JSON",
		url : "{{url('barang/get-kelurahan')}}",
		data : {kecamatan : kecamatan,wilayah : wilayah},
		success : function(msg){
			if(msg == ""){

			}
			else{
				$('#kelurahan').html(msg);
			}
		}
	});
	$('#kota').change(function(){
		document.getElementById("kelurahan").innerHTML="<option>Pilih Kelurahan</option>"
	});
});

</script>

@endpush