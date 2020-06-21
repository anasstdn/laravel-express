<?php

use Symfony\Component\Console\Helper\ProgressBar;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\TblRegion;
use App\Models\TblKecamatan;
use App\Models\TblKelurahan;
use App\Models\TblRoute;
date_default_timezone_set("Asia/Jakarta");

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->importRegion();
        $this->importKecamatan();
        $this->importKelurahan();
        $this->importRoute();
    }

    private function importRegion()
    {
    	$fileName = 'data/seed-region.xlsx';
    	$this->command->info("Seeding Region");
    	\Excel::load($fileName,function($reader){
        // $reader->dump();
    		$reader->each(function($row){
    			$bar = $this->command->getOutput()->createProgressBar($row->count());
          // die("hasil = ".$row->count());

    			$row->each(function($provinsi) use ($bar){
            // echo ($provinsi['kode']."\n");
    				if(isset($provinsi['kd_region'])){
    					$data = TblRegion::firstOrNew(array(
    						'kd_region'=>$provinsi['kd_region']
    					));
    					$data->wilayah=$provinsi['wilayah'];
    					$data->save();
    				}
    				$bar->advance();
    			});
    			$bar->finish();

    		});
    	});
    	echo "\n\n";
    }

    private function importKecamatan()
    {
    	$fileName = 'data/seed-kecamatan.xlsx';
    	$this->command->info("Seeding Kecamatan");
    	\Excel::load($fileName,function($reader){
        // $reader->dump();
    		$reader->each(function($row){
    			$bar = $this->command->getOutput()->createProgressBar($row->count());
          // die("hasil = ".$row->count());

    			$row->each(function($provinsi) use ($bar){
            // echo ($provinsi['kode']."\n");
    				if(isset($provinsi['kd_kecamatan'])){
    					$data = TblKecamatan::firstOrNew(array(
    						'kd_kecamatan'=>$provinsi['kd_kecamatan'],
    						'kd_region'=>$provinsi['kd_region']
    					));
    					$data->kecamatan=$provinsi['kecamatan'];
    					$data->save();
    				}
    				$bar->advance();
    			});
    			$bar->finish();

    		});
    	});
    	echo "\n\n";
    }

    private function importKelurahan()
    {
    	$fileName = 'data/seed-kelurahan.xlsx';
    	$this->command->info("Seeding Kelurahan");
    	\Excel::load($fileName,function($reader){
        // $reader->dump();
    		$reader->each(function($row){
    			$bar = $this->command->getOutput()->createProgressBar($row->count());
          // die("hasil = ".$row->count());

    			$row->each(function($provinsi) use ($bar){
            // echo ($provinsi['kode']."\n");
    				if(isset($provinsi['kd_kelurahan'])){
    					$data = TblKelurahan::firstOrNew(array(
    						'kd_kelurahan'=>$provinsi['kd_kelurahan'],
    						'kd_kecamatan'=>$provinsi['kd_kecamatan'],
    						'kd_region'=>$provinsi['kd_region']
    					));
    					$data->kelurahan=$provinsi['kelurahan'];
    					$data->save();
    				}
    				$bar->advance();
    			});
    			$bar->finish();

    		});
    	});
    	echo "\n\n";
    }

    private function importRoute()
    {
    	$fileName = 'data/seed-route.xlsx';
    	$this->command->info("Seeding Route");
    	\Excel::load($fileName,function($reader){
        // $reader->dump();
    		$reader->each(function($row){
    			$bar = $this->command->getOutput()->createProgressBar($row->count());
          // die("hasil = ".$row->count());

    			$row->each(function($provinsi) use ($bar){
            // echo ($provinsi['kode']."\n");
    				if(isset($provinsi['kd_route'])){
    					$data = TblRoute::firstOrNew(array(
    						'kd_route'=>$provinsi['kd_route'],
    					));
    					$data->dari_kota=$provinsi['dari_kota'];
    					$data->ke_kota=$provinsi['ke_kota'];
    					$data->tarif=$provinsi['tarif'];
    					$data->save();
    				}
    				$bar->advance();
    			});
    			$bar->finish();

    		});
    	});
    	echo "\n\n";
    }
}
