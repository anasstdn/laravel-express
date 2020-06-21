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

class CekLokasiBarangController extends Controller
{
    //
    public $viewDir = "cek_lokasi_barang";
	public $breadcrumbs = array(
		'permissions'=>array('title'=>'Users','link'=>"#",'active'=>false,'display'=>true),
	);

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:read-cek-lokasi-barang');
	}

	protected function view($view, $data = [])
	{
		return view($this->viewDir.".".$view, $data);
	}

	public function index()
	{
		$mode='search';
		$mode1='';
		$mode2='';
		return $this->view( "index",compact('mode','mode1','mode2'));
	}

	public function cari(Request $request)
	{
		$all_data=$request->all();
		$data=TblRiwayatPengiriman::where('no_resi',$all_data['search'])->where('id_user',\Auth::user()->id)->orderby('tgl_pengiriman','DESC')->get();

		if(isset($data) && !$data->isEmpty())
		{
			$get_status_barang=TblRiwayatPengiriman::where('status','Not Approved')
			->where('no_resi',$all_data['search'])
			->first();

			$get_last_status=TblRiwayatPengiriman::where('no_resi',$all_data['search'])->orderby('created_at','desc')->first();

			if(isset($get_status_barang) && !empty($get_status_barang))
			{
				$mode='search';
				$mode1='cari';
				$mode2='terkirim';
				$get_status_barang=$get_status_barang;
				$get_last_status=$get_last_status;
			}
			else
			{
				$mode='search';
				$mode1='cari';
				$mode2='';
				$get_status_barang='';
				$get_last_status='';
			}
			
			return $this->view( "index",compact('mode','mode1','mode2','data','get_status_barang','get_last_status'));
		}
		else
		{
			message(false,'','Barang dengan No Resi '.$all_data['search'].' tidak ditemukan!');
			$mode='search';
			$mode1='';
			$mode2='';
			return $this->view( "index",compact('mode','mode1','mode2'));
		}
		
	}

	public function confirmation(Request $request, $id, $status)
	{
		if($status=='confirm')
		{
			DB::beginTransaction();
			try {
			$getData=TblPrePengiriman::where('status','Not Approved')->where('no_resi',$id)->first();

			$update_barang=TblBarang::find($id)->update(['status'=>'Delivered']);

			$tbl_pre_pengiriman=TblPengiriman::create([
				'kd_pengiriman'=>kd_pengiriman(),
				'no_resi'=>$getData->no_resi,
				'id_user'=>$getData->id_user,
				'dari_kota'=>$getData->dari_kota,
				'ke_kota'=>$getData->ke_kota,
				'tgl_delivered'=>date('Y-m-d'),
				'nama_penerima'=>$getData->nama_penerima,
				'alamat_penerima'=>$getData->alamat_penerima,
				'tarif'=>$getData->tarif,
				'status'=>'Delivered',
				'id_kurir'=>$getData->id_kurir
			]);

			$tbl_riwayat_pengiriman=TblRiwayatPengiriman::create([
				'kd_pre_pengiriman'=>kd_pre_pengiriman(),
				'no_resi'=>$getData->no_resi,
				'dari_kota'=>$getData->dari_kota,
				'ke_kota'=>$getData->ke_kota,
				'kecamatan'=>$getData->kecamatan,
				'kelurahan'=>$getData->kelurahan,
				'current_city'=>$getData->current_city,
				'tgl_pengiriman'=>$getData->tgl_pengiriman,
				'tarif'=>$getData->tarif,
				'status'=>'Delivered',
				'id_user'=>$getData->id_user,
				'id_kurir'=>$getData->id_kurir,
				'nama_penerima'=>$getData->nama_penerima,
				'alamat_penerima'=>$getData->alamat_penerima
			]);

			$delete_data=TblPrePengiriman::where('no_resi',$id)->delete();

			if($update_barang==true && $tbl_pre_pengiriman==true && $tbl_riwayat_pengiriman==true && $delete_data==true)
			{
				$act=true;
			}
			else
			{
				$act=false;
			}
			message($act,'Data Pengiriman berhasil dikonfirmasi!','Data Pengiriman gagal dikonfirmasi!');

			} catch (Exception $e) {
				echo 'Message' .$e->getMessage();
				DB::rollback();
			}
			DB::commit();


		}
		if($status=='return')
		{
			DB::beginTransaction();
			try {
			$getData=TblPrePengiriman::where('status','Not Approved')->where('no_resi',$id)->first();

			$update_barang=TblBarang::find($id)->update(['status'=>'Return']);

			$tbl_pre_pengiriman=TblPengiriman::create([
				'kd_pengiriman'=>kd_pengiriman(),
				'no_resi'=>$getData->no_resi,
				'id_user'=>$getData->id_user,
				'dari_kota'=>$getData->dari_kota,
				'ke_kota'=>$getData->ke_kota,
				'tgl_delivered'=>date('Y-m-d'),
				'nama_penerima'=>$getData->nama_penerima,
				'alamat_penerima'=>$getData->alamat_penerima,
				'tarif'=>$getData->tarif,
				'status'=>'Return',
				'id_kurir'=>$getData->id_kurir
			]);

			$tbl_riwayat_pengiriman=TblRiwayatPengiriman::create([
				'kd_pre_pengiriman'=>kd_pre_pengiriman(),
				'no_resi'=>$getData->no_resi,
				'dari_kota'=>$getData->dari_kota,
				'ke_kota'=>$getData->ke_kota,
				'kecamatan'=>$getData->kecamatan,
				'kelurahan'=>$getData->kelurahan,
				'current_city'=>$getData->current_city,
				'tgl_pengiriman'=>$getData->tgl_pengiriman,
				'tarif'=>$getData->tarif,
				'status'=>'Return',
				'id_user'=>$getData->id_user,
				'id_kurir'=>$getData->id_kurir,
				'nama_penerima'=>$getData->nama_penerima,
				'alamat_penerima'=>$getData->alamat_penerima
			]);

			$delete_data=TblPrePengiriman::where('no_resi',$id)->delete();

			if($update_barang==true && $tbl_pre_pengiriman==true && $tbl_riwayat_pengiriman==true && $delete_data==true)
			{
				$act=true;
			}
			else
			{
				$act=false;
			}
			message($act,'Data Pengembalian berhasil dikonfirmasi!','Data Pengembalian gagal dikonfirmasi!');

			} catch (Exception $e) {
				echo 'Message' .$e->getMessage();
				DB::rollback();
			}
			DB::commit();
		}

		return redirect('/cek-lokasi-barang');
		
	}
}
