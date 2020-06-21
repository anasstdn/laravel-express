<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblRiwayatPengiriman
 * 
 * @property string $kd_pre_pengiriman
 * @property string|null $no_resi
 * @property string|null $dari_kota
 * @property string|null $ke_kota
 * @property string|null $kecamatan
 * @property string|null $kelurahan
 * @property string|null $current_city
 * @property Carbon|null $tgl_pengiriman
 * @property float|null $tarif
 * @property string|null $status
 * @property int|null $id_user
 * @property int|null $id_kurir
 * @property string|null $nama_penerima
 * @property string|null $alamat_penerima
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property TblBarang $tbl_barang
 *
 * @package App\Models
 */
class TblRiwayatPengiriman extends Model
{
	protected $table = 'tbl_riwayat_pengiriman';
	protected $primaryKey = 'kd_pre_pengiriman';
	public $incrementing = false;

	protected $casts = [
		'tarif' => 'float',
		'id_user' => 'int',
		'id_kurir' => 'int'
	];

	protected $dates = [
		'tgl_pengiriman'
	];

	protected $fillable = [
		'kd_pre_pengiriman',
		'no_resi',
		'dari_kota',
		'ke_kota',
		'kecamatan',
		'kelurahan',
		'current_city',
		'tgl_pengiriman',
		'tarif',
		'status',
		'id_user',
		'id_kurir',
		'nama_penerima',
		'alamat_penerima'
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
