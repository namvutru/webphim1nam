@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Quản lí Thông tin Website') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form action="{{route('info.update',$info->id)}}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label id="title">Title</label>
                                    <input type="text" name="title" id="slug" value="{{$info->title}}"  class="form-control" onkeyup="ChangeToSlug()" placeholder="...">
                                </div>

                                <div class="form-group">
                                    <label id="description">Description</label>
                                    <textarea type="text" name="description"  style="resize: none"  id="description" class="form-control" >{{$info->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                        <input type="file" name="logo"  class="form-control-file" accept="{{asset('uploads/logo/'.$info->logo)}}" >
                                        <img  src="{{asset('uploads/logo/'.$info->logo)}}">
                                </div>
                                <input type="submit" class="btn btn-success" value="Cập nhật thông tin website">
                            </form>


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
