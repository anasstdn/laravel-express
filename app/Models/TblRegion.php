<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblRegion
 * 
 * @property string $kd_region
 * @property string|null $wilayah
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblKecamatan[] $tbl_kecamatans
 *
 * @package App\Models
 */
class TblRegion extends Model
{
	protected $table = 'tbl_region';
	protected $primaryKey = 'kd_region';
	public $incrementing = false;

	protected $fillable = [
		'kd_region',
		'wilayah'
	];

	public function tbl_kecamatans()
	{
		return $this->hasMany(TblKecamatan::class, 'kd_region');
	}
}
