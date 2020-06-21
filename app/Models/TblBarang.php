<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblBarang
 * 
 * @property string $no_resi
 * @property int|null $id_user
 * @property string|null $nama_barang
 * @property string|null $gambar
 * @property float|null $berat
 * @property float|null $panjang
 * @property string|null $keterangan
 * @property string|null $kd_region
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property TblRegion $tbl_region
 *
 * @package App\Models
 */
class TblBarang extends Model
{
	protected $table = 'tbl_barang';
	protected $primaryKey = 'no_resi';
	public $incrementing = false;

	protected $casts = [
		'id_user' => 'int',
		'berat' => 'float',
		'panjang' => 'float'
	];

	protected $fillable = [
		'no_resi',
		'id_user',
		'nama_barang',
		'gambar',
		'berat',
		'panjang',
		'keterangan',
		'kd_region',
		'status'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function tbl_region()
	{
		return $this->belongsTo(TblRegion::class, 'kd_region');
	}
}
