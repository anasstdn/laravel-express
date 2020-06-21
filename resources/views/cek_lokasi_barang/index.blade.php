@extends('layouts.app')

@section('content')
<form action="{{url('cek-lokasi-barang/cari')}}" method="post">
    {{csrf_field()}}
    <div class="col-md-12">
       <div class="row">
        @if($mode=='search')
        <label for="">Check Lokasi Barang</label>
        <div class="input-group">
           <input type="search" name="search" class="form-control" placeholder="No Resi..." autocomplete="off">
           <span class="input-group-btn">
             <button class="btn btn-default" type="submit" name="cari" id="cari">Cari</button>
         </span>
     </div>
     @endif

     @if($mode2=='terkirim')
     @if(isset($get_status_barang) && !empty($get_status_barang))
     @if($get_last_status->status!=='Delivered')
     <div class="well" style="background-color:white;">
        <h3>Barang Anda Sudah Terkirim <a href="{{url('cek-lokasi-barang/'.$get_status_barang->no_resi.'/confirm')}}" class="btn btn-success">Terkirim <span class="fa fa-check"></span></a>
            <a href="{{url('cek-lokasi-barang/'.$get_status_barang->no_resi.'/return')}}" class="btn btn-danger" >Kembalikan <span class="fa fa-close"></span></a>
        </h3>
    </div>
    @else

    <div class="well" style="background-color:white;">
        <h3>Barang Anda Sudah Terkirim</h3>
    </div>
    @endif
    @endif
    @endif

    @if($mode1=='cari')
    @if(isset($data) && !$data->isEmpty())
    @foreach($data as $key=>$val)
    <div class="col-md-6">
      <div class="panel panel-primary">
         <div class="panel-heading">
            <h4 class="text-center">{{date('d-m-Y',strtotime($val->tgl_pengiriman))}}</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-5">
               <h5>Nama Barang </h5>
               <h5>Dari Kota </h5>
               <h5>Ke Kota </h5>
               <h5>Current City </h5>
               <h5>Tarif </h5>
               <h5>Status </h5>
               <h5>Nama pengirim </h5>
               <h5>Nama penerima </h5>
           </div>
           <div class="col-md-1">
            <h5>:</h5>
            <h5>:</h5>
            <h5>:</h5>
            <h5>:</h5>
            <h5>:</h5>
            <h5>:</h5>
            <h5>:</h5>
            <h5>:</h5>
        </div>
        <div class="col-md-6">
           <h5><?= \App\Models\TblBarang::find($val->no_resi)->nama_barang ?></h5>
           <h5><?= $val->dari_kota ?></h5>
           <h5><?= $val->ke_kota ?></h5>
           <h5><?= $val->current_city ?></h5>
           <h5>Rp.<?= number_format($val->tarif,0,',','.') ?></h5>
           <?php if ($val->status == "Waiting To Take"): ?>
           <h5>Di Kantor Cabang <?= $val->current_city ?></h5>
           <?php elseif ($val->status == "In Transit"): ?>
           <h5>Sedang Di Angkut</h5>
           <?php elseif ($val->status == "On The Way"): ?>
           <h5>Menuju Rumah Penerima</h5>
           <?php elseif ($val->status == "On Delayed"):  ?>
           <h5>Ada Masalah</h5>
           <?php elseif ($val->status == "Not Approved"):?>
           <h5>Tunggu Konfirmasi Penerima</h5>
           <?php elseif ($val->status == "Return"):?>
           <h5>Barang Dikembalikan</h5>    
           <?php elseif ($val->status == "Delivered"):?>
           <h5>Barang Sudah Terkirim</h5>
           <?php endif ?>
           <h5><?= \App\Models\User::find($val->id_user)->name ?></h5>
           <h5><?= $val->nama_penerima ?></h5>
       </div>
   </div>
</div>
</div>
@endforeach
@endif
@endif
</div>
</div>
</form>
@endsection