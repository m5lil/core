@extends('backend.master')



@section('content')


    <h4 class="ui horizontal divider">
        الأقسام
    </h4>

    {{ Form::model($category, array('method' => 'PATCH','route' => ['categories.update', $category->id], 'class' => 'ui form', 'id' => 'formpage')) }}

    <div class="ui top attached tabular menu">
        <?php  $count = 0; ?>
        @foreach(config('app.locals') as $local)
            <?php $count++; ?>
            <a class="<?php  if ($count == 1) {
                echo ' active';
            } ?> item" data-tab="{{$local}}">{{$local}}</a>
        @endforeach
    </div>
    <?php  $count2 = 0; ?>

    @foreach(config('app.locals') as $local)
        <?php $count2++; ?>

        <div class="ui bottom attached <?php  if ($count2 == 1) {
            echo ' active';
        } ?> tab segment" data-tab="{{$local}}">
            <div class="field">
                <label>العنوان</label>
                <input name="title[{{$local}}]" value="{{$category->translateOrNew($local)->title}}" type="text"
                       placeholder="العنوان">
            </div>
        </div>
    @endforeach
    <div class="field">
        <label>عنوان الـ رابط</label>
        <input name="slug" type="text"
               value="{{$category->slug}}" placeholder="إسم القسم أو إختصار معبر لها باللغةالإنجليزية">
    </div>

    <div class="field">
        <select name="statue" class="ui dropdown">
            <option value="1">منشورة</option>
            <option value="0">غير منشورة</option>
        </select>
    </div>


    <div class="actions">
        <button class="ui black deny button">
            إلغاء
        </button>
        <button class="ui positive right labeled icon button">
            حفظ
            <i class="checkmark icon"></i>
        </button>
    </div>
    {{ Form::close() }}




@endsection
