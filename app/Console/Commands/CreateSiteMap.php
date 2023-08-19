<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Info;
use App\Models\Movie_Genre;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use Carbon\Carbon;
use DB;
use App;
use File;


class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = App::make('sitemap');

        $sitemap->add(route('homepage'), Carbon::now('Asia/Ho_Chi_Minh'), '1.0', 'daily');

        $category = Category::all();
        foreach ($category as $key => $cate){
            $sitemap->add(env('APP_URL')."danh-muc/{$cate->slug}",Carbon::now('Asia/Ho_Chi_Minh'),0.7,'daily');
        }

        $genre = Genre::all();
        foreach ($genre as $key => $gen){
            $sitemap->add(env('APP_URL')."the-loai/{$gen->slug}",Carbon::now('Asia/Ho_Chi_Minh'),0.7,'daily');
        }
        $country = Country::all();
        foreach ($country as $key => $coun){
            $sitemap->add(env('APP_URL')."quoc-gia/{$coun->slug}",Carbon::now('Asia/Ho_Chi_Minh'),0.7,'daily');
        }
        $movie = Movie::with('episode')->orderBy('id','desc')->get();
        foreach($movie as $key=> $movi){
            $sitemap->add(env('APP_URL')."phim/{$movi->slug}",Carbon::now('Asia/Ho_Chi_Minh'),0.6,'daily');
//            foreach($movi->episode as $key1 =>$epi){
//                $sitemap->add(env('APP_URL')."xem-phim/{$movi->slug}/tap-{$epi->episode}",Carbon::now('Asia/Ho_Chi_Minh'),0.6,'daily');
//
//            }
        }
        $years = range(Carbon::now('Asia/Ho_Chi_Minh')->year ,1970);
        foreach ($years as $year){
            $sitemap->add(env('APP_URL')."nam/{$year}",Carbon::now('Asia/Ho_Chi_Minh'),0.6,'daily');
        }
        $sitemap->store('xml','sitemap');
        if (File::exists(base_path() . '/sitemap.xml')) {
            File::copy(public_path('sitemap.xml'), base_path('sitemap.xml'));
        }
    }
}
