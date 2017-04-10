@extends('backend.master')

@section('content')

{!! Form::model($menu, ['method' => 'PATCH','route' => ['menu.update', $menu->id], 'class' => 'ui form']) !!}
<div class="ui top attached tabular menu">
    <?php  $count = 0; ?>
    @foreach(config('app.locals') as $local)
        <?php $count++; ?>
        <a class="<?php  if($count == 1){echo ' active';} ?> item" data-tab="{{$local}}">{{$local}}</a>
    @endforeach
</div>
<?php  $count2 = 0; ?>

@foreach(config('app.locals') as $local)
    <?php $count2++; ?>

    <div class="ui bottom attached <?php  if($count2 == 1){echo ' active';} ?> tab segment" data-tab="{{$local}}">

        <div class="field">
            <label>الاسم</label>
            <input name="title[{{$local}}]" value="{{$menu->translateOrNew($local)->title}}" class="form-control" type="text" placeholder="العنوان">
        </div>
</div>
@endforeach

        <div class="fields">
            <div class="twelve wide field  ">
                <label>رابط خارجى</label>
                {!! Form::text('url',  old('url'), array('id'=>'a', 'class'=>'form-control', 'placeholder' => 'أكتب الرابط بدون http://')) !!}
            </div>
            <div class="four wide field">
                <label>رابط من صفحة</label>
                {!! Form::select('url',  $pages, null, array('id'=>'b', 'class'=>'form-control')) !!}
            </div>
        </div>

        <div class="field">
            <label>الترتيب</label>
            {!! Form::text('order', old('order'), array('class'=>'form-control')) !!}
        </div>
        <div class="field">
            <label>الرابط الرئيسيى (الأب)</label>
            {!! Form::select('parent_id', $menus , null, array('class'=>'form-control')) !!}
        </div>

<div class="actions">
    <a onClick="window.history.back()" class="ui black deny button">
        إلغاء
    </a>
    <button type="submit" class="ui positive right labeled icon button">
        حفظ
        <i class="checkmark icon"></i>
    </button>
</div>
{{ Form::close() }}



@push('scripts')
    <script type="text/javascript">
    $(document).ready(function () {
        var dis1 = document.getElementById("a");
        dis1.onchange = function () {
            if (this.value != "" || this.value.length > 0) {
                document.getElementById("b").disabled = true;
            }else {
                document.getElementById("b").disabled = false;
            }
        }
        dis1.onchange()
        })
    </script>
@endpush

@endsection
