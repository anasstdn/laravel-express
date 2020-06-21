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

class BarangController extends Controller
{
    //
    public $viewDir = "barang";
	public $breadcrumbs = array(
		'permissions'=>array('title'=>'Users','link'=>"#",'active'=>false,'display'=>true),
	);

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:read-barang');
	}

	protected function view($view, $data = [])
	{
		return view($this->viewDir.".".$view, $data);
	}

	public function index()
	{
		$data=TblBarang::whereRaw('tbl_barang.no_resi not in (select no_resi from tbl_pre_pengiriman)')->get();
		return $this->view( "index",compact('data'));
	}

	public function indexTerkirim()
	{
		$data=TblPengiriman::get();
		return $this->view( "index-terkirim",compact('data'));
	}

	public function indexTransit()
	{
		$data=TblPrePengiriman::where('current_city',\Auth::user()->region->wilayah)->where('status','In Transit')
		->get();
		return $this->view( "index-transit",compact('data'));
	}

	public function transit(Request $request, $id)
	{
		$data=TblPrePengiriman::find($id);

		$kurir=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
		->join('roles','roles.id','=','role_user.role_id')
		->where('roles.name','=','kurir')
		->where('kd_region',\Auth::user()->kd_region)
		->get();

		return $this->view( "set-transit",compact('data','kurir'));
	}

	public function updateTransit(Request $request)
	{
		$all_data=$request->all();

		$validation = Validator::make($request->all(), [
			'status' => 'required',
			'kurir' => 'required',
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
				return redirect(url("barang/index-transit"));
			}
		}

		$data_pre_pengiriman=TblPrePengiriman::where('kd_pre_pengiriman',$all_data['kd_pre_pengiriman'])->orderbyRaw('
        SUBSTR(kd_pre_pengiriman FROM 1 FOR 3),
        CAST(SUBSTR(kd_pre_pengiriman FROM 4) AS UNSIGNED) DESC')->first();

		DB::beginTransaction();
		try {

		if(isset($_POST['update']))
		{
			$data=array(
				'kd_pre_pengiriman'=>kd_pre_pengiriman(),
				'no_resi'=>$data_pre_pengiriman->no_resi,
				'id_user'=>$data_pre_pengiriman->id_user,
				'dari_kota'=>$data_pre_pengiriman->dari_kota,
				'ke_kota'=>$data_pre_pengiriman->ke_kota,
				'kecamatan'=>$data_pre_pengiriman->kecamatan,
				'kelurahan'=>$data_pre_pengiriman->kelurahan,
				'current_city'=>\Auth::user()->region->wilayah,
				'tgl_pengiriman'=>date('Y-m-d'),
				'tarif'=>$data_pre_pengiriman->tarif,
				'status'=>$all_data['status'],
				'id_kurir'=>$all_data['kurir'],
				'nama_penerima'=>$data_pre_pengiriman->nama_penerima,
				'alamat_penerima'=>$data_pre_pengiriman->alamat_penerima,
			);

			$act=TblPrePengiriman::create($data);
			$act1=TblRiwayatPengiriman::create($data);

			message($act,'Data Pengiriman berhasil disimpan!','Data Pengiriman gagal disimpan!');
		}
		
		if(isset($_POST['delivered'])){

		}

		} catch (Exception $e) {
			echo 'Message' .$e->getMessage();
			DB::rollback();
		}
		DB::commit();

		return redirect(url("barang/index-transit"));
	}

	public function create()
	{
		$user=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','user')
			->get();	
		
		$kd_resi_barang=kd_resi_barang('user');

		return $this->view( "create",compact('kd_resi_barang','user'));
	}

	public function store(Request $request)
	{
		$all_data=$request->all();

		$validation = Validator::make($request->all(), [
			'resi' => 'required',
			'pengirim' => 'required',
			'barang' => 'required',
			'berat' => 'required',
			'panjang' => 'required',
			'keterangan' => 'required',
			'gambar' => 'required',
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
				return redirect('/barang');
			}
		}

		if(file_exists( public_path().'/images/barang/'.$request->file('gambar')->getClientOriginalName()))
		{
			message(false,'','Foto Sudah Ada/Nama File Sama');
			return redirect('/barang');
		}

		DB::beginTransaction();
		try {

			if($request->hasFile('gambar'))
			{
				$extension = $request->file('gambar')->getClientOriginalExtension();
				$dir = 'images/barang/';
				$flag = $request->file('gambar')->getClientOriginalName();
				$request->file('gambar')->move($dir, $flag);
			}

			$data=array(
				'no_resi'=>$all_data['resi'],
				'id_user'=>$all_data['pengirim'],
				'nama_barang'=>$all_data['barang'],
				'gambar'=>$flag,
				'berat'=>$all_data['berat'],
				'panjang'=>$all_data['panjang'],
				'keterangan'=>$all_data['keterangan'],
				'kd_region'=>\Auth::user()->kd_region,
				'status'=>'Not Delivered',
			);

			$act=TblBarang::create($data);

			message($act,'Data Barang berhasil disimpan!','Data Barang gagal disimpan!');

		} catch (Exception $e) {
			echo 'Message' .$e->getMessage();
			DB::rollback();
		}
		DB::commit();

		return redirect('/barang');
	}

	public function edit(Request $request, $id)
	{
		$data=TblBarang::find($id);
		$user=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','user')
			->get();	
		return $this->view( "edit",compact('data','user','id'));
	}

	public function update(Request $request, $id)
	{
		$all_data=$request->all();
		// dd($all_data);

		$validation = Validator::make($request->all(), [
			// 'resi' => 'required',
			'user' => 'required',
			// 'barang' => 'required',
			'berat' => 'required',
			'panjang' => 'required',
			'keterangan' => 'required',
			'gambar' => 'required',
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
				return redirect('/barang');
			}
		}

		if(file_exists( public_path().'/images/barang/'.$request->file('gambar')->getClientOriginalName()))
		{
			message(false,'','Foto Sudah Ada/Nama File Sama');
			return redirect('/barang');
		}

		$barang=TblBarang::find($id);

		DB::beginTransaction();
		try {

			if($request->hasFile('gambar'))
			{
				if(file_exists( public_path().'/images/barang/'.$barang->gambar))
				{
					$destinationPath = public_path().'/images/barang';
					File::delete($destinationPath.'/'.$barang->gambar);
				}

				$extension = $request->file('gambar')->getClientOriginalExtension();
				$dir = 'images/barang/';
				$flag = $request->file('gambar')->getClientOriginalName();
				$request->file('gambar')->move($dir, $flag);
			}

			$data=array(
				// 'no_resi'=>$all_data['resi'],
				'id_user'=>$all_data['user'],
				// 'nama_barang'=>$all_data['barang'],
				'gambar'=>$flag,
				'berat'=>$all_data['berat'],
				'panjang'=>$all_data['panjang'],
				'keterangan'=>$all_data['keterangan'],
				'kd_region'=>\Auth::user()->kd_region,
				'status'=>'Not Delivered',
			);

			$act=$barang->update($data);

			message($act,'Data Barang berhasil disimpan!','Data Barang gagal disimpan!');

		} catch (Exception $e) {
			echo 'Message' .$e->getMessage();
			DB::rollback();
		}
		DB::commit();

		return redirect('/barang');
	}


	public function destroy($kode)
	{
		$user=TblBarang::find($kode);
		if(file_exists( public_path().'/images/barang/'.$user->gambar))
		{
			$destinationPath = public_path().'/images/barang';
			File::delete($destinationPath.'/'.$user->gambar);
		}
		$act=false;
		try {
			$act=$user->forceDelete();
		} catch (\Exception $e) {
			$user=TblBarang::find($user->pk());
			$act=$user->delete();
		}
	}

	public function kirim($id)
	{
		$data=TblBarang::find($id);
		$from=TblRegion::where('kd_region',\Auth::user()->kd_region)->get();
		$to=TblRegion::get();
		$kurir=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
		->join('roles','roles.id','=','role_user.role_id')
		->where('roles.name','=','kurir')
		->where('kd_region',\Auth::user()->kd_region)
		->get();
		$kd_pre_pengiriman=kd_pre_pengiriman();

		return $this->view( "kirim",compact('data','from','to','kurir','kd_pre_pengiriman'));	
	}

	public function getKecamatan(Request $request)
	{
		$all_data=$request->all();
		$region=$all_data['wilayah'];

		$html='';
		$html.='<option value="">Pilih Wilayah</option>';

		$get_region=TblRegion::where('wilayah',$region)->first();

		$get_kecamatan=TblKecamatan::where('kd_region',$get_region->kd_region)->get();

		
		if(isset($get_kecamatan) && !$get_kecamatan->isEmpty())
		{
			foreach($get_kecamatan as $val)
			{
				$html.='<option value="'.$val->kecamatan.'">'.$val->kecamatan.'</option>';
			}
		}

		echo json_encode($html);
	}

	public function getKelurahan(Request $request)
	{
		$all_data=$request->all();
		$region=$all_data['wilayah'];
		$kecamatan=$all_data['kecamatan'];

		$html='';
		$html.='<option value="">Pilih Wilayah</option>';

		$get_region=TblRegion::where('wilayah',$region)->first();
		$get_kecamatan=TblKecamatan::where('kecamatan',$kecamatan)->first();

		$get_kelurahan=TblKelurahan::where('kd_kecamatan',$get_kecamatan->kd_kecamatan)
		->where('kd_region',$get_region->kd_region)
		->get();

		
		if(isset($get_kelurahan) && !$get_kelurahan->isEmpty())
		{
			foreach($get_kelurahan as $val)
			{
				$html.='<option value="'.$val->kelurahan.'">'.$val->kelurahan.'</option>';
			}
		}
		
		echo json_encode($html);
	}

	public function kirimBarang(Request $request)
	{
		$all_data=$request->all();

		$validation = Validator::make($request->all(), [
			'kd_pre_pengiriman' => 'required',
			'no_resi' => 'required',
			'kd_user' => 'required',
			'dari' => 'required',
			'ke' => 'required',
			'kecamatan' => 'required',
			'kelurahan' => 'required',
			'nama' => 'required',
			'status' => 'required',
			'kurir' => 'required',
			'alamat' => 'required',
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
				return redirect('/barang');
			}
		}

		$cek_exist=TblPrePengiriman::where('no_resi',$all_data['no_resi'])->first();

		if(isset($cek_exist) && !empty($cek_exist))
		{
			message(false,'','Paket Barang sudah masuk di daftar pengiriman!');
			return redirect('/barang');
		}

		DB::beginTransaction();
		try {

			$data_barang=TblBarang::find($all_data['no_resi']);

			$data_route=TblRoute::where('dari_kota',$all_data['dari'])
			->where('ke_kota',$all_data['ke'])
			->first();

			if($data_barang->berat <= 10){
				$harga = $data_route->tarif + "5000";
			}
			elseif($data_barang->berat >= 10 ){
				$harga = $data_route->tarif + "10000";
			}
			elseif($data_barang->berat >= 20 ){
				$harga = $data_route->tarif + "15000";
			}
			elseif($data_barang->berat >= 30 ){
				$harga = $data_route->tarif + "20000";
			}
			elseif($data_barang->berat >= 40 ){
				$harga = $data_route->tarif + "25000";
			}
			else{
				$harga = $data_route->tarif + "35000";
			}

			$data=array(
				'kd_pre_pengiriman'=>$all_data['kd_pre_pengiriman'],
				'no_resi'=>$all_data['no_resi'],
				'id_user'=>User::where('kd_user',$all_data['kd_user'])->first()->id,
				'dari_kota'=>$all_data['dari'],
				'ke_kota'=>$all_data['ke'],
				'kecamatan'=>$all_data['kecamatan'],
				'kelurahan'=>$all_data['kelurahan'],
				'current_city'=>\Auth::user()->region->wilayah,
				'tgl_pengiriman'=>date('Y-m-d'),
				'tarif'=>$harga,
				'status'=>$all_data['status'],
				'id_kurir'=>$all_data['kurir'],
				'nama_penerima'=>$all_data['nama'],
				'alamat_penerima'=>$all_data['alamat'],
			);

			$act=TblPrePengiriman::create($data);
			$act1=TblRiwayatPengiriman::create($data);

			$kd_pre_pengiriman=$all_data['kd_pre_pengiriman'];

			message($act,'Data Pengiriman berhasil disimpan!','Data Pengiriman gagal disimpan!');

			} catch (Exception $e) {
			echo 'Message' .$e->getMessage();
			DB::rollback();
		}
		DB::commit();

		return redirect(url("barang/cetak-print/".$kd_pre_pengiriman));	
	}

	public function cetakPrint(Request $request,$id)
	{
		$data=TblPrePengiriman::join('tbl_barang','tbl_barang.no_resi','=','tbl_pre_pengiriman.no_resi')->find($id);
		return $this->view( "cetak-kirim",compact('data'));
	}
}
