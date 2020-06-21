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

class LaporanBarangController extends Controller
{
    //
    public $viewDir = "laporan_barang";
	public $breadcrumbs = array(
		'permissions'=>array('title'=>'Users','link'=>"#",'active'=>false,'display'=>true),
	);

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:read-laporan');
	}

	protected function view($view, $data = [])
	{
		return view($this->viewDir.".".$view, $data);
	}

	public function index()
	{
		$data=TblBarang::join('tbl_riwayat_pengiriman','tbl_riwayat_pengiriman.no_resi','=','tbl_barang.no_resi')
		->get();

		$mode='all';

		$judul = "Semua Data Barang";

		return $this->view( "index",compact('data','mode','judul'));
	}

	public function status(Request $request, $status)
	{
		if($status=='wtt')
		{
			$data=TblBarang::join('tbl_riwayat_pengiriman','tbl_riwayat_pengiriman.no_resi','=','tbl_barang.no_resi')
			->where('tbl_riwayat_pengiriman.status','Waiting To Take')
			->get();

			$mode='wtt';

			$judul = "Data Barang(Waiting To Take)";
		}

		if($status=='delay')
		{
			$data=TblBarang::join('tbl_riwayat_pengiriman','tbl_riwayat_pengiriman.no_resi','=','tbl_barang.no_resi')
			->where('tbl_riwayat_pengiriman.status','On Delayed')
			->get();

			$mode='delay';

			$judul = "Data Barang(On Delayed)";
		}

		if($status=='transit')
		{
			$data=TblBarang::join('tbl_riwayat_pengiriman','tbl_riwayat_pengiriman.no_resi','=','tbl_barang.no_resi')
			->where('tbl_riwayat_pengiriman.status','In Transit')
			->get();

			$mode='transit';

			$judul = "Data Barang(In Transit)";
		}

		if($status=='napv')
		{
			$data=TblBarang::join('tbl_pre_pengiriman','tbl_pre_pengiriman.no_resi','=','tbl_barang.no_resi')
			->where('tbl_pre_pengiriman.status','Not Approved')
			->get();

			$mode='napv';

			$judul = "Data Barang(Not Approved)";
		}

		if($status=='deliver')
		{
			$data=TblBarang::join('tbl_riwayat_pengiriman','tbl_riwayat_pengiriman.no_resi','=','tbl_barang.no_resi')
			->where('tbl_riwayat_pengiriman.status','Delivered')
			->get();

			$mode='deliver';

			$judul = "Data Barang(Delivered)";
		}

		if($status=='return')
		{
			$data=TblBarang::join('tbl_riwayat_pengiriman','tbl_riwayat_pengiriman.no_resi','=','tbl_barang.no_resi')
			->where('tbl_riwayat_pengiriman.status','Return')
			->get();

			$mode='return';

			$judul = "Data Barang(Return)";
		}

		return $this->view( "index",compact('data','mode','judul'));
	}

	public function search(Request $request)
	{
		if(isset($_POST['cari']))
		{
			$all_data=$request->all();
			$data=TblBarang::join('tbl_riwayat_pengiriman','tbl_riwayat_pengiriman.no_resi','=','tbl_barang.no_resi')
			->whereBetween('tbl_riwayat_pengiriman.tgl_pengiriman',[$all_data['awal'],$all_data['akhir']])
			->get();

			$mode='cari';

			$judul = "Data Barang Dari ".$all_data['awal']." Sampai ".$all_data['akhir']."";

		}
		return $this->view( "index",compact('data','mode','judul'));
	}

	public function user()
	{
		$data=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','user')
			->get();

		$laki=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','user')
			->where('users.jenis_kelamin','=','L')
			->get();

		$perempuan=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','user')
			->where('users.jenis_kelamin','=','F')
			->get();

		$total=count($data);
		$total_male=count($laki);
		$total_female=count($perempuan);

		return $this->view( "laporan-user",compact('data','total_male','total_female','total'));
	}

	public function pegawai()
	{
		$data=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','pegawai')
			->get();

		$laki=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','pegawai')
			->where('users.jenis_kelamin','=','L')
			->get();

		$perempuan=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','pegawai')
			->where('users.jenis_kelamin','=','F')
			->get();

		$total=count($data);
		$total_male=count($laki);
		$total_female=count($perempuan);

		return $this->view( "laporan-pegawai",compact('data','total_male','total_female','total'));
	}

	public function pegawaiStatus(Request $request, $id)
	{
		$data=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','pegawai')
			->where('users.verified',$id)
			->get();

		$laki=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','pegawai')
			->where('users.jenis_kelamin','=','L')
			->where('users.verified',$id)
			->get();

		$perempuan=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','pegawai')
			->where('users.jenis_kelamin','=','F')
			->where('users.verified',$id)
			->get();

		$total=count($data);
		$total_male=count($laki);
		$total_female=count($perempuan);

		return $this->view( "laporan-pegawai",compact('data','total_male','total_female','total'));
	}

	public function kurir()
	{
		$data=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','kurir')
			->get();

		$laki=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','kurir')
			->where('users.jenis_kelamin','=','L')
			->get();

		$perempuan=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','kurir')
			->where('users.jenis_kelamin','=','F')
			->get();

		$total=count($data);
		$total_male=count($laki);
		$total_female=count($perempuan);

		return $this->view( "laporan-kurir",compact('data','total_male','total_female','total'));
	}

	public function kurirStatus(Request $request, $id)
	{
		$data=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','kurir')
			->where('users.verified',$id)
			->get();

		$laki=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','kurir')
			->where('users.jenis_kelamin','=','L')
			->where('users.verified',$id)
			->get();

		$perempuan=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
			->join('roles','roles.id','=','role_user.role_id')
			->where('roles.name','=','kurir')
			->where('users.jenis_kelamin','=','F')
			->where('users.verified',$id)
			->get();

		$total=count($data);
		$total_male=count($laki);
		$total_female=count($perempuan);

		return $this->view( "laporan-kurir",compact('data','total_male','total_female','total'));
	}
}
