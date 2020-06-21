@extends('layouts.app')

@section('content')
<?php 
if($mode=='create')
{
	$url=url('tarif/simpan');
}
else
{
	$url=action('TarifController@update', $id);
}
?>
<form action="{{$url}}" method="post">
	{{csrf_field()}}
<div class="col-md-12">
	<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 style="color:#299617"><span class="fa fa-money"></span> Kelola Tarif</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Kode Route</label>
					<input type="" name="kd_route" value="{{$mode=='create'?$kd_route:$edit->kd_route}}" placeholder="" class="form-control" required="" readonly="">
				</div>
				<div class="form-group">
					<label for="">Tarif</label>
					<input type="number" name="tarif" min="5000" value="{{$mode=='create'?'':$edit->tarif}}" placeholder="" class="form-control" required="" >
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Dari Kota</label>
					<select name="dari_kota" id="" class="form-control" required="">
						<option value="">-Silahkan Pilih-</option>
							@if(isset($region) && !$region->isEmpty())
							@foreach($region as $r)
							<option value="{{$r->wilayah}}" {{isset($edit)?$edit->dari_kota==$r->wilayah?'selected':'':''}}>{{$r->wilayah}}</option>
							@endforeach
							@endif
					</select>
				</div>
				<div class="form-group">
					<label for="">Ke Kota</label>
					<select name="ke_kota" id="" class="form-control" required="">
						<option value="">-Silahkan Pilih-</option>
							@if(isset($region) && !$region->isEmpty())
							@foreach($region as $r)
							<option value="{{$r->wilayah}}" {{isset($edit)?$edit->ke_kota==$r->wilayah?'selected':'':''}}>{{$r->wilayah}}</option>
							@endforeach
							@endif
					</select>
				</div>
			</div>
			<div class="col-md-12">
				
				@if($mode=='create')
				<button type="submit" class="btn btn-primary" name="simpan">Simpan <span class="fa fa-save"></span></button>
				@else
				<button type="submit" class="btn btn-success" name="update">Update <span class="fa fa-pencil"></span></button>	
				<a href="{{url('/tarif')}}" class="btn btn-warning">Cancel <span class="fa fa-close"></span></a>
				@endif
				
				
			</div>
			<div class="col-md-12" style="margin-top:2%">

				<table class="table table-bordered" id="example">
			<thead>
				<th>Kode Route</th>
				<th>Dari Kota</th>
				<th>Ke Kota</th>
				<th>Tarif</th>
				<th class="text-center">Action</th>
			</thead>
			<tbody>
				@if(isset($data) && !$data->isEmpty())
				@foreach($data as $key=>$val)
				<tr>
					<td>{{$val->kd_route}}</td>
					<td>{{$val->dari_kota}}</td>
					<td>{{$val->ke_kota}}</td>
					<td>Rp. {{number_format($val->tarif,0,',','.')}}</td>
					<td>
						<div class="btn-group" style="margin-left:25%">
							<a onclick='hapus("<?php echo url("tarif/".$val->kd_route)?>")' class="btn btn-danger">Delete <span class="fa fa-trash"></span></a>
							<a href="<?php echo url("tarif/".$val->kd_route)."/edit"?>" class="btn btn-info">Edit <span class="fa fa-pencil"></span></a>
						</div>
					</td>
				</tr>
				@endforeach
				@else
				<tr>
					<td colspan="4" align="center">Data Kosong</td>
				</tr>
				@endif
				
			</tbody>			
		</table>
			</div>
		</div>

	</div>
	</div>
</div>
</form>
@endsection