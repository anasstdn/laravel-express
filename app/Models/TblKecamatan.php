<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblKecamatan
 * 
 * @property string $kd_kecamatan
 * @property string|null $kd_region
 * @property string|null $kecamatan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblRegion $tbl_region
 * @property Collection|TblKelurahan[] $tbl_kelurahans
 *
 * @package App\Models
 */
class TblKecamatan extends Model
{
	protected $table = 'tbl_kecamatan';
	protected $primaryKey = 'kd_kecamatan';
	public $incrementing = false;

	protected $fillable = [
		'kd_kecamatan',
		'kd_region',
		'kecamatan'
	];

	public function tbl_region()
	{
		return $this->belongsTo(TblRegion::class, 'kd_region');
	}

	public function tbl_kelurahans()
	{
		return $this->hasMany(TblKelurahan::class, 'kd_kecamatan');
	}
}
