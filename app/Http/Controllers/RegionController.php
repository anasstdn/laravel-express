<?php

namespace App\Http\Controllers;

use App\Models\TblRegion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegionController extends Controller
{
    //
    public $viewDir = "region";
	public $breadcrumbs = array(
		'permissions'=>array('title'=>'Users','link'=>"#",'active'=>false,'display'=>true),
	);

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:read-region');
	}

	protected function view($view, $data = [])
	{
		return view($this->viewDir.".".$view, $data);
	}

	public function index()
	{
		$data=TblRegion::get();
		$mode='create';
		$kd_region=kd_region();
		return $this->view( "index",compact('mode','data','kd_region'));
	}

	public function edit(Request $request, $id)
	{
		$data=TblRegion::get();
		$edit=TblRegion::find($id);
		$mode='edit';
		return $this->view( "index",compact('mode','data','edit','id'));
	}

	public function store(Request $request)
	{
		$all_data=$request->all();

		$validation = Validator::make($request->all(), [
			'kd_region' => 'required',
			'region' => 'required',
		]);

		if (!$validation->passes()){
			$count_err=count($validation->errors()->all());
			$i=0;
			foreach($validation->errors()->all() as $val)
			{
				message(false,'',$val);
				$i++;
			}
			if($count_err==$i)
			{
				return redirect('/region');
			}
		}

		DB::beginTransaction();
		try {
			$data=array(
				'kd_region'=>$all_data['kd_region'],
				'wilayah' =>$all_data['region'] ,
			);

			$act=TblRegion::create($data);

			message($act,'Data Region berhasil disimpan!','Data Region gagal disimpan!');

		} catch (Exception $e) {
			echo 'Message' .$e->getMessage();
			DB::rollback();
		}
		DB::commit();

		return redirect('/region');
	}

	public function update(Request $request,$id)
	{
		$all_data=$request->all();

		$validation = Validator::make($request->all(), [
			'kd_region' => 'required',
			'region' => 'required',
		]);

		if (!$validation->passes()){
			$count_err=count($validation->errors()->all());
			$i=0;
			foreach($validation->errors()->all() as $val)
			{
				message(false,'',$val);
				$i++;
			}
			if($count_err==$i)
			{
				return redirect('/region');
			}
		}
		$update=TblRegion::find($id);
		DB::beginTransaction();
		try {
			$data=array(
				'kd_region'=>$all_data['kd_region'],
				'wilayah' =>$all_data['region'] ,
			);

			$act=$update->update($data);

			message($act,'Data Region berhasil disimpan!','Data Region gagal disimpan!');

		} catch (Exception $e) {
			echo 'Message' .$e->getMessage();
			DB::rollback();
		}
		DB::commit();

		return redirect('/region');
	}

	public function destroy($kode)
	{
		$data=TblRegion::find($kode);
		$act=false;
		try {
			$act=$data->forceDelete();
		} catch (\Exception $e) {
			$user=TblRegion::find($data->pk());
			$act=$user->delete();
		}
	}
}
