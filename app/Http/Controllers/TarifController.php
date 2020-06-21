<?php

namespace App\Http\Controllers;

use App\Models\TblRoute;
use App\Models\TblRegion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class TarifController extends Controller
{
    //
    public $viewDir = "tarif";
	public $breadcrumbs = array(
		'permissions'=>array('title'=>'Users','link'=>"#",'active'=>false,'display'=>true),
	);

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:read-tarif');
	}

	protected function view($view, $data = [])
	{
		return view($this->viewDir.".".$view, $data);
	}

	public function index()
	{
		$data=TblRoute::get();
		$mode='create';
		$kd_route=kd_route();
		$region=TblRegion::get();
		return $this->view( "index",compact('mode','data','kd_route','region'));
	}

	public function edit(Request $request, $id)
	{
		$data=TblRoute::get();
		$edit=TblRoute::find($id);
		$mode='edit';
		$kd_route=kd_route();
		$region=TblRegion::get();
		return $this->view( "index",compact('mode','data','edit','id','kd_route','region'));
	}

	public function store(Request $request)
	{
		$all_data=$request->all();

		$validation = Validator::make($request->all(), [
			'kd_route' => 'required',
			'tarif' => 'required',
			'dari_kota' => 'required',
			'ke_kota' => 'required',
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
				return redirect('/tarif');
			}
		}

		DB::beginTransaction();
		try {
			$data=array(
				'kd_route'=>$all_data['kd_route'],
				'tarif' =>$all_data['tarif'] ,
				'dari_kota' =>$all_data['dari_kota'] ,
				'ke_kota' =>$all_data['ke_kota'] ,
			);

			$act=TblRoute::create($data);

			message($act,'Data Tarif berhasil disimpan!','Data Tarif gagal disimpan!');

		} catch (Exception $e) {
			echo 'Message' .$e->getMessage();
			DB::rollback();
		}
		DB::commit();

		return redirect('/tarif');
	}

	public function update(Request $request,$id)
	{
		$all_data=$request->all();

		$validation = Validator::make($request->all(), [
			'kd_route' => 'required',
			'tarif' => 'required',
			'dari_kota' => 'required',
			'ke_kota' => 'required',
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
				return redirect('/tarif');
			}
		}
		$update=TblRoute::find($id);
		DB::beginTransaction();
		try {
			$data=array(
				'kd_route'=>$all_data['kd_route'],
				'tarif' =>$all_data['tarif'] ,
				'dari_kota' =>$all_data['dari_kota'] ,
				'ke_kota' =>$all_data['ke_kota'] ,
			);

			$act=$update->update($data);

			message($act,'Data Tarif berhasil disimpan!','Data Tarif gagal disimpan!');

		} catch (Exception $e) {
			echo 'Message' .$e->getMessage();
			DB::rollback();
		}
		DB::commit();

		return redirect('/tarif');
	}

	public function destroy($kode)
	{
		$data=TblRoute::find($kode);
		$act=false;
		try {
			$act=$data->forceDelete();
		} catch (\Exception $e) {
			$user=TblRoute::find($data->pk());
			$act=$user->delete();
		}
	}
}
