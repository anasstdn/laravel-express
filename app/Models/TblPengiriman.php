<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblPengiriman
 * 
 * @property string $kd_pengiriman
 * @property string|null $no_resi
 * @property int|null $id_user
 * @property string|null $dari_kota
 * @property string|null $ke_kota
 * @property Carbon|null $tgl_delivered
 * @property string|null $nama_penerima
 * @property string|null $alamat_penerima
 * @property float|null $tarif
 * @property string|null $status
 * @property int|null $id_kurir
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property TblBarang $tbl_barang
 *
 * @package App\Models
 */
class TblPengiriman extends Model
{
	protected $table = 'tbl_pengiriman';
	protected $primaryKey = 'kd_pengiriman';
	public $incrementing = false;

	protected $casts = [
		'id_user' => 'int',
		'tarif' => 'float',
		'id_kurir' => 'int'
	];

	protected $dates = [
		'tgl_delivered'
	];

	protected $fillable = [
		'kd_pengiriman',
		'no_resi',
		'id_user',
		'dari_kota',
		'ke_kota',
		'tgl_delivered',
		'nama_penerima',
		'alamat_penerima',
		'tarif',
		'status',
		'id_kurir'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function tbl_barang()
	{
		return $this->belongsTo(TblBarang::class, 'no_resi');
	}
}
