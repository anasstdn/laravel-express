@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
		<table class="table table-hover" id="example">
			<thead>
				<th>Kode Pre</th>
				<th>No Resi</th>
				<th>Dari Kota</th>
				<th>Ke Kota</th>
				<th>Tgl Pengiriman</th>
				<th>Tarif</th>
				<th>Status</th>
				<th>Nama Penerima</th>
				<th>Alamat Penerima</th>
				<th>Action</th>
			</thead>
			<tbody>
				@if(isset($data) && !$data->isEmpty())
				@foreach($data as $key=>$val)
				<tr>
					<td>{{$val->kd_pre_pengiriman}}</td>
					<td>{{$val->no_resi}}</td>
					<td>{{$val->dari_kota}}</td>
					<td>{{$val->ke_kota}}</td>
					<td>{{date('d-m-Y',strtotime($val->tgl_pengiriman))}}</td>
					<td>Rp.{{number_format($val->tarif,0,',','.')}}</td>
					<td>{{$val->status}}</td>
					<td>{{$val->nama_penerima}}</td>
					<td>{!!$val->alamat_penerima!!}</td>
					<td>
						<a href="<?php echo url("barang/".$val->kd_pre_pengiriman)."/transit"?>" class="btn btn-primary">Kirim <span class="fa fa-mail-forward"></span></a>
					</td>
				</tr>
				@endforeach
				@endif
				
			</tbody>
		</table>
		</div>
		</div>
	</div>
</div>
@endsection