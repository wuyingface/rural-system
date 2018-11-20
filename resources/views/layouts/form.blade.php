<!-- <form action="{{ route('articles.store') }}" method="POST" accept-charset="UTF-8">
                
    <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
    <div class="form-group">
        <input class="form-control" type="text" name="title" value="{{ old('title', $article->title ) }}" placeholder="请填写标题" required/>
    </div>

    <div class="form-group">
        <select class="form-control" name="category_id" required>
            <option value="" hidden disabled {{ $article->id ? '' : 'selected' }}>请选择分类</option>
            @foreach ($categories as $value)
                <option value="{{ $value->id }}" {{ $article->category_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <textarea name="body" class="form-control" id="editor" rows="3" placeholder="请填入至少十三字符的内容。" required>{{ old('body', $article->body ) }}</textarea>
    </div>
    <!-- 地图 -->
    <div class="form-group" style="display: none;">
        <input name="map" id="coordinate" value="{{old('map', $article -> map)}}">
    </div>
        
    <div class="form-group">
        <input type="text" name="location" class="form-control" id="position" placeholder="请点击地图选取位置" style="width: 500px;display: inline-block;" readonly="readonly" value="{{old('location', $article -> location)}}">
        <a href="javascript:void(0);" onclick="hasMap()" id="hasMap">显示地图</a>
    </div>

    <div class="form-group">
        <input type="text" name="location_name" class="form-control" style="display: none;margin-bottom: 5px;" id="userDefined" placeholder="自定义地址名称" value="{{old('location_name', $article -> location_name)}}" />
        <div style="display: none;" id="mapWrap">
            <input class="form-control" type="text" placeholder="搜索位置" id="searchId">
            <div id="map" style="height: 500px;"></div>
        </div>
    </div>

    <div class="well well-sm">
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存</button>
    </div>
<!-- </form> -->