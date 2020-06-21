@extends('layouts.app')

@section('content')
<style>
	@media print{
		.top_nav{
			display: none !important;
		}
		.a{
			display: none;
		}
		footer{
			display: none;
		}
		br{
			display:none;
		}
		p{
			display:block !important;
		}
	}
</style>
<form action="{{url('laporan-barang/search')}}" method="post">
	{{csrf_field()}}
	<div class="col-md-12">
		<div class="row">
			<h2><?= $judul ?></h2>
			<a onclick="window.print()" class="btn btn-primary a">Print Data <span class="fa fa-print"></span></a>
			<a href="{{url('/laporan-barang/wtt')}}" class="btn btn-success a">Status WTT</a>
			<a href="{{url('/laporan-barang/delay')}}" class="btn btn-success a">Status Delay</a>
			<a href="{{url('/laporan-barang/transit')}}" class="btn btn-success a">Status Transit</a>
			<a href="{{url('/laporan-barang/napv')}} " class="btn btn-success a">Status Not Approved</a>
			<a href="{{url('/laporan-barang/deliver')}}" class="btn btn-success a">Delivered</a>
			<a href="{{url('/laporan-barang/return')}}" class="btn btn-success a">Return</a>
			<!-- <p style="display:none">PT. PSend Jl.Raya Jendral Pramudya No.56 Caringin Bogor</p> -->
			<br>
			<br>
			<div class="form-inline">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-1">

							<h4 class="text-center a">Tanggal</h4>

						</div>
						<div class="form-group">
							<div class="col-md-5">

								<input type="date" name="awal" value="" placeholder="" class="form-control a">

							</div>
							<div class="col-md-2">
								<div class="row">
									<h4 class="text-center a">Sampai</h4>
								</div>
							</div>
							<div class="col-md-5">

								<input type="date" name="akhir" value="" placeholder="" class="form-control a">

							</div>
						</div>
						<button type="submit" class="btn btn-primary a" name="cari">Cari <span class="fa fa-search"></span></button>
					</div>
				</div>
			</div>


			<br>
			<table class="table table-bordered">
				<thead>
					<th>No</th>
					<th>Nama Barang</th>
					<th>No Resi</th>
					<th>Berat</th>
					<th>Panjang</th>
					<th>Dari Kota</th>
					<th>Ke Kota</th>
					<th>Nama Pelanggan</th>
					<th>Tarif</th>
					<th>Status</th>
					<th>Tanggal</th>
				</thead>
				<tbody>
					@if(isset($data) && !$data->isEmpty())
					@foreach($data as $key=>$val)
					<tr>
						<td>{{$key+1}}</td>
						<td>{{$val->nama_barang}}</td>
						<td>{{$val->no_resi}}</td>
						<td>{{$val->berat}} Kg</td>
						<td>{{$val->panjang}} cm</td>
						<td>{{$val->dari_kota}}</td>
						<td>{{$val->ke_kota}}</td>
						<td>{{\App\Models\User::find($val->id_user)->name}}</td>
						<td>Rp. {{number_format($val->tarif,0,',','.')}}</td>
						<td>{{$val->status}}</td>
						<td>{{date('d-m-Y',strtotime($val->tgl_pengiriman))}}</td>
					</tr>
					@endforeach
					@endif
					<tr>
						<td colspan="10">Total Barang</td>
						<td class="text-center"><?= count($data) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</form>
@endsection