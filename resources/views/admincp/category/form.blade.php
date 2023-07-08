@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Quản lí danh mục') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(!isset($category))
                                <form action="{{route('category.store')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label id="title">Title</label>
                                        <input type="text" name="title" id="slug"  class="form-control" onkeyup="ChangeToSlug()" placeholder="...">
                                    </div>
                                    <div class="form-group">
                                        <label id="slug">Slug</label>
                                        <input type="text" name="slug"  id="convert_slug" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label id="description">Description</label>
                                        <textarea type="text" name="description" style="resize: none"  class="form-control" ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label id="status">Status</label>
                                        <select class="form-select" name="status" aria-label="Default select example">
                                            <option value="1">Hiển thị</option>
                                            <option value="0">Không hiển thị</option>
                                        </select>
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Thêm dữ liệu">
                                </form>
                        @else
                                <form action="{{url('category',['id'=> $category->id])}}" method="post">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-group">
                                        <label id="title">Title</label>
                                        <input type="text" name="title" id="slug" value="{{$category->title}}"  class="form-control" onkeyup="ChangeToSlug()" placeholder="...">
                                    </div>
                                    <div class="form-group">
                                        <label id="slug">Slug</label>
                                        <input type="text" name="slug"  id="convert_slug" value="{{$category->slug}}" class="form-control"  >
                                    </div>
                                    <div class="form-group">
                                        <label id="description">Description</label>
                                        <textarea type="text" name="description" style="resize: none"    class="form-control" >{{$category->description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label id="status">Status</label>
                                        @if($category->status==1)
                                            <select class="form-select" name="status" >
                                                <option value="1" selected>Hiển thị </option>
                                                <option value="0">Không hiển thị</option>
                                            </select>
                                        @else
                                            <select class="form-select" name="status" >
                                                <option value="1">Hiển thị</option>
                                                <option value="0" selected>Không hiển thị</option>
                                            </select>
                                        @endif

                                    </div>
                                    <input type="submit" class="btn btn-success" value="Cập nhật">
                                </form>
                        @endif



                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Show?</th>
                                    <th scope="col">Manage</th>
                                </tr>
                                </thead>
                                <tbody class="order_position">

                                @foreach($list as $key =>$cate)
                                <tr id="{{$cate->id}}">
                                    <th scope="row">{{$key}}</th>
                                    <td>{{$cate->title}}</td>
                                    <td>{{$cate->slug}}</td>
                                    <td>{{$cate->description}}</td>
                                    @if($cate->status==1)
                                        <td>Hiển thị</td>
                                    @else
                                        <td>Không hiển thị</td>
                                    @endif
                                    <td>
                                        <form action="{{url('category',['id'=> $cate->id])}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <input type="submit" value="Delete" class="btn btn-danger" onclick="confirmdelete()"/>
                                        </form>
                                        <a href="{{route('category.edit',$cate->id)}}" class="btn bg-warning">Edit</a>
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
