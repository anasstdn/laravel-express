@extends('layouts.app')
@section('content')
<div class="col-md-12">
	<form action="{{url('barang/simpan')}}" method="post" enctype="multipart/form-data">
		{{csrf_field()}}

		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#006699">
				<h3 style="color:white">Tambah Barang <i class="fa fa-cube"></i></h3>
			</div>
			<div class="panel-body">
				<div class="col-md-4">
					<div class="form-group">
						<label for="">No Resi Barang</label>
						<input type="text" name="resi" value="<?= $kd_resi_barang ?>" placeholder="" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Nama Pengirim</label>
						<select name="pengirim" id="" class="form-control" required="">
							<option value="">Pilih User</option>
							@if(isset($user) && !$user->isEmpty())
							@foreach($user as $val)
							<option value="{{$val->id}}">{{$val->name}}</option>
							@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Nama Barang</label>
						<input type="text" name="barang" value="" placeholder="" class="form-control" required="" autocomplete="off">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Berat</label>	
						<input type="number" name="berat" value="" placeholder="Kg" class="form-control" required="" autocomplete="off" min="1">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Panjang</label>
						<input type="number" name="panjang" value="" placeholder="Cm" class="form-control" required="" autocomplete="off" min="1">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Pilih Gambar</label>
						<input type="file" name="gambar" value="" placeholder="" class="form-control" required="" >
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Keterangan</label>
						<textarea name="keterangan" id="" cols="30" rows="10" class="form-control"  autocomplete="off"></textarea>
					</div>
				</div>

			</div>
			<div class="divider"></div>
			<button type="submit" class="btn btn-primary" name="simpan" style="margin-left:85%;width:10%;height:40px">Simpan <span class="fa fa-save"></span></button>

		</div>
	</form>
</div>
@endsection
