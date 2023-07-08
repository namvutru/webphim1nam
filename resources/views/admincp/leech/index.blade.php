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

                            @foreach($list as $key =>$movi)
                                <tr id="{{$movi->id}}">
                                    <th scope="row">{{$key}}</th>

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
