<div class="section-bar clearfix">
    <style>
        .select-row {
            display: flex;
            align-items: center;
        }

        .select-row select {
            margin-right: 10px;
        }
    </style>

    <form action="{{route('filter_movie')}}" method="get">
        <div class="col-md-13">
            <div class="select-row">

                <select name="category" class="form-control" aria-label=".form-select-sm example">
                    <option value="">Chọn danh mục</option>
                    @foreach($category as $key =>$cate)
                        @if(isset($category_filter))
                            @if($category_filter==$cate->id)
                                <option value="{{$cate->id}}" selected>{{$cate->title}}</option>
                            @else
                                <option value="{{$cate->id}}">{{$cate->title}}</option>
                            @endif
                        @else
                            <option value="{{$cate->id}}">{{$cate->title}}</option>
                        @endif
                    @endforeach
                </select>
                <select name="genre" class="form-control" aria-label=".form-select-sm example">
                    <option value="" >Chọn thể loại</option>
                    @foreach($genre as $key =>$gen)
                        @if(isset($genre_filter))
                            @if($genre_filter==$gen->id)
                                <option value="{{$gen->id}}" selected>{{$gen->title}}</option>
                            @else
                                <option value="{{$gen->id}}">{{$gen->title}}</option>
                            @endif
                        @else
                            <option value="{{$gen->id}}">{{$gen->title}}</option>
                        @endif
                    @endforeach
                </select>
                <select name="country" class="form-control" aria-label=".form-select-sm example">
                    <option value="">Chọn quốc gia</option>
                    @foreach($country as $key =>$coun)
                        @if(isset($country_filter))
                            @if($country_filter==$coun->id)
                                <option value="{{$coun->id}}" selected>{{$coun->title}}</option>
                            @else
                                <option value="{{$coun->id}}">{{$coun->title}}</option>
                            @endif
                        @else
                            <option value="{{$coun->id}}">{{$coun->title}}</option>
                        @endif
                    @endforeach
                </select>
                <select name="year" class="form-control" aria-label=".form-select-sm example">
                    <option value="">Chọn năm</option>
                    @for($x = 2023; $x >= 1970; $x--)
                        @if(isset($year_filter))
                            @if($year_filter==$x)
                                <option value="{{$x}}" selected>{{$x}}</option>
                            @else
                                <option value="{{$x}}">{{$x}}</option>
                            @endif

                        @else
                            <option value="{{$x}}">{{$x}}</option>
                        @endif



                    @endfor
                </select>
                <button class="btn btn-sm btn-default">Lọc phim</button>
            </div>
        </div>
    </form>

</div>
