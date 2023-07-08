<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Episode;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list_episode = Episode::with('movie')->orderBy('movie_id','desc')->get();
        return view('admincp.episode.index',compact('list_episode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $list_movie = Movie::orderby('id','desc')->get();
        return view('admincp.episode.form',compact('list_movie'));
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
        $episode = new Episode();
        $episode->movie_id=  $data['movie_id'];
        $episode->linkphim=  $data['linkphim'];
        $episode->episode=  $data['episode'];
        $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->save();
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
        $list_movie = Movie::orderby('id','desc')->get();
        $episode =Episode::with('movie')->find($id);
        return view('admincp.episode.form',compact('list_movie','episode'));
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
        $episode =  Episode::find($id);
        $episode->movie_id=  $data['movie_id'];
        $episode->linkphim=  $data['linkphim'];
        $episode->episode=  $data['episode'];
        $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->save();
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
        $episode =Episode::find($id);
        $episode->delete();
        return redirect()->back();
    }

    public function select_movie(){
        $id = $_GET['id'];
        $movie = Movie::find($id);
        $output='<option>------Chọn tập phim-----</option>';
        for($i = 1; $i <=$movie->sumepisode; $i++){
            $output.='<option value="'.$i.'">'.$i.'</option>';
        }
        echo $output;

    }
}
