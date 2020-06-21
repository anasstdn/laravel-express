@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<div class="row">
		<table class="table table-bordered" id="example" style="width:100%">
			<thead>
				<th>Kode User</th>
				<th>Nama User</th>
				<th>Jenis Kelamin</th>
				<th>Alamat</th>
				<th>Email</th>
				<th>No Telp</th>
				<th>Username</th>
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
					@if($val->verified==true)
					<td><span class="badge badge-success" style="background-color: green">ACTIVE</span></td>
					@else
					<td><span class="badge badge-danger" style="background-color: red">INACTIVE</span></td>
					@endif
					<td>
						<a data-toggle='click-ripple' onclick='hapus("<?php echo url("user/".$val->id)?>")' class="btn btn-danger">Delete <span class="fa fa-trash"></span></a>
						<a onclick='show_modal("<?php echo url("user/".$val->id)."/edit"?>")' data-toggle="modal" class="btn btn-info">Edit <span class="fa fa-pencil"></span></a>
					</td>
				</tr>
				@endforeach
				@else
				<tr>
					<td> Data Kosong </td>
				</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

</div>
@endsection