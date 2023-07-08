<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie_Genre;
use Illuminate\Http\Request;
use App\Models\Movie;
use Carbon\Carbon;
use File;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Movie::with('category','movie_genre','country')->orderBy('id','desc')->get();
        $list_movie_genre = Movie_Genre::with('movie','genre')->orderBy('id','desc')->get();       //
        $path = public_path()."/jsonfile/";
        if(!is_dir($path)){
            if (!mkdir($path, 0777, true) && !is_dir($path)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
            }
        }
        File::put($path.'movie.json',json_encode($list));

        return view('admincp.movie.index',compact('list','list_movie_genre'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $movie_genre =Movie_Genre::all();
        $category = Category::all();

        $genre = Genre::all();
        $country = Country::all();
        return view ('admincp.movie.form',compact('category','genre','country','movie_genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $movie = new Movie();
        $movie->title=$data['title'];
        $movie->origintitle = $data['origintitle'];
//         = $data['image'];
        $movie->slug=$data['slug'];
        $movie->description=$data['description'];
        $movie->status=$data['status'];
        $movie->category_id=$data['category'];
//        $movie->genre_id=$data['genre'];

        $movie->country_id=$data['country'];
        $movie->phimhot= $data['phimhot'];
        $movie->resolution= $data['resolution'];
        $movie->subtitle = $data['subtitle'];
        $movie->duration= $data['duration'];
        $movie->tags= $data['tags'];
        $movie->trailer= $data['trailer'];
        $movie->sumepisode= $data['sumepisode'];

        $movie->datecreate = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->dateupdate = Carbon::now('Asia/Ho_Chi_Minh');
        $get_image = $request->file('image');
        $path = 'uploads/movie/';
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
//            File::copy($path.$new_image,$path_gallery.$new_image);
            $movie->image = $new_image;
        }
        $movie->save();
        $genre = Genre::all();
        foreach ($genre as $key => $gen){
            $checkboxValue = $request->input($gen->slug, false);
            if($checkboxValue!= false){
                $movie_genre = new Movie_Genre();
                $movie_genre->movie_id=$movie->id;
                $movie_genre->genre_id=$gen->id;
                $movie_genre->save();
            }
        }
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $list_movie_genre = Movie_Genre::with('movie','genre')->where('movie_id',$id)->orderBy('id','desc')->get();
        $movie = Movie::find($id);
        $category = Category::all();
        $genre = Genre::all();
        $country = Country::all();
        return view ('admincp.movie.form',compact('category','genre','country','movie','list_movie_genre'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //
        $data = $request->all();
        $movie = Movie::find($id);
        $movie->title=$data['title'];
        $movie->origintitle = $data['origintitle'];
//         = $data['image'];
        $movie->slug=$data['slug'];
        $movie->description=$data['description'];
        $movie->status=$data['status'];
        $movie->category_id=$data['category'];
//        $movie->genre_id=$data['genre'];
        $movie->country_id=$data['country'];
        $movie->phimhot= $data['phimhot'];
        $movie->resolution= $data['resolution'];
        $movie->subtitle = $data['subtitle'];
        $movie->duration= $data['duration'];
        $movie->tags= $data['tags'];
        $movie->trailer= $data['trailer'];
        $movie->sumepisode= $data['sumepisode'];
        $movie->dateupdate = Carbon::now('Asia/Ho_Chi_Minh');

        $get_image = $request->file('image');
        $path = 'uploads/movie/';
        if($get_image){
            if(file_exists('uploads/movie/'.$movie->image)){
                unlink('uploads/movie/'.$movie->image);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
//            File::copy($path.$new_image,$path_gallery.$new_image);
            $movie->image = $new_image;
        }
        $movie->save();
        $movie_genre = Movie_Genre::where('movie_id',$movie->id)->get();
        foreach ($movie_genre as $key => $movi_gen){
            $movi_gen->delete();
        }
        $genre = Genre::all();
        foreach ($genre as $key => $gen){
            $checkboxValue = $request->input($gen->slug, false);
            if($checkboxValue!= false){
                $movie_genre = new Movie_Genre();
                $movie_genre->movie_id=$movie->id;
                $movie_genre->genre_id=$gen->id;
                $movie_genre->save();
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $movie =Movie::find($id);
        $listepisode = Episode::where('movie_id',$movie->id)->get();
        $movie_genre = Movie_Genre::with('movie','genre')->where('movie_id',$id)->get();
        foreach ($movie_genre as $key => $movi_gen){
            $movi_gen->delete();
        }
        foreach ($listepisode as $key => $episode){
            $episode->delete();
        }
        if(file_exists('uploads/movie/'.$movie->image)){
            unlink('uploads/movie/'.$movie->image);
        }
        $movie->delete();
        return  redirect()->back();
    }

    public function update_year(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id']);
        $movie->year = $data['year'];
        $movie->save();
    }
    public function update_topview(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id']);
        $movie->topview = $data['topview'];
        $movie->save();
    }
    public function update_season(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id']);
        $movie->season = $data['season'];
        $movie->save();
    }


    public function filter_topview(Request $request){
        $data = $request->all();
        $movie = Movie::where('topview',$data['value'])->orderBy('ngaycapnhat','desc')->take(20)->get();
        $output ='';
        foreach ($movie as $key => $movi){
            if($movi->relution ==0){
                $text = "HD";
            }elseif ($movi->relution ==1){
                $text = "SD";
            }elseif ($movi->relution ==2){
                $text ="CAM" ;
            }else{
                $text ="Full HD";
            }
        $output .= '<div class="item">
                    <a href="chitiet.php" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
                        <div class="item-link">
                            <img src="'.url('uploads/movie/'.$movi->image).'" class="lazy post-thumb" alt="'.$movi->title.'" title="'.$movi->title.'" />
                            <span class="is_trailer">'.$text.'</span>
                        </div>
                        <p class="title">'.$movi->title.'</p>
                    </a>
                    <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                    <div style="float: left;">
                                 <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                 <span style="width: 0%"></span>
                                 </span>
                    </div>
                </div>';
        }
        echo $output;

    }

}
