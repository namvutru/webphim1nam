<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Movie;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function getDataFromApi()
    {
        $url = "https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=1"; // Đường dẫn API của bạn

        $client = new Client();
        $response = $client->request('GET', $url);

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            $movie_leech = $data['items'];

            return view('admincp.leech.index',compact('movie_leech'));
        } else {
            echo "Lỗi trong quá trình gửi yêu cầu: " . $response->getStatusCode();
        }
    }

    public function getmoviebyslug($slug)
    {
        $url = "https://ophim1.com/phim/".$slug; // Đường dẫn API của bạn

        $client = new Client();
        $response = $client->request('GET', $url);

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            $movi = $data['movie'];
            $category = $movi['category'][0];
            $country = $movi['country'][0];
            $list_episode= new Collection();
            $episodes = $data['episodes'];

            $movie = new Movie();
            $movie->title=$movi['name'];
            $movie->origintitle = $movi['origin_name'];
//         = $data['image'];
            $movie->slug=$movi['slug'];
            $movie->description=$movi['content'];
            $movie->status=1;
//            $movie->category_id=$data['category'];
//        $movie->genre_id=$data['genre'];

//            $movie->country_id=$data['country'];
            $movie->phimhot= 0;
            $movie->resolution=0;
            $movie->subtitle = 0;

//            $movie->tags= $data['tags'];
//            $movie->trailer= $data['trailer'];
//
//
//            $movie->datecreate = Carbon::now('Asia/Ho_Chi_Minh');
//            $movie->dateupdate = Carbon::now('Asia/Ho_Chi_Minh');

            foreach ($episodes as $episode) {
                $serverData = $episode['server_data'];
                foreach ($serverData as $episodeData) {
                    $epis  = new Episode();
                    $epis->episode = (int)$episodeData['name'];
                    $epis->linkphim='<iframe class="embed-responsive-item" src="'.$episodeData['link_embed'].'" allowfullscreen></iframe>' ;
                    $list_episode ->push($epis);
                }
            }
            $movie->sumepisode= $list_episode->count();

            return view('admincp.leech.leechepisodeindex',compact('list_episode','movie'));
        } else {
            echo "Lỗi trong quá trình gửi yêu cầu: " . $response->getStatusCode();
        }
    }
    public function synxphim(Request $request)
    {
        $data = $request->all();
        $slug=$data['slug'];

        $url = "https://ophim1.com/phim/".$slug; // Đường dẫn API của bạn

        $client = new Client();
        $response = $client->request('GET', $url);

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            $movi = $data['movie'];
            $category = $movi['category'][0];
            $country = $movi['country'][0];
            $movie = new Movie();
            $cate = Category::where('slug',$category['slug'])->first();
            $coun =Country::where('slug',$country['slug'])->first();
            if($cate){
                $movie->category_id=$cate->id;
            }else{
                $category_new=new Category();
                $category_new->slug=$category['slug'];
                $category_new->title=$category['name'];
                $category_new->description=$category['name'];
                $category_new->status=1;

                $category_new->save();
                $movie->category_id= $category_new->id;
            }

            if($coun){
                $movie->country_id=$coun->id;
            }else{
                $country_new=new Country();
                $country_new->slug=$country['slug'];
                $country_new->title=$country['name'];
                $country_new->description=$country['name'];
                $country_new->status=1;

                $country_new->save();
                $movie->country_id= $country_new->id;
            }



            $list_episode= new Collection();
            $episodes = $data['episodes'];


            $movie->title=$movi['name'];
            $movie->origintitle = $movi['origin_name'];
//         = $data['image'];
            $movie->slug=$movi['slug'];
            $movie->description=$movi['content'];
            $movie->image=$movi['thumb_url'];
            $movie->status=1;
            $movie->duration = $movi['time'];
//        $movie->genre_id=$data['genre'];


            $movie->phimhot= 0;
            $movie->resolution=0;
            $movie->subtitle = 0;


//            $movie->tags= $data['tags'];
//            $movie->trailer= $data['trailer'];
//
//
            $movie->datecreate = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->dateupdate = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->save();
            foreach ($episodes as $episode) {
                $serverData = $episode['server_data'];
                foreach ($serverData as $episodeData) {
                    $epis  = new Episode();
                    $epis->movie_id =$movie->id;
                    $epis->episode = (int)$episodeData['name'];
                    $epis->linkphim='<iframe class="embed-responsive-item" src="'.$episodeData['link_embed'].'" allowfullscreen></iframe>' ;
                    $list_episode ->push($epis);
                    $epis->save();
                }
            }



            return view('admincp.leech.leechepisodeindex',compact('list_episode','movie'));
        } else {
            echo "Lỗi trong quá trình gửi yêu cầu: " . $response->getStatusCode();
        }
    }
}