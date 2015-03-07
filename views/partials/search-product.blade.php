<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">帝享</a>
    </div>
    <div>
        {{Form::open(['url'=>'products/search', 'method'=>'GET', 'class'=>'navbar-form navbar-left', 'role'=>'search'])}}
        <div class="form-group">
            {{Form::label('q', '关键词', ['class'=>'control-label'])}}
            <input type="text" name="q" value="{{{isset($q['q']) ? $q['q'] : ''}}}" class="form-control" placeholder="关键词">
        </div>

        <div class="form-group">
            {{Form::label('c', '分类', ['class'=>'control-label'])}}
            @if(isset($q['c']))
                {{Form::select('c', Category::selectOptions('Select'), $q['c'], ['class'=>'form-control'])}}
            @else
                {{Form::select('c', Category::selectOptions('Select'), '', ['class'=>'form-control'])}}
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
            {{Form::label('t', '筛选', ['class'=>'control-label'])}}
            <?php
                $ops_t = [
                        0 => 'Select',
                        1 => '综合排名',
                        2 => '销量最高',
                        3 => '价格最低',
                        4 => '价格最高',
                        5 => '好评优先',
                        6 => '最新发布',
                ];
            ?>
            @if(isset($q['t']))
                {{Form::select('t', $ops_t, $q['t'], ['class'=>'form-control'])}}
            @else
                {{Form::select('t', $ops_t, '', ['class'=>'form-control'])}}
            @endif
        </div>

        <button type="submit" class="btn btn-primary">产品搜索</button>
        {{Form::close()}}
    </div>
</nav>
