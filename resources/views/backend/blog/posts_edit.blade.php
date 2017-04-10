@extends('backend.master')



@section('content')


    <h4 class="ui horizontal divider">
        تعديل مقال
    </h4>


    {{ Form::model($post, array('method' => 'PATCH','route' =>['posts.update', $post->id], 'class' => 'ui form', 'id' => 'formpage','files' => true)) }}

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
                {!! Form::text('title[' . $local . ']', $post->translateOrNew($local)->title, array('class'=>'form-control')) !!}
            </div>

            <div class="field">
                <label>المحتوى</label>
                {!! Form::textarea('body[' . $local . ']', $post->translateOrNew($local)->body, array('class'=>'textarea')) !!}
            </div>
            <div class="field">
                <label>عنوان الـ SEO</label>
                {!! Form::text('seo_title[' . $local . ']', $post->translateOrNew($local)->seo_title, array('class'=>'form-control')) !!}

            </div>
            <div class="field">
                <label>كلمات مفتاحية للـ SEO</label>
                {!! Form::text('seo_keywords[' . $local . ']', $post->translateOrNew($local)->seo_keywords, array('class'=>'form-control')) !!}

            </div>
            <div class="field">
                <label>وصف الـ SEO</label>
                {!! Form::text('seo_description[' . $local . ']', $post->translateOrNew($local)->seo_description, array('class'=>'form-control')) !!}

            </div>
        </div>
    @endforeach


    <div class="field">
        {!! Form::label('category_id', 'القسم') !!}
        {!! Form::select('category_id', \App\Category::translated()->get()->pluck('title','id'), $post->translateOrNew($local)->category_id) !!}
    </div>

    <div class="fields">
        <div class="fourteen wide field">
            {!! Form::label('photo', 'الصورة*', array('class'=>'col-sm-2 control-label')) !!}
            {!! Form::file('photo') !!}
            {!! Form::hidden('photo_w', 4096) !!}
            {!! Form::hidden('photo_h', 4096) !!}
        </div>
        <div class="two wide field">
            <br>
            <img src="{{url('/uploads/thumb/' . $post->photo)}}" alt="thumbnail">
        </div>
    </div>

    <div class="inline  field">
        <div class="ui toggle checkbox">
            {!! Form::checkbox('statue', 1)  !!}
            {!! Form::label('statue', 'منشور') !!}
        </div>
    </div>

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

    @push('scripts')
    <script src="{{url('plugins/tinymce/tinymce.min.js')}}" charset="utf-8"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '.textarea'
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
    @endpush

@endsection
