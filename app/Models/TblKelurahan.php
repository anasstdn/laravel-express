<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblKelurahan
 * 
 * @property string $kd_kelurahan
 * @property string|null $kd_kecamatan
 * @property string|null $kelurahan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $kd_region
 * 
 * @property TblKecamatan $tbl_kecamatan
 * @property TblRegion $tbl_region
 *
 * @package App\Models
 */
class TblKelurahan extends Model
{
	protected $table = 'tbl_kelurahan';
	protected $primaryKey = 'kd_kelurahan';
	public $incrementing = false;

	protected $fillable = [
		'kd_kelurahan',
		'kd_kecamatan',
		'kelurahan',
		'kd_region'
	];

	public function tbl_kecamatan()
	{
		return $this->belongsTo(TblKecamatan::class, 'kd_kecamatan');
	}

	public function tbl_region()
	{
		return $this->belongsTo(TblRegion::class, 'kd_region');
	}
}
