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
                        <option value="{{$cate->id}}">{{$cate->title}}</option>
                    @endforeach
                </select>
                <select name="genre" class="form-control" aria-label=".form-select-sm example">
                    <option value="" >Chọn thể loại</option>
                    @foreach($genre as $key =>$gen)
                        <option value="{{$gen->id}}">{{$gen->title}}</option>
                    @endforeach
                </select>
                <select name="country" class="form-control" aria-label=".form-select-sm example">
                    <option value="">Chọn quốc gia</option>
                    @foreach($country as $key =>$coun)
                        <option value="{{$coun->id}}">{{$coun->title}}</option>
                    @endforeach
                </select>
                <select name="year" class="form-control" aria-label=".form-select-sm example">
                    <option value="">Chọn năm</option>
                    @for($x = 2023; $x >= 1970; $x--)
                        <option value="{{$x}}">{{$x}}</option>
                    @endfor
                </select>
                <button class="btn btn-sm btn-default">Lọc phim</button>
            </div>
        </div>
    </form>

</div>
