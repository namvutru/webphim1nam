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
                        <p>Tên phim : {{$movie->title}}</p>
                        <p>Số tập : {{$movie->sumepisode}}</p>


                            <form action="{{route('synx-phim')}}" method="post" >
                                @csrf
                                <input type="hidden" name="slug" value="{{$movie->slug}}">
                                <button type="submit" >Synx</button>
                            </form>

                        <table class="table" id="tablephim">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">tập</th>
                                <th scope="col">Link tập</th>

                                <th scope="col">Manage</th>
                            </tr>
                            </thead>
                            <tbody class="order_position">

                            @foreach($list_episode as $key =>$epi)
                                <tr id="">
                                    <th scope="row">{{$key}}</th>


                                    {{--                                    "_id": "624c1536c78eb57bbfe486ba",--}}
                                    {{--                                    "name": "Hoàng hậu Ki",--}}
                                    {{--                                    "origin_name": "The Empress Kia",--}}
                                    {{--                                    "thumb_url": "hoang-hau-ki-thumb.jpg",--}}
                                    {{--                                    "slug": "hoang-hau-ki",--}}
                                    {{--                                    "year": 2013,--}}
                                    {{--                                    "poster_url": "hoang-hau-ki-poster.jpg"--}}
                                    <td>{{$epi->episode}}</td>
                                    <td>{{ $epi->linkphim }}</td>
                                    <td>
                                        {{--                                        <form action="{{url('episode',['id'=> $epi->id])}}" method="post">--}}
                                        {{--                                            @method('delete')--}}
                                        {{--                                            @csrf--}}
                                        {{--                                            <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirmdelete();"/>--}}
                                        {{--                                        </form>--}}
{{--                                        <a href="{{route('getmoviebyslug',$movi['slug'])}}" class="btn bg-warning">Edit</a>--}}
{{--                                        <a href="{{route('getmoviebyslug',$movi['slug'])}}" class="btn bg-warning">Sync</a>--}}
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
