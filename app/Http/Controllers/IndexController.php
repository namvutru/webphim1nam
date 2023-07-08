<?php

namespace App\Http\Controllers;

use App\Models\Movie_Genre;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use DB;




class IndexController extends Controller
{
    //
    public function home(){
        $phimhot = Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->get();
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $category = Category::all()->where('status',1);
        $country = Country::all();
        $genre = Genre::all();
        $category_home = Category::with('movie')->orderBy('id','DESC')->where('status',1)->get();
        return view('pages.home',compact('category','genre','country','category_home','phimhot','phimhot_sidebar','phimhot_trailer'));
    }
    public function genre($slug){

        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $category = Category::all()->where('status',1);
        $country = Country::all();
        $genre = Genre::all();
        $gen_slug = Genre::where('slug',$slug)->first();
        $movie_genre = Movie_Genre::with('movie','genre')->where('genre_id',$gen_slug->id)->paginate(20);

        return view('pages.genre',compact('category','genre','country','gen_slug','movie_genre','phimhot_sidebar','phimhot_trailer'));
    }
    public function country($slug){
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $category = Category::all()->where('status',1);
        $country = Country::all();
        $genre = Genre::all();
        $coun_slug = Country::where('slug',$slug)->first();
        $movie = Movie::where('country_id',$coun_slug->id)->orderBy('dateupdate','DESC')->paginate(20);;
        return view('pages.country',compact('category','genre','country','coun_slug','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function category($slug){
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $category = Category::all()->where('status',1);
        $country = Country::all();
        $genre = Genre::all();
        $cate_slug = Category::where('slug',$slug)->first();
        $movie = Movie::where('category_id',$cate_slug->id)->orderBy('dateupdate','DESC')->paginate(20);
        return view('pages.category',compact('category','genre','country','cate_slug','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function movie($slug){
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $category = Category::all();
        $country = Country::all();
        $genre = Genre::all();

        $movie = Movie::with('category','country','movie_genre')->where('slug',$slug)->where('status',1)->first();
        $movie_genre = Movie_Genre::with('movie','genre')->where('movie_id',$movie->id)->get();
        $episode_new = Episode::orderBy('episode','desc')->where('movie_id',$movie->id)->take(3)->get();
        $related = Movie::with('category','country','movie_genre')->where('category_id',$movie->category_id)->orderby(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        return view('pages.movie',compact('category','genre','country','movie','related','phimhot_sidebar','phimhot_trailer','movie_genre','episode_new'));
    }
    public function watch($slug,$tap){
        $tapphim=1;
        if(isset($tap)){
            $tapphim=substr($tap,4,1);
        }

        $movie = Movie::with('category','country','movie_genre')->where('slug',$slug)->where('status',1)->first();
        $category = Category::all();
        $country = Country::all();
        $genre = Genre::all();
        $movie_genre = Movie_Genre::with('movie','genre')->where('movie_id',$movie->id)->get();
        $list_episode = Episode::where('movie_id',$movie->id)->get();
        $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first();
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        return view('pages.watch',compact('category', 'country', 'genre','movie','phimhot_trailer','phimhot_sidebar','movie_genre','list_episode','episode'));
    }
    public function episode(){
        $category = Category::all();
        $country = Country::all();
        $genre = Genre::all();
        return view('pages.episode');
    }

    public function year($year){
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $year=$year;
        $category = Category::all()->where('status',1);
        $country = Country::all();
        $genre = Genre::all();
        $movie = Movie::where('year',$year)->orderBy('dateupdate','DESC')->paginate(20);
        return view('pages.year',compact('category','genre','country','year','movie','phimhot_sidebar','phimhot_trailer'));

    }
    public function tag($tag){
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $tag=$tag;
        $category = Category::all()->where('status',1);
        $country = Country::all();
        $genre = Genre::all();
        $movie = Movie::where('tags','LIKE','%'.$tag.'%')->orderBy('dateupdate','DESC')->paginate(20);
        return view('pages.tags',compact('category','genre','country','tag','movie','phimhot_sidebar','phimhot_trailer'));

    }

    public function search(Request $request){

        $data = $request->all();
        if(!isset($data['search'])){
            return redirect->to('/');
        }
        $phimhot_sidebar= Movie::where('phimhot',1)->where('status',1)->orderBy('dateupdate','DESC')->take(30)->get();
        $phimhot_trailer= Movie::where('resolution',4)->where('status',1)->orderBy('dateupdate','DESC')->take(10)->get();
        $category = Category::all()->where('status',1);
        $country = Country::all();
        $genre = Genre::all();
        $search = $data['search'];
        $movie = Movie::where('title','LIKE','%'.$search.'%')->orderBy('dateupdate','DESC')->paginate(20);
        return view('pages.search',compact('category','genre','country','search','movie','phimhot_sidebar','phimhot_trailer'));

    }
}
