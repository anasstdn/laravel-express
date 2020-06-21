<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string|null $kd_user
 * @property string $name
 * @property string $username
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $jenis_kelamin
 * @property string|null $no_telp
 * @property string|null $alamat
 * @property bool $verified
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $kd_region
 * 
 * @property TblRegion $tbl_region
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'verified' => 'bool'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'kd_user',
		'name',
		'username',
		'email',
		'email_verified_at',
		'password',
		'jenis_kelamin',
		'no_telp',
		'alamat',
		'verified',
		'remember_token',
		'kd_region'
	];

	public function tbl_region()
	{
		return $this->belongsTo(TblRegion::class, 'kd_region');
	}

	public function roleUser(){
        return $this->hasOne('App\Models\RoleUser','user_id');
    }
}
