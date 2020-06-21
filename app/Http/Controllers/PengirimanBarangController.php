<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TblBarang;
use App\Models\TblRoute;
use App\Models\TblRegion;
use App\Models\TblKecamatan;
use App\Models\TblKelurahan;
use App\Models\TblPrePengiriman;
use App\Models\TblPengiriman;
use App\Models\TblRiwayatPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use File;

class PengirimanBarangController extends Controller
{
    //
    public $viewDir = "pengiriman_barang";
	public $breadcrumbs = array(
		'permissions'=>array('title'=>'Users','link'=>"#",'active'=>false,'display'=>true),
	);

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:read-pengiriman-barang');
	}

	protected function view($view, $data = [])
	{
		return view($this->viewDir.".".$view, $data);
	}

	public function index()
	{
		$data=TblPrePengiriman::where('id_kurir',\Auth::user()->id)->where('status','Waiting To Take')
		->get();
		return $this->view( "index",compact('data'));
	}

	public function ambilPengiriman(Request $request, $id)
	{
		$data=TblPrePengiriman::find($id);
		$wilayah=TblRegion::get();
		return $this->view( "ambil-pengiriman",compact('data','wilayah'));
	}

	public function store(Request $request)
	{
		$all_data=$request->all();

		

		$data_pre_pengiriman=TblPrePengiriman::where('kd_pre_pengiriman',$all_data['kd_pre_pengiriman'])->orderbyRaw('
        SUBSTR(kd_pre_pengiriman FROM 1 FOR 3),
        CAST(SUBSTR(kd_pre_pengiriman FROM 4) AS UNSIGNED) DESC')->first();

		DB::beginTransaction();
		try {

		if(isset($_POST['update']))
		{

			$validation = Validator::make($request->all(), [
				'status' => 'required',
				'lokasi' => 'required',
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
					return redirect('/pengiriman-barang');
				}
			}

			$data=array(
				'kd_pre_pengiriman'=>kd_pre_pengiriman(),
				'no_resi'=>$data_pre_pengiriman->no_resi,
				'id_user'=>$data_pre_pengiriman->id_user,
				'dari_kota'=>$data_pre_pengiriman->dari_kota,
				'ke_kota'=>$data_pre_pengiriman->ke_kota,
				'kecamatan'=>$data_pre_pengiriman->kecamatan,
				'kelurahan'=>$data_pre_pengiriman->kelurahan,
				'current_city'=>$all_data['lokasi'],
				'tgl_pengiriman'=>date('Y-m-d'),
				'tarif'=>$data_pre_pengiriman->tarif,
				'status'=>$all_data['status'],
				'id_kurir'=>\Auth::user()->id,
				'nama_penerima'=>$data_pre_pengiriman->nama_penerima,
				'alamat_penerima'=>$data_pre_pengiriman->alamat_penerima,
			);

			$act=TblPrePengiriman::create($data);
			$act1=TblRiwayatPengiriman::create($data);

			message($act,'Data Pengiriman berhasil disimpan!','Data Pengiriman gagal disimpan!');
		}

		if(isset($_POST['delivered'])){
			$data=array(
				'kd_pre_pengiriman'=>kd_pre_pengiriman(),
				'no_resi'=>$data_pre_pengiriman->no_resi,
				'id_user'=>$data_pre_pengiriman->id_user,
				'dari_kota'=>$data_pre_pengiriman->dari_kota,
				'ke_kota'=>$data_pre_pengiriman->ke_kota,
				'kecamatan'=>$data_pre_pengiriman->kecamatan,
				'kelurahan'=>$data_pre_pengiriman->kelurahan,
				'current_city'=>$data_pre_pengiriman->current_city,
				'tgl_pengiriman'=>date('Y-m-d'),
				'tarif'=>$data_pre_pengiriman->tarif,
				'status'=>'Not Approved',
				'id_kurir'=>\Auth::user()->id,
				'nama_penerima'=>$data_pre_pengiriman->nama_penerima,
				'alamat_penerima'=>$data_pre_pengiriman->alamat_penerima,
			);

			$act=TblPrePengiriman::create($data);
			$act1=TblRiwayatPengiriman::create($data);

			message($act,'Data Pengiriman berhasil disimpan!','Data Pengiriman gagal disimpan!');
		}

		} catch (Exception $e) {
			echo 'Message' .$e->getMessage();
			DB::rollback();
		}
		DB::commit();

		return redirect('/pengiriman-barang');

	}

	public function indexOtw()
	{
		$data=TblPrePengiriman::where('id_kurir',\Auth::user()->id)->where('status','On The Way')
		->get();
		return $this->view( "index",compact('data'));
	}

	public function indexDelayed()
	{
		$data=TblPrePengiriman::where('id_kurir',\Auth::user()->id)->where('status','On Delayed')
		->get();
		return $this->view( "index",compact('data'));
	}

	public function indexTerkirim()
	{
		$data=TblPengiriman::get();
		return $this->view( "index-terkirim",compact('data'));
	}
}
