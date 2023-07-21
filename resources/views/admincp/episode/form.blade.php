@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Quản lí Tập Phim') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(!isset($episode))
                            <form action="{{route('episode.store')}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-group">
                                    <label >Tên phim: {{$movie->title}}</label>
                                    <input type="hidden" name="movie_id" value="{{$movie->id}}">

                                </div>
                                <div class="form-group">
                                    <label id="linkphim">Link Phim</label>
                                    <input type="text" name="linkphim" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label id=>Tập phim</label>
                                    <input type="text" name="episode" class="form-control">
                                </div>

                                <input type="submit" class="btn btn-success" value="Thêm Tập phim">
                            </form>
                        @else
                                <a href="{{route('episodebymovie',$movie->id)}}">Thêm tập phim</a>
                            <form action="{{url('episode',['id'=> $episode->id])}}" enctype="multipart/form-data" method="post" >
                                @method('PUT')
                                @csrf


                                <div class="form-group">
                                    <div class="form-group">
                                        <label >Tên phim: {{$movie->title}}</label>
                                        <input type="hidden" name="movie_id" value="{{$movie->id}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label id="linkphim">Link Phim</label>
                                    <input type="text" name="linkphim" value="{{$episode->linkphim}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label id=>Tập phim</label>
                                    <input type="text" value="{{$episode->episode}}" name="episode" class="form-control">
                                </div>
                                <input type="submit" class="btn btn-success" value="Cập nhật Tập Phim">
                            </form>
                            <span>----------------------Danh sách tập phim----------------------</span>
                        @endif
                            <table class="table" id="tablephim">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title Movie</th>
                                    <th scope="col">Link Episode</th>
                                    <th scope="col">Sum Episode</th>
                                    <th scope="col">Episode</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Manage</th>

                                </tr>
                                </thead>
                                <tbody class="order_position">

                                @foreach($list_episode as $key =>$epi)

                                    <tr id="{{$epi->id}}">
                                        <th scope="row">{{$key}}</th>
                                        <td>{{$epi->movie->title}}</td>
                                        <td>{{$epi->linkphim}}</td>
                                        <td>{{$epi->movie->sumepisode}}</td>
                                        <td>{{$epi->episode}}</td>
                                        <td></td>
                                        <td>
                                            <form action="{{url('episode',['id'=> $epi->id])}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirmdelete();"/>
                                            </form>
                                            <a href="{{route('episode.edit',$epi->id)}}" class="btn bg-warning">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        {{--                        <table class="table" id="tablephim">--}}
                        {{--                            <thead>--}}
                        {{--                            <tr>--}}
                        {{--                                <th scope="col">#</th>--}}
                        {{--                                <th scope="col">Title</th>--}}
                        {{--                                <th scope="col">Slug</th>--}}
                        {{--                                <th scope="col">Image</th>--}}
                        {{--                                <th scope="col">Description</th>--}}
                        {{--                                <th scope="col">Category</th>--}}
                        {{--                                <th scope="col">Genre</th>--}}
                        {{--                                <th scope="col">Country</th>--}}
                        {{--                                <th scope="col">Show?</th>--}}
                        {{--                                <th scope="col">Manage</th>--}}
                        {{--                            </tr>--}}
                        {{--                            </thead>--}}
                        {{--                            <tbody class="order_position">--}}

                        {{--                            @foreach($list as $key =>$movi)--}}
                        {{--                                <tr id="{{$movi->id}}">--}}
                        {{--                                    <th scope="row">{{$key}}</th>--}}
                        {{--                                    <td>{{$movi->title}}</td>--}}
                        {{--                                    <td>{{$movi->slug}}</td>--}}
                        {{--                                    <td><img width="60"  src="{{asset('/uploads/movie/'.$movi->image)}}"/></td>--}}
                        {{--                                    <td>{{$movi->description}}</td>--}}
                        {{--                                    <td>{{$movi->category->title}}</td>--}}
                        {{--                                    <td>{{$movi->genre->title}}</td>--}}
                        {{--                                    <td>{{$movi->country->title}}</td>--}}
                        {{--                                    @if($movi->status==1)--}}
                        {{--                                        <td>Hiển thị</td>--}}
                        {{--                                    @else--}}
                        {{--                                        <td>Không hiển thị</td>--}}
                        {{--                                    @endif--}}
                        {{--                                    <td>--}}
                        {{--                                        <form action="{{url('movie',['id'=> $movi->id])}}" method="post">--}}
                        {{--                                            @method('delete')--}}
                        {{--                                            @csrf--}}
                        {{--                                            <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirmdelete();"/>--}}
                        {{--                                        </form>--}}
                        {{--                                        <a href="{{route('movie.edit',$movi->id)}}" class="btn bg-warning">Edit</a>--}}
                        {{--                                    </td>--}}
                        {{--                                </tr>--}}
                        {{--                            @endforeach--}}
                        {{--                            </tbody>--}}
                        {{--                        </table>--}}

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function confirmdelete() {
        if(!confirm("Are You Sure to delete this"))
            event.preventDefault();
    }
</script>
