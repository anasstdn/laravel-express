@extends('layouts.app')
@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<table id="example" class="table table-hovered">
					<thead>
						<th>Kode Pengiriman</th>
						<th>No Resi</th>
						<th>Dari Kota</th>
						<th>Ke Kota</th>
						<th>Tgl Pengiriman</th>
						<th>Tarif</th>
						<th>Status</th>
						<th>Nama Penerima</th>
						<th>Alamat Penerima</th>
						<th>Status</th>
					</thead>
					<tbody>
						<?php foreach ($data as $data): ?>
						<tr>
						<td><?= $data->kd_pengiriman ?></td>
						<td><?= $data->no_resi ?></td>
						<td><?= $data->dari_kota ?></td>
						<td><?= $data->ke_kota ?></td>
						<td><?= date('d-m-Y',strtotime($data->tgl_delivered)) ?></td>
						<td>Rp. <?= number_format($data->tarif,0,',','.') ?></td>
						<td><?= $data->status ?></td>
						<td><?= $data->nama_penerima ?></td>
						<td><?= $data->alamat_penerima ?></td>
						<td><?= $data->status ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection