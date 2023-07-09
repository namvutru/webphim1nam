@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Quản lí Phim') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{ route('movie.create')}}">Thêm phim</a>
                            <form action="{{route('searchmoviebyslug')}}" method="get" >
                            <div class="form-group">
                                <label id="title">Nhập tên phim chính xác </label>
                                <input type="text" name="title" id="slug"  class="form-control" onkeyup="ChangeToSlug()" placeholder="...">
                            </div>
                            <div class="form-group">
                                <label id="slug">Slug</label>
                                <input type="text" name="slug"  id="convert_slug" class="form-control" >
                            </div>
                                <input type="submit" value="Tìm kiếm">
                            </form>

                        <table class="table" id="tablephim">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Origin Name</th>
                                <th scope="col">Thumb_Image</th>
                                <th scope="col">Poster_Image</th>
                                <th scope="col">Year</th>
                                <th scope="col">Manage</th>
                            </tr>
                            </thead>
                            <tbody class="order_position">

                            @foreach($movie_leech as $key =>$movi)
                                <tr id="{{$movi['_id']}}">
                                    <th scope="row">{{$key}}</th>


{{--                                    "_id": "624c1536c78eb57bbfe486ba",--}}
{{--                                    "name": "Hoàng hậu Ki",--}}
{{--                                    "origin_name": "The Empress Kia",--}}
{{--                                    "thumb_url": "hoang-hau-ki-thumb.jpg",--}}
{{--                                    "slug": "hoang-hau-ki",--}}
{{--                                    "year": 2013,--}}
{{--                                    "poster_url": "hoang-hau-ki-poster.jpg"--}}
                                    <td>{{$movi['name']}}</td>
                                    <td>{{$movi['slug']}}</td>
                                    <td>{{$movi['origin_name']}}</td>
                                    <td>
                                        <img width="50" src="{{'https://img.ophim8.cc/uploads/movies/'.$movi['thumb_url']}}">
                                    </td>
                                    <td>
                                        <img width="50" src="{{'https://img.ophim8.cc/uploads/movies/'.$movi['poster_url']}}">
                                    </td>
                                    <td>
                                        {{$movi['year']}}
                                    </td>
                                    <td>
{{--                                        <form action="{{url('episode',['id'=> $epi->id])}}" method="post">--}}
{{--                                            @method('delete')--}}
{{--                                            @csrf--}}
{{--                                            <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirmdelete();"/>--}}
{{--                                        </form>--}}
                                        <a href="{{route('getmoviebyslug',$movi['slug'])}}" class="btn bg-warning">Edit</a>
                                        <a href="{{route('getmoviebyslug',$movi['slug'])}}" class="btn bg-warning">Sync</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

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
