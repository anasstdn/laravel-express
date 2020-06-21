<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblRoute
 * 
 * @property string $kd_route
 * @property string|null $dari_kota
 * @property string|null $ke_kota
 * @property float|null $tarif
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TblRoute extends Model
{
	protected $table = 'tbl_route';
	protected $primaryKey = 'kd_route';
	public $incrementing = false;

	protected $casts = [
		'tarif' => 'float'
	];

	protected $fillable = [
		'kd_route',
		'dari_kota',
		'ke_kota',
		'tarif'
	];
}
