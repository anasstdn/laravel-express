 @extends('layouts.app')

@section('content')
 <style>
 	@media print{
		#a{
			display: none;
		}
		.top_nav{
 			display: none !important;
 		}
 		footer{
 			display: none;
 		}
 	}
 </style>
<div class="col-md-12">
	<div class="row">
		<h3>Data Pelanggan</h3>
		<a href="" class="btn btn-primary" onclick="window.print()" id="a">Print Data <span class="fa fa-print"></span></a>
		<table class="table table-bordered">
			<thead>
				<tr>
				<th>No</th>
				<th>Nama User</th>
				<th>Jenis Kelamin</th>
				<th>No Telp</th>
				<th>Email</th>
				<th class="text-center">Alamat</th>
				</tr>
			</thead>
			<tbody>
				@if(isset($data) && !$data->isEmpty())
				@foreach($data as $key => $val)
				<tr>
				<td><?= $key+1 ?></td>
				<td><?= $val->name ?></td>
				<td><?= $val->jenis_kelamin ?></td>
				<td><?= $val->no_telp ?></td>
				<td><?= $val->email ?></td>
				<td>{!! $val->alamat !!}</td>
				</tr>
				<tr>
				@endforeach
				@endif
					<td colspan="3" rowspan="3" class="text-center"><h2 style="margin-top:8%">Total Pelanggan</h2></td>
					<td rowspan="3" class="text-center"><h2 style="margin-top:18%"><?= $total ?></h2></td>
				</tr>
				<tr>
					<td colspan="1" class="text-center">Laki - Laki</td>
					<td class="text-center"><?= $total_male ?></td>
				</tr>
				<tr>
					<td colspan="1" class="text-center">Perempuan</td>
					<td class="text-center"><?= $total_female ?></td>
				</tr>
				
			</tbody>
		</table>
	</div>
</div>

@endsection