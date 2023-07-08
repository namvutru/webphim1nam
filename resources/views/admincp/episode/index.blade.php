@extends('layouts.app')
@section('content')
    <div class="container-fluid">
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
                        <a href="{{ route('episode.create')}}">Thêm tập phim</a>

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
