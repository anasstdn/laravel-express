<?php 
function message($isSuccess,$successMessage="Data has been saved",$failedMessage="Failed to save data")
{
	// dd('aaaaaa');
    if($isSuccess){
        Session::flash('message',$successMessage);
    } else {
        Session::flash('message',$failedMessage);
    }

    Session::flash('messageType',$isSuccess ? 'sukses' : 'gagal');
}

function kd_prefix($role)
{
	if($role=='kurir')
	{
		$initial_no_seri = 'KDK';
	}
	elseif($role=='pegawai')
	{
		$initial_no_seri = 'KDP';
	}
	else
	{
		$initial_no_seri = 'KSR';
	}
    
    $base_no_seri = strtoupper($initial_no_seri);

    $last_no_data= \DB::select("SELECT SUBSTR(kd_user,4,4) as kd_user FROM users WHERE SUBSTR( kd_user, 1, 3 )='".$initial_no_seri."' ORDER BY
        SUBSTR(kd_user FROM 1 FOR 3),
        CAST(SUBSTR(kd_user FROM 4) AS UNSIGNED) DESC LIMIT 1");

    if(isset($last_no_data[0]) && !empty($last_no_data[0]))
    {
        $kode = intval($last_no_data[0]->kd_user) + 1; 
    }
    else
    {
        $kode=1;
    }
    $batas = kode($kode); 
    $kodetampil = $initial_no_seri.$batas;
    return $kodetampil; 
}

function kd_region()
{
    $initial_no_seri = 'REG'; 
    $base_no_seri = strtoupper($initial_no_seri);

    $last_no_data= \DB::select("SELECT SUBSTR(kd_region,4,4) as kd_region FROM tbl_region WHERE SUBSTR( kd_region, 1, 3 )='".$initial_no_seri."' ORDER BY
        SUBSTR(kd_region FROM 1 FOR 3),
        CAST(SUBSTR(kd_region FROM 4) AS UNSIGNED) DESC LIMIT 1");

    if(isset($last_no_data[0]) && !empty($last_no_data[0]))
    {
        $kode = intval($last_no_data[0]->kd_region) + 1; 
    }
    else
    {
        $kode=1;
    }
    $batas = kode($kode); 
    $kodetampil = $initial_no_seri.$batas;
    return $kodetampil; 
}

function kd_route()
{
    $initial_no_seri = 'ROT'; 
    $base_no_seri = strtoupper($initial_no_seri);

    $last_no_data= \DB::select("SELECT SUBSTR(kd_route,4,4) as kd_route FROM tbl_route WHERE SUBSTR( kd_route, 1, 3 )='".$initial_no_seri."' ORDER BY
        SUBSTR(kd_route FROM 1 FOR 3),
        CAST(SUBSTR(kd_route FROM 4) AS UNSIGNED) DESC LIMIT 1");

    if(isset($last_no_data[0]) && !empty($last_no_data[0]))
    {
        $kode = intval($last_no_data[0]->kd_route) + 1; 
    }
    else
    {
        $kode=1;
    }
    $batas = kode($kode); 
    $kodetampil = $initial_no_seri.$batas;
    return $kodetampil; 
}

function kd_resi_barang()
{
    $initial_no_seri = 'NBR'; 
    $base_no_seri = strtoupper($initial_no_seri);

    $last_no_data= \DB::select("SELECT SUBSTR(no_resi,4,4) as no_resi FROM tbl_barang WHERE SUBSTR( no_resi, 1, 3 )='".$initial_no_seri."' ORDER BY
        SUBSTR(no_resi FROM 1 FOR 3),
        CAST(SUBSTR(no_resi FROM 4) AS UNSIGNED) DESC LIMIT 1");

    if(isset($last_no_data[0]) && !empty($last_no_data[0]))
    {
        $kode = intval($last_no_data[0]->no_resi) + 1; 
    }
    else
    {
        $kode=1;
    }
    $batas = kode($kode); 
    $kodetampil = $initial_no_seri.$batas;
    return $kodetampil; 
}

function kd_pre_pengiriman()
{
    $initial_no_seri = 'KPR'; 
    $base_no_seri = strtoupper($initial_no_seri);

    $last_no_data= \DB::select("SELECT SUBSTR(kd_pre_pengiriman,4,4) as kd_pre_pengiriman FROM tbl_pre_pengiriman WHERE SUBSTR( kd_pre_pengiriman, 1, 3 )='".$initial_no_seri."' ORDER BY
        SUBSTR(kd_pre_pengiriman FROM 1 FOR 3),
        CAST(SUBSTR(kd_pre_pengiriman FROM 4) AS UNSIGNED) DESC LIMIT 1");

    if(isset($last_no_data[0]) && !empty($last_no_data[0]))
    {
        $kode = intval($last_no_data[0]->kd_pre_pengiriman) + 1; 
    }
    else
    {
        $kode=1;
    }
    $batas = kode($kode); 
    $kodetampil = $initial_no_seri.$batas;
    return $kodetampil; 
}

function kd_pengiriman()
{
    $initial_no_seri = 'KPG'; 
    $base_no_seri = strtoupper($initial_no_seri);

    $last_no_data= \DB::select("SELECT SUBSTR(kd_pengiriman,4,4) as kd_pengiriman FROM tbl_pengiriman WHERE SUBSTR( kd_pengiriman, 1, 3 )='".$initial_no_seri."' ORDER BY
        SUBSTR(kd_pengiriman FROM 1 FOR 3),
        CAST(SUBSTR(kd_pengiriman FROM 4) AS UNSIGNED) DESC LIMIT 1");

    if(isset($last_no_data[0]) && !empty($last_no_data[0]))
    {
        $kode = intval($last_no_data[0]->kd_pengiriman) + 1; 
    }
    else
    {
        $kode=1;
    }
    $batas = kode($kode); 
    $kodetampil = $initial_no_seri.$batas;
    return $kodetampil; 
}

function kode($value) {

    $jml = strlen($value);
    if ($jml == 1)
        $no = "000" . $value;
    if ($jml == 2)
        $no = "00" . $value;
    if ($jml == 3)
        $no = "0" . $value;
    if ($jml == 4)
        $no = $value;
    if ($jml == 0)
        $no = "-";

    return $no;
}

?>