@extends('layouts.app')

@section('content')
<?php 
if($mode=='create')
{
	$url=url('region/simpan');
}
else
{
	$url=action('RegionController@update', $id);
}
?>
<form action="{{$url}}" method="post">
	{{csrf_field()}}
	<div class="col-md-12">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 style="color:#5DADEC"><span class="fa fa-sitemap"></span> Kelola Data Region</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
				
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Kode Region</label>
									<input type="text" name="kd_region" value="{{$mode=='create'?$kd_region:$edit->kd_region}}" placeholder="" class="form-control" name="kd_region" required readonly> 
								</div>
								<div class="form-group">
									<label for="">Nama Region</label>
									<input type="text" value="{{$mode=='create'?'':$edit->wilayah}}" placeholder="" class="form-control" name="region" required="">
								</div>
								<br>
								@if($mode=='create')
								<button type="submit" class="btn btn-primary" name="simpan">Simpan <span class="fa fa-save"></span></button>
								@else
								<button type="submit" class="btn btn-success" name="update">Update <span class="fa fa-pencil"></span></button>	
								<a href="{{url('/region')}}" class="btn btn-warning">Cancel <span class="fa fa-close"></span></a>
								@endif
							</div>
							
							<div class="col-md-8">
								<table class="table table-bordered" id="example" style="width:100%s">
									<thead>
										<th>No</th>
										<th>Kode Region</th>
										<th>Nama Region</th>
										<th>Action</th>
									</thead>
									<tbody>
										@if(isset($data) && !$data->isEmpty())
										@foreach($data as $key=>$val)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$val->kd_region}}</td>
											<td>{{$val->wilayah}}</td>
											<td>
												<div class="btn-group">
													<a onclick='hapus("<?php echo url("region/".$val->kd_region)?>")' class="btn btn-danger">Delete <span class="fa fa-trash"></span></a>
													<a href="<?php echo url("region/".$val->kd_region)."/edit"?>" class="btn btn-info">Edit <span class="fa fa-pencil"></span></a>
												</div>
											</td>
										</tr>
										@endforeach
										@else
										<tr>
											<td colspan="3" align="center">Data Kosong</td>
										</tr>
										@endif

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection