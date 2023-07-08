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

                        <table class="table" id="tablephim">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Origin Title</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Image</th>
                                <th scope="col">Sum Episode</th>
                                <th scope="col">Tags</th>

                                {{--                                <th scope="col">Description</th>--}}
                                <th scope="col">Category</th>
                                <th scope="col">Genre</th>
                                <th scope="col">Country</th>
                                <th scope="col">Hot Movie</th>
                                <th scope="col">Resolution</th>
                                <th scope="col">Subtitle</th>
                                <th scope="col">Year</th>
                                <th scope="col">Top Views</th>
                                <th scope="col">Sesion</th>
                                <th scope="col">Date Create</th>
                                <th scope="col">Date Update</th>

                                <th scope="col">Show?</th>
                                <th scope="col">Manage</th>
                            </tr>
                            </thead>
                            <tbody class="order_position">

                            @foreach($list as $key =>$movi)
                                <tr id="{{$movi->id}}">
                                    <th scope="row">{{$key}}</th>
                                    <td>{{$movi->title}}</td>
                                    <td>{{$movi->origintitle}}</td>
                                    <td>{{$movi->duration}}</td>
                                    <td>{{$movi->slug}}</td>
                                    <td><img width="60"  src="{{asset('/uploads/movie/'.$movi->image)}}"/></td>
                                    <td>{{$movi->sumepisode}}
                                    {{--                                    <td>{{$movi->description}}</td>--}}
                                    <td>{{$movi->tags}}</td>
                                    <td>{{$movi->category->title}}</td>
                                    <td>
                                            @foreach($list_movie_genre as $key =>$movi_gen)
                                                @if($movi_gen->movie_id == $movi->id)
                                                <span class="badge badge-dark">{{$movi_gen->genre->title}}</span>
                                               @endif
                                            @endforeach
                                    </td>
                                    <td>{{$movi->country->title}}</td>
                                    @if($movi->phimhot==1)
                                        <td>Hot</td>
                                    @else
                                        <td>Normal</td>
                                    @endif

                                    @if($movi->resolution==0)
                                            <td>HD</td>
                                    @elseif($movi->resolution==1)
                                        <td>SD</td>
                                    @elseif($movi->resolution==2)
                                        <td>CAM</td>
                                    @elseif($movi->resolution==3)
                                        <td>Full HD</td>
                                        @else
                                        <td>Trailer</td>
                                    @endif

                                    @if($movi->subtitle==1)
                                        <td>Thuyết minh</td>
                                    @else
                                        <td>Phụ đề</td>
                                    @endif
                                    <td>
                                    <select id="{{$movi->id}}" class="select-year">
                                        @for($x = 2023; $x >= 1970; $x--)
                                            @if($x==$movi->year)
                                                <option value="{{$x}}" selected>{{$x}}</option>
                                            @else
                                                <option value="{{$x}}">{{$x}}</option>
                                            @endif

                                        @endfor
                                    </select>
                                    </td>
                                    <td>
                                        <select class="select-topview" id="{{$movi->id}}">
                                            @if($movi->topview==0)
                                            <option value="0"selected>Day</option>
                                            <option value="1">Week</option>
                                            <option value="2">Month</option>

                                            @elseif($movi->topview==1)
                                                <option value="0">Day</option>
                                                <option value="1"selected>Week</option>
                                                <option value="2">Month</option>

                                            @elseif($movi->topview==2)
                                                <option value="0">Day</option>
                                                <option value="1">Week</option>
                                                <option value="2"selected>Month</option>
                                            @else
                                                <option value="0">Day</option>
                                                <option value="1">Week</option>
                                                <option value="2">Month</option>
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <select id="{{$movi->id}}" class="select-season">
                                            @for($x = 0; $x <=25; $x++)
                                                @if($x==$movi->season)
                                                    <option value="{{$x}}" selected>{{$x}}</option>
                                                @else
                                                    <option value="{{$x}}">{{$x}}</option>
                                                @endif

                                            @endfor
                                        </select>
                                    </td>

                                    <td>{{$movi->datecreate}}</td>
                                    <td>{{$movi->dateupdate}}</td>

                                    @if($movi->status==1)
                                        <td>Hiển thị</td>
                                    @else
                                        <td>Không hiển thị</td>
                                    @endif
                                    <td>
                                        <form action="{{url('movie',['id'=> $movi->id])}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirmdelete();"/>
                                        </form>
                                        <a href="{{route('movie.edit',$movi->id)}}" class="btn bg-warning">Edit</a>
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
