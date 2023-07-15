<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_Genre;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function getDataFromApi($page)
    {
        $url = "https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=".$page; // Đường dẫn API của bạn

        $client = new Client();
        $response = $client->request('GET', $url);

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            $movie_leech = $data['items'];

            return view('admincp.leech.index',compact('movie_leech','page'));
        } else {
            echo "Lỗi trong quá trình gửi yêu cầu: " . $response->getStatusCode();
        }
    }

    public function getmoviebyslug($slug)
    {
        $url = "https://ophim1.com/phim/".$slug; // Đường dẫn API của bạn

        $client = new Client();
        $response = $client->request('GET', $url);
        $checkmovie = Movie::where('slug',$slug)->first();

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

            foreach ($episodes as  $episode) {
                $serverData = $episode['server_data'];
                foreach ($serverData as $key => $episodeData) {
                    $epis  = new Episode();
                    $epis->episode = (int)$episodeData['name'];
                    $epis->linkphim='<iframe class="embed-responsive-item" src="'.$episodeData['link_embed'].'" allowfullscreen></iframe>' ;
                    $list_episode ->push($epis);
                    $movie->sumepisode= $key+1;
                }
            }


            return view('admincp.leech.leechepisodeindex',compact('list_episode','movie','checkmovie'));
        } else {
            echo "Lỗi trong quá trình gửi yêu cầu: " . $response->getStatusCode();
        }
    }



    public function searchmoviebyslug(Request $request)
    {
        $data = $request->all();
        $slug= $data['slug'];
        $url = "https://ophim1.com/phim/".$slug; // Đường dẫn API của bạn
        $checkmovie = Movie::where('slug',$slug)->first();
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
                foreach ($serverData as $key => $episodeData ) {
                    $epis  = new Episode();
                    $epis->episode = (int)$episodeData['name'];
                    $epis->linkphim='<iframe class="embed-responsive-item" src="'.$episodeData['link_embed'].'" allowfullscreen></iframe>' ;
                    $list_episode ->push($epis);
                    $movie->sumepisode = $key+1;
                }
            }


            return view('admincp.leech.leechepisodeindex',compact('list_episode','movie','checkmovie'));
        } else {
            echo "Lỗi trong quá trình gửi yêu cầu: " . $response->getStatusCode();
        }
    }
    public function synxphim(Request $request)
    {
        $data = $request->all();
        $slug = $data['slug'];

        $url = "https://ophim1.com/phim/" . $slug; // Đường dẫn API của bạn

        $client = new Client();
        $response = $client->request('GET', $url);

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            $movi = $data['movie'];

            $list_genre = $movi['category'];
            $country = $movi['country'][0];
            $catego = $movi['type'];
            $movie = new Movie();
            $coun = Country::where('slug', $country['slug'])->first();
            foreach ($list_genre as $key => $genre) {
                $gen = Genre::where('slug', $genre['slug'])->first();
                if ($gen) {

                } else {
                    $genre_new = new Genre();
                    $genre_new->slug = $genre['slug'];
                    $genre_new->title = $genre['name'];
                    $genre_new->description = $genre['name'];
                    $genre_new->status = 1;
                    $genre_new->save();
                }
            }
            if ($catego == 'single') {
                $movie->category_id = 2;
            } elseif ($catego == 'series') {
                $movie->category_id = 7;
            } elseif ($catego == 'hoathinh') {
                $movie->category_id = 5;
            } else {
                $movie->category_id = 1;
            }

            if ($coun) {
                $movie->country_id = $coun->id;
            } else {
                $country_new = new Country();
                $country_new->slug = $country['slug'];
                $country_new->title = $country['name'];
                $country_new->description = $country['name'];
                $country_new->status = 1;
                $country_new->save();
                $movie->country_id = $country_new->id;
            }
            $list_episode = new Collection();
            $episodes = $data['episodes'];
            $movie->title = $movi['name'];
            $movie->origintitle = $movi['origin_name'];
            $movie->slug = $movi['slug'];
            $movie->description = $movi['content'];
            $movie->image = $movi['thumb_url'];
            $movie->status = 1;
            $movie->duration = $movi['time'];
            $movie->year = $movi['year'];
//            $movie->trailer = $movi['trailer_url'];
            $movie->phimhot = 0;
            $movie->resolution = 0;
            $movie->subtitle = 0;
            $movie->datecreate = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->dateupdate = Carbon::now('Asia/Ho_Chi_Minh');

            foreach ($episodes as $episode) {
                $serverData = $episode['server_data'];
                foreach ($serverData as $key => $episodeData) {
                    $movie->sumepisode = $key + 1;
                }
            }


            $movie->save();

            foreach ($list_genre as $key => $genre) {
                $gen = Genre::where('slug', $genre['slug'])->first();
                if ($gen) {
                    $movie_genre = new Movie_Genre();
                    $movie_genre->movie_id = $movie->id;
                    $movie_genre->genre_id = $gen->id;
                    $movie_genre->save();
                } else {

                }
            }


            foreach ($episodes as $episode) {
                $serverData = $episode['server_data'];
                foreach ($serverData as $key => $episodeData) {
                    $epis = new Episode();
                    $epis->movie_id = $movie->id;
                    $epis->episode = $key + 1;
                    $epis->linkphim = '<iframe class="embed-responsive-item" src="' . $episodeData['link_embed'] . '" allowfullscreen></iframe>';
                    $list_episode->push($epis);
                    $epis->save();
                }
            }


            $url = "https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=1"; // Đường dẫn API của bạn

            $client = new Client();
            $response = $client->request('GET', $url);

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);
                $movie_leech = $data['items'];

                return view('admincp.leech.index', compact('movie_leech'));
            } else {
                echo "Lỗi trong quá trình gửi yêu cầu: " . $response->getStatusCode();
            }
        }
    }

    public function synx_phim_by_page(Request $request){
        $dat = $request->all();
        $page1 = $dat['page1'];
        $page2 = $dat['page2'];

        for($i=$page2;$i>=$page1;$i--) {
            $url = "https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=" . $i; // Đường dẫn API của bạn
            $client = new Client();
            $response = $client->request('GET', $url);
            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);
                $movie_leech = $data['items'];
                foreach ($movie_leech as $key => $movi_leech) {
                    $slug = $movi_leech['slug'];
                    $title= $movi_leech['name'];
                    $moviecheck = Movie::where('slug', $slug)->first();
                    $moviechecktt= Movie::where('title', $title)->first();
                    if ($moviecheck) {

                    }else {
                        if ($moviechecktt) {

                        }else {
                            $url = "https://ophim1.com/phim/" . $slug; // Đường dẫn API của bạn
                            $response1 = $client->request('GET', $url);

                            if ($response1->getStatusCode() == 200) {
                                $data1 = json_decode($response1->getBody(), true);
                                $movi = $data1['movie'];


                                $list_genre = $movi['category'];
                                $country = $movi['country'][0];
                                $catego = $movi['type'];
                                $movie = new Movie();
                                $coun = Country::where('slug', $country['slug'])->first();
                                foreach ($list_genre as $key1 => $genre) {
                                    $gen = Genre::where('slug', $genre['slug'])->first();
                                    if ($gen) {

                                    } else {
                                        $genre_new = new Genre();
                                        $genre_new->slug = $genre['slug'];
                                        $genre_new->title = $genre['name'];
                                        $genre_new->description = $genre['name'];
                                        $genre_new->status = 1;
                                        $genre_new->save();
                                    }
                                }
                                if ($catego == 'single') {
                                    $movie->category_id = 2;
                                } elseif ($catego == 'series') {
                                    $movie->category_id = 7;
                                } elseif ($catego == 'hoathinh') {
                                    $movie->category_id = 5;
                                } else {
                                    $movie->category_id = 1;
                                }

                                if ($coun) {
                                    $movie->country_id = $coun->id;
                                } else {
                                    $country_new = new Country();
                                    $country_new->slug = $country['slug'];
                                    $country_new->title = $country['name'];
                                    $country_new->description = $country['name'];
                                    $country_new->status = 1;
                                    $country_new->save();
                                    $movie->country_id = $country_new->id;
                                }
                                $list_episode = new Collection();
                                $episodes = $data1['episodes'];
                                $movie->title = $movi['name'];
                                $movie->origintitle = $movi['origin_name'];
                                $movie->slug = $movi['slug'];
                                $movie->description = $movi['content'];
                                $movie->image = $movi['thumb_url'];
                                $movie->status = 1;
                                $movie->duration = $movi['time'];
                                $movie->year = $movi['year'];
//            $movie->trailer = $movi['trailer_url'];
                                $movie->phimhot = 0;
                                $movie->resolution = 0;
                                $movie->subtitle = 0;
                                $movie->datecreate = Carbon::now('Asia/Ho_Chi_Minh');
                                $movie->dateupdate = Carbon::now('Asia/Ho_Chi_Minh');

                                foreach ($episodes as $episode) {
                                    $serverData = $episode['server_data'];
                                    foreach ($serverData as $key1 => $episodeData) {
                                        $movie->sumepisode = $key1 + 1;
                                    }
                                }

                                $movie->save();

                                foreach ($list_genre as $key1 => $genre) {
                                    $gen = Genre::where('slug', $genre['slug'])->first();
                                    if ($gen) {
                                        $movie_genre = new Movie_Genre();
                                        $movie_genre->movie_id = $movie->id;
                                        $movie_genre->genre_id = $gen->id;
                                        $movie_genre->save();
                                    } else {

                                    }
                                }


                                foreach ($episodes as $episode) {
                                    $serverData = $episode['server_data'];
                                    foreach ($serverData as $key1 => $episodeData) {
                                        $epis = new Episode();
                                        $epis->movie_id = $movie->id;
                                        $epis->episode = $key1 + 1;
                                        $epis->linkphim = '<iframe class="embed-responsive-item" src="' . $episodeData['link_embed'] . '" allowfullscreen></iframe>';
                                        $list_episode->push($epis);
                                        $epis->save();
                                    }
                                }


                            }
                        }
                    }

                }

                echo 'trang ' . $i . ' thang cong  <br>';


            } else {
                echo "Lỗi trong quá trình gửi yêu cầu: " . $response->getStatusCode();
            }
        }
    }

    public function tatphim18(){
        $movie_genre = Movie_Genre::with('movie')->where('genre_id',17)->get();
        foreach ($movie_genre as $key => $movi_gen){
            $movi = $movi_gen->movie;
            $movi->status = 0;
            $movi->save();
        }
        echo 'đã ẩn tất cả phim 18+';
    }
    public function tatphimvn(){
        $movie = Movie::where('country_id',31)->get();
        foreach ($movie as $key => $movi){
            $movi->status = 0;
            $movi->save();
        }
        echo 'đã ẩn tất cả phim việt nam';
    }
}
