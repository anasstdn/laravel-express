@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<table id="example" class="table table-hover" style="width:100%">
					<thead>
						<tr>
							<th>No Resi</th>
							<th>Kode User</th>
							<th>Nama Barang</th>
							<th>Panjang</th>
							<th>Berat</th>
							<th>Keterangan</th>
							<th>Dibuat Tanggal</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						@if(isset($data) && !$data->isEmpty())
						@foreach($data as $key=>$val)
						<tr>
							<td>{{$val->no_resi}}</td>
							<td>{{$val->user->kd_user}}</td>
							<td>{{$val->nama_barang}}</td>
							<td>{{$val->panjang}} Cm</td>
							<td>{{$val->berat}} Kg</td>
							<td>{{$val->keterangan}}</td>
							<td>{{date('d-m-Y H:i:s',strtotime($val->created_at))}}</td>
							<td>
								<div class="btn-group">
									<a onclick='hapus("<?php echo url("barang/".$val->no_resi)?>")' class="btn btn-danger"><span class="fa fa-trash"></span></a>
									<a href="<?php echo url("barang/".$val->no_resi)."/edit"?>" class="btn btn-info"><span class="fa fa-pencil"></span></a>
									<a href="<?php echo url("barang/".$val->no_resi)."/kirim"?>" class="btn btn-primary">Kirim <span class="fa fa-send"></span></a>	
								</div>
							</td>
						</tr>
						@endforeach
						@else
						<tr>
							<td colspan="7" class="text-center">Data Kosong</td>
						</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection