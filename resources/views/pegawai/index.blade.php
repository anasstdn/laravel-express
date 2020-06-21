@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<div class="row">
		<table class="table table-bordered" id="example" style="width:100%">
			<thead>
				<th>Kode Pegawai</th>
				<th>Nama PEgawai</th>
				<th>Jenis Kelamin</th>
				<th>Alamat</th>
				<th>Email</th>
				<th>No Telp</th>
				<th>Username</th>
				<th>Region</th>
				<th>Status Aktif</th>
				<th>Action</th>
			</thead>
			<tbody>
				@if(isset($data) && !$data->isEmpty())
				@foreach($data as $key=>$val)
				<tr>
					<td>{{$val->kd_user}}</td>
					<td>{{$val->name}}</td>
					<td>{{$val->jenis_kelamin==null?'Data Kosong':$val->jenis_kelamin}}</td>
					<td>{{$val->alamat==null?'Data Kosong':$val->alamat}}</td>
					<td>{{$val->email==null?'Data Kosong':$val->email}}</td>
					<td>{{$val->no_telp==null?'Data Kosong':$val->no_telp}}</td>
					<td>{{$val->username}}</td>
					<td>{{$val->kd_region==null?'Data Kosong':$val->kd_region}}</td>
					@if($val->verified==true)
					<td><span class="badge badge-success" style="background-color: green">ACTIVE</span></td>
					@else
					<td><span class="badge badge-danger" style="background-color: red">INACTIVE</span></td>
					@endif
					<td>
						<a data-toggle='click-ripple' onclick='hapus("<?php echo url("pegawai/".$val->id)?>")' class="btn btn-danger">Delete <span class="fa fa-trash"></span></a>
						<a onclick='show_modal("<?php echo url("pegawai/".$val->id)."/edit"?>")' data-toggle="modal" class="btn btn-info">Edit <span class="fa fa-pencil"></span></a>
						@if($val->verified==true)
						<a class="btn btn-danger non" onclick='disable("<?php echo url("pegawai/".$val->id)."/disable"?>")' >Non-Active</a>
						@else
						<a class="btn btn-success non" onclick='activate("<?php echo url("pegawai/".$val->id)."/activate"?>")' >Activate</a>
						@endif
						
					</td>
				</tr>
				@endforeach
				@else
				<tr>
					<td colspan="9" class="text-center"> Data Kosong </td>
				</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

</div>
@endsection