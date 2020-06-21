<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\TblRegion;

class KurirController extends Controller
{
    //
    public $viewDir = "kurir";
	public $breadcrumbs = array(
		'permissions'=>array('title'=>'Users','link'=>"#",'active'=>false,'display'=>true),
	);

	public function __construct()
	{
		$this->middleware('auth');
		// $this->middleware('permission:read-kurir');
	}

	protected function view($view, $data = [])
	{
		return view($this->viewDir.".".$view, $data);
	}

	public function index()
	{
		$data=User::select(\DB::raw('users.*'))->join('role_user','users.id','=','role_user.user_id')
		->join('roles','roles.id','=','role_user.role_id')
		->where('roles.name','=','kurir')
		->where('kd_region',\Auth::user()->kd_region)
		->get();

		return $this->view( "index",compact('data'));
	}

	public function create()
	{
		$role=\App\Role::select(\DB::raw("*"))
		->where('roles.name','=','kurir')
		->get();
		$kd_kurir=kd_prefix('kurir');
		$region=TblRegion::get();
		return $this->view( "create",compact('kd_kurir','role','region'));
	}

	public function store(Request $request)
	{
		$all_data=$request->all();

		$validation = Validator::make($request->all(), [
			'kode' => 'required',
			'user' => 'required',
			'email' => 'required',
			'no_telp' => 'required',
			'username' => 'required',
			'level' => 'required',
			'gender' => 'required',
			'alamat' => 'required',
			'password' => 'required',
			'kd_region' => 'required',
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
				return redirect('/kurir');
			}
		}

		DB::beginTransaction();
		try {
			$data=array(
				'kd_user'=>$all_data['kode'],
				'name' =>$all_data['user'] ,
				'username' =>$all_data['username'] ,
				'email' =>$all_data['email'] ,
				'no_telp' =>$all_data['no_telp'] ,
				'jenis_kelamin' =>$all_data['gender'] ,
				'alamat' =>$all_data['alamat'] ,
				'password'=>bcrypt($all_data['password']),
				'kd_region' =>$all_data['kd_region'] ,
			);

			$act=User::create($data);

			$role=array(
				'role_id'=>intval($all_data['level']),
				'user_id'=>$act->id,
				'user_type'=>'App\User'
			);

			$roleUser = DB::table('role_user')->insert($role);
			message($act,'Data Kurir berhasil disimpan!','Data Kurir gagal disimpan!');

		} catch (Exception $e) {
			echo 'Message' .$e->getMessage();
			DB::rollback();
		}
		DB::commit();

		return redirect('/kurir');
	}

	public function edit(Request $request,$id)
	{
		$data=User::find($id);
		$role=\App\Role::select(\DB::raw("*"))
		->where('roles.name','=','kurir')
		->get();
		$region=TblRegion::get();
		return $this->view( "edit",compact('data','role','id','region'));
	}

	public function update(Request $request, $id)
	{
		$all_data=$request->all();

		$validation = Validator::make($request->all(), [
			'user' => 'required',
			'email' => 'required',
			'no_telp' => 'required',
			'username' => 'required',
			'level' => 'required',
			'gender' => 'required',
			'alamat' => 'required',
			'kd_region' => 'required',
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
				return redirect('/kurir');
			}
		}

		$user=User::find($id);
		DB::beginTransaction();
		try {

			if(isset($all_data['npassword']) && !empty($all_data['npassword']))
			{
				$data_pass=array(
					'password'=>bcrypt($all_data['npassword']),
				);
				$pass=$user->update($data_pass);
			}

			$data=array(
				'name' =>$all_data['user'] ,
                'username' =>$all_data['username'] ,
                'email' =>$all_data['email'] ,
                'no_telp' =>$all_data['no_telp'] ,
                'jenis_kelamin' =>$all_data['gender'] ,
                'alamat' =>$all_data['alamat'] ,
                'kd_region' =>$all_data['kd_region'] ,
			);

			$act=$user->update($data);
			$delRoleUser=RoleUser::where('user_id',$id)->forceDelete();

			$role=array(
             'role_id'=>intval($all_data['level']),
             'user_id'=>$user->id,
             'user_type'=>'App\User'
            );

            $roleUser = DB::table('role_user')->insert($role);

            message($act,'Data Kurir berhasil disimpan!','Data Kurir gagal disimpan!');

		} catch (Exception $e) {
			echo 'Message' .$e->getMessage();
			DB::rollback();
		}
		DB::commit();

		return redirect('/kurir');
	}
}
