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
                        <a href="{{route('episode.index')}}">Liệt kê danh sách tập phim</a>
                        @if(!isset($episode))
                            <form action="{{route('episode.store')}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-group">
                                    <label id="movie_id">Select Movie</label>
                                        <select class="form-select select-movie" name="movie_id" >
                                            <option>------Chọn phim-----</option>
                                            @foreach($list_movie as $key=>$movi)
                                                <option value="{{$movi->id}}">{{$movi->title}}</option>
                                            @endforeach

                                        </select>
                                </div>
                                <div class="form-group">
                                    <label id="linkphim">Link Phim</label>
                                    <input type="text" name="linkphim" class="form-control">
                                </div>
                                <div class="form-group">
                                <label>Chọn tập</label>
                                <select id="select-show-movie" name="episode" class="form-control">

                                </select>
                                </div>

                                <input type="submit" class="btn btn-success" value="Thêm Tập phim">
                            </form>
                        @else
                            <form action="{{url('episode',['id'=> $episode->id])}}" enctype="multipart/form-data" method="post" >
                                @method('PUT')
                                @csrf


                                <div class="form-group">
                                    <label id="movie_id">Select Movie</label>
                                    <select class="form-select" name="movie_id" >
                                        @foreach($list_movie as $key=>$movi)
                                            @if($movi->id == $episode->movie_id)
                                                <option value="{{$movi->id}}" selected>{{$movi->title}}</option>
                                            @else
                                                <option value="{{$movi->id}}">{{$movi->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label id="linkphim">Link Phim</label>
                                    <input type="text" name="linkphim" value="{{$episode->linkphim}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Chọn tập</label>
                                    <select id="select-show-movie" name="episode" class="form-control">
                                        @for($i=1;$i<=$episode->movie->sumepisode;$i++)
                                            @if($episode->episode == $i)
                                                <option value="{{$i}}" selected>{{$i}}</option>

                                            @else
                                                <option value="{{$i}}" >{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-success" value="Cập nhật Tập Phim">
                            </form>
                        @endif
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
