<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Movie_Genre;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use DB;
use Illuminate\Support\Collection;


class IndexController extends Controller
{
    //
    public function home(){
        $info = Info::find(1);
        $phimhot = Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->get();
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $category = Category::orderBy('position','asc')->where('status',1)->get();
        $country = Country::all();
        $genre = Genre::all();
        $movie_cate = Movie::orderBy('dateupdate','desc')->where('status',1)->get();
        $category_home = Category::with('movie')->orderBy('position','asc')->where('status',1)->get();
        return view('pages.home',compact('category','genre','country','category_home','phimhot','phimhot_sidebar','phimhot_trailer','info','movie_cate'));
    }
    public function genre($slug){
        $info = Info::find(1);
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $category = Category::orderBy('position','asc')->where('status',1)->get();
        $country = Country::all();
        $genre = Genre::all();
        $gen_slug = Genre::where('slug',$slug)->first();
        $movie_genre = Movie_Genre::with('movie','genre')->where('genre_id',$gen_slug->id)->orderBy('id','desc')->paginate(20);

        return view('pages.genre',compact('info','category','genre','country','gen_slug','movie_genre','phimhot_sidebar','phimhot_trailer'));
    }
    public function country($slug){
        $info = Info::find(1);
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $category = Category::orderBy('position','asc')->where('status',1)->get();
        $country = Country::all();
        $genre = Genre::all();
        $coun_slug = Country::where('slug',$slug)->first();
        $movie = Movie::where('country_id',$coun_slug->id)->orderBy('dateupdate','DESC')->where('status',1)->paginate(20);
        return view('pages.country',compact('info','category','genre','country','coun_slug','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function category($slug){
        $info = Info::find(1);
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $category = Category::orderBy('position','asc')->where('status',1)->get();
        $country = Country::all();
        $genre = Genre::all();
        $cate_slug = Category::where('slug',$slug)->first();
        $movie = Movie::where('category_id',$cate_slug->id)->orderBy('dateupdate','DESC')->where('status',1)->paginate(20);
        return view('pages.category',compact('info','category','genre','country','cate_slug','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function movie($slug){
        $info = Info::find(1);
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $category = Category::orderBy('position','asc')->where('status',1)->get();
        $country = Country::all();
        $genre = Genre::all();

        $movie = Movie::with('category','country','movie_genre')->where('slug',$slug)->where('status',1)->first();
        $movie_here = $movie;
        $movie_genre = Movie_Genre::with('movie','genre')->where('movie_id',$movie->id)->get();
        $episode_new = Episode::orderBy('episode','desc')->where('movie_id',$movie->id)->take(3)->get();
        $related = Movie::with('category','country','movie_genre')->where('category_id',$movie->category_id)->orderby(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->where('status',1)->take(10)->get();
        return view('pages.movie',compact('info','category','genre','country','movie','movie_here','related','phimhot_sidebar','phimhot_trailer','movie_genre','episode_new'));
    }
    public function watch($slug,$tap){
        $info = Info::find(1);
        $tapphim=1;
        if(isset($tap)){
            $liststr= explode("-", $tap);
            $tapphim=end($liststr);
        }

        $movie = Movie::with('category','country','movie_genre')->where('slug',$slug)->where('status',1)->first();
        $category = Category::orderBy('position','asc')->where('status',1)->get();
        $country = Country::all();
        $genre = Genre::all();
        $movie_genre = Movie_Genre::with('movie','genre')->where('movie_id',$movie->id)->get();
        $list_episode = Episode::where('movie_id',$movie->id)->get();
        $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first();
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $related = Movie::with('category','country','movie_genre')->where('category_id',$movie->category_id)->where('status',1)->orderby(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->take(10)->get();
        return view('pages.watch',compact('related','info','category', 'country', 'genre','movie','phimhot_trailer','phimhot_sidebar','movie_genre','list_episode','episode'));
    }
    public function episode(){
        $category = Category::all();
        $country = Country::all();
        $genre = Genre::all();
        return view('pages.episode');
    }

    public function year($year){
        $info = Info::find(1);
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $year=$year;
        $category = Category::orderBy('position','asc')->where('status',1)->get();
        $country = Country::all();
        $genre = Genre::all();
        $movie = Movie::where('year',$year)->orderBy('dateupdate','DESC')->where('status',1)->paginate(20);
        return view('pages.year',compact('info','category','genre','country','year','movie','phimhot_sidebar','phimhot_trailer'));

    }
    public function tag($tag){
        $info = Info::find(1);
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $tag=$tag;
        $category = Category::orderBy('position','asc')->where('status',1)->get();
        $country = Country::all();
        $genre = Genre::all();
        $movie = Movie::where('tags','LIKE','%'.$tag.'%')->orderBy('dateupdate','DESC')->where('status',1)->paginate(20);
        return view('pages.tags',compact('info','category','genre','country','tag','movie','phimhot_sidebar','phimhot_trailer'));

    }

    public function search(Request $request){
        $info = Info::find(1);

        $data = $request->all();
        // if(!isset($data['search'])){
        //     return redirect->to('/');
        // }
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $category = Category::orderBy('position','asc')->where('status',1)->get();
        $country = Country::all();
        $genre = Genre::all();
        $search = $data['search'];
        $movie = Movie::where('title','LIKE','%'.$search.'%')->orderBy('dateupdate','DESC')->where('status',1)->paginate(40);
        return view('pages.search',compact('info','category','genre','country','search','movie','phimhot_sidebar','phimhot_trailer'));
    }

    public function filter(Request $request){
        $info = Info::find(1);
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $category = Category::orderBy('position','asc')->where('status',1)->get();
        $country = Country::all();
        $genre = Genre::all();

        $data = $request->all();


        $category_filter = $data['category'];
        $genre_filter = $data['genre'];
        $year_filter = $data['year'];
        $country_filter = $data['country'];
//        if(!$country_filter && !$category_filter && !$year_filter){
//            return redirect()->back();
//        }


//        if($sort_filter =='1'){
//            $movie =Movie::orderBy('dateupdate','desc')->get();
//        }else{
//            $movie =Movie::orderBy('dateupdate','asc')->get();
//        }
//
//        if($category_filter) {
//            $movie = $movie->where('category_id',$category_filter);
//        }
//        if($country_filter){
//            $movie= $movie->where('country_id',$country_filter);
//        }
//        if($year_filter){
//            $movie = $movie->where('year',$year_filter);
//        }


        $movie = new Collection();
        $lmovie = Movie::with('movie_genre')->where('category_id','LIKE','%'.$category_filter.'%')->where('country_id','LIKE','%'.$country_filter.'%')->where('year','LIKE','%'.$year_filter.'%')->orderBy('dateupdate','desc')->where('status',1)->get();
        foreach ($lmovie as $key => $movi){
            $check_movie_genre = Movie_Genre::where('movie_id',$movi->id)->where('genre_id' ,'LIKE' ,'%'.$genre_filter.'%')->first();
            if(isset($check_movie_genre)){
                $movie->push($movi);
            }
        }
        return view('pages.filter_movie',compact('info','category','genre','country','movie','phimhot_sidebar','phimhot_trailer','category_filter','country_filter','year_filter','genre_filter'));
    }
}
