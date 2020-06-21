@extends('layouts.app')
@section('content')
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<table class="table table-hovered" id="example">
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
						<td>{{$val->tarif}}</td>
						<td>{{$val->status}}</td>
						<td>{{$val->nama_penerima}}</td>
						<td>{!!$val->alamat_penerima!!}</td>
						<td>
							<a href="<?php echo url("pengiriman-barang/".$val->kd_pre_pengiriman)."/ambil-pengiriman"?>" class="btn btn-primary">Ambil <span class="fa fa-briefcase"></span></a>
						</td>
					</tr>
					@endforeach
					@else
					<tr>
						<td colspan="9" class="text-center"></td>
					</tr>
					@endif
					
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection