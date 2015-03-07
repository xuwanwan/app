<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">帝享</a>
    </div>
    <div>
        {{Form::open(['url'=>'sellers/search', 'method'=>'GET', 'class'=>'navbar-form navbar-left', 'role'=>'search'])}}
        <div class="form-group">
            {{Form::label('q', '关键词', ['class'=>'control-label'])}}
            <input type="text" name="q" value="{{{isset($q['q']) ? $q['q'] : ''}}}" class="form-control" placeholder="关键词">
        </div>

        <div class="form-group">
            {{Form::label('c', '分类', ['class'=>'control-label'])}}
            @if(isset($q['c']))
                {{Form::select('c', SellerCategory::selectOptions('Select'), $q['c'], ['class'=>'form-control'])}}
            @else
                {{Form::select('c', SellerCategory::selectOptions('Select'), '', ['class'=>'form-control'])}}
            @endif
        </div>
        <div class="form-group">
            {{Form::label('d', '地区', ['class'=>'control-label'])}}
            @if(isset($q['d']))
                {{Form::select('d', \Weile\OrderedTreeDistrict::selectOptions(), $q['d'], ['class'=>'form-control'])}}
            @else
                {{Form::select('d', \Weile\OrderedTreeDistrict::selectOptions(), '', ['class'=>'form-control'])}}
            @endif
        </div>
        <div class="form-group">
            {{Form::label('l', '距离', ['class'=>'control-label'])}}
            <?php
            $ops_t = [
                    0 => 'Select',
                    1 => '1km',
                    2 => '2km',
                    3 => '3km',
                    5 => '5km',
                    10 => '10km',
            ];
            ?>
            @if(isset($q['l']))
                {{Form::select('l', $ops_t, $q['l'], ['class'=>'form-control'])}}
            @else
                {{Form::select('l', $ops_t, '', ['class'=>'form-control'])}}
            @endif
        </div>
        <div class="form-group">
            {{Form::label('t', '筛选', ['class'=>'control-label'])}}
            <?php
                $ops_t = [
                        0 => 'Select',
                        1 => '离我最近',
                        2 => '评价最高',
                        3 => '我想要的',
                ];
            ?>
            @if(isset($q['t']))
                {{Form::select('t', $ops_t, $q['t'], ['class'=>'form-control'])}}
            @else
                {{Form::select('t', $ops_t, '', ['class'=>'form-control'])}}
            @endif
        </div>

        <div class="form-group">
            {{Form::label('x', '经度', ['class'=>'control-label'])}}
            <input type="text" name="x" value="{{{isset($q['x']) ? $q['x'] : ''}}}" class="form-control" placeholder="经度">
            {{Form::label('y', '纬度', ['class'=>'control-label'])}}
            <input type="text" name="y" value="{{{isset($q['y']) ? $q['y'] : ''}}}" class="form-control" placeholder="纬度">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">商铺搜索</button>
        </div>
        {{Form::close()}}
    </div>
</nav>
