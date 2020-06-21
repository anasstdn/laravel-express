@extends('layouts.app')
@section('content')
<style>
	@media print{
		.top_nav{
			display: none !important;
		}
		#jl{
			margin-bottom:2% !important;
			font-size:9px !important;
			margin-top:1.5% !important;
		}
		#struk{
			margin-top:1px !important;
		}
		#garis{
			margin-top:10px !important;
		}
		#btn{
			display: none;
		}
	}
</style>
<div class="col-md-6 col-md-offset-3">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
			<h3><span class="fa fa-car"></span> PSend</h3>
			<p style="margin-bottom:12%;font-size:9px;margin-top:-1.5%" id="jl">Jl.Jenderal Pramudya 16730 Bogor Center</p>
			<h4 style="margin-top:-50px" class="text-center" id="struk">Struk Pembayaran</h4>
			<hr style="margin-top:-5px" id="garis">
			<div class="col-md-4">
			<p>Kode Pengiriman </p>
			<p>No Resi </p>
			<p>Nama Barang</p>
			<p>Dari Kota</p>
			<p>Ke Kota</p>
			<p>Nama Pengirim</p>
			<p>Nama Penerima</p>
			<p>Alamat Penerima</p>
			<p>Tarif</p>
			<p>Tanggal Pengiriman</p>
			</div>
			<div class="col-md-1">
			<p>:</p>																						
			<p>:</p>
			<p>:</p>
			<p>:</p>
			<p>:</p>
			<p>:</p>
			<p>:</p>
			<p>:</p>
			<p>:</p>
			<p>:</p>	
			</div>
			<div class="col-md-6">
			<p>{{$data->kd_pre_pengiriman}}</p>
			<p>{{$data->no_resi}}</p>
			<p>{{$data->nama_barang}}</p>
			<p>{{$data->dari_kota}}</p>
			<p>{{$data->ke_kota}}</p>
			<p>{{\App\Models\User::find($data->id_user)->name}}</p>
			<p>{{$data->nama_penerima}}</p>
			{!!$data->alamat_penerima!!}
			<p>Rp.{{number_format($data->tarif,0,',','.')}}</p>
			<p>{{date('d-m-Y',strtotime($data->tgl_pengiriman))}}</p>
			</div>

			</div>
		</div>
		<a href="" class="btn btn-primary" id="btn" style="margin-left:86%" onclick="window.print()">Print <span class="fa fa-print"></span></a>
	</div>
</div>
<script>
	
</script>
@endsection