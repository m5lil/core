@extends('backend.master')

@section('content')

    @if (!\Auth::user()->can('enquiry'))

        {{ Form::model($page, array('method' => 'PATCH','route' =>['pages.update', $page->id], 'class' => 'ui form', 'id' => 'formpage','files' => true)) }}
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
                    <input name="title[{{$local}}]" id="title" type="text"
                           value="{{$page->translateOrNew($local)->title}}" placeholder="العنوان">
                </div>

                <div class="field">
                    <label>المحتوى</label>
                    <textarea name="body[{{$local}}]"
                              class="textarea">{{$page->translateOrNew($local)->body}}</textarea>
                </div>
                <div class="field">
                    <label>عنوان الـ SEO</label>
                    <input name="seo_title[{{$local}}]" value="{{$page->translateOrNew($local)->seo_title}}"
                           id="seo_title" type="text" placeholder="العنوان فى محركات البحث">
                </div>
                <div class="field">
                    <label>كلمات مفتاحية للـ SEO</label>
                    <input name="seo_keywords[{{$local}}]" value="{{$page->translateOrNew($local)->seo_keywords}}"
                           id="seo_keywords" type="text" placeholder="الكلمات المفتاحية">
                </div>
                <div class="field">
                    <label>وصف الـ SEO</label>
                    <input name="seo_description[{{$local}}]" value="{{$page->translateOrNew($local)->seo_description}}"
                           id="seo_description" type="text" placeholder="الوصف فى محركات البحث">
                </div>
            </div>
        @endforeach

        <div class="field">
            <label>العنوان</label>
            <input name="slug" id="title" type="text"
                   value="{{$page->slug}}" placeholder="إسم الصفحة أو إختصار معبر لها باللغةالإنجليزية">
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
                <img src="{{url('/uploads/thumb/' . $page->photo)}}" alt="thumbnail">
            </div>
        </div>

        <div class="inline  field">
            <div class="ui toggle checkbox">
                {!! Form::checkbox('statue', 1)  !!}
                {!! Form::label('statue', 'منشور') !!}
            </div>
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


    @else



        <div class="ui center aligned basic segment">
            <i class="circular massive lock icon"></i>
            <h4>لا تملك التصريح للدخول لهذه الصفحة</h4>
            <div class="ui horizontal divider">
                Access Denied
            </div>
            <p>سيتم تحويلك فى غضون ثوانى</p>
            @push('scripts')
            <script type="text/javascript">
                setTimeout("window.history.go(-1)", 4000);
            </script>
            @endpush
        </div>


    @endif


    @push('scripts')
    <script src="{{url('plugins/tinymce/tinymce.min.js')}}" charset="utf-8"></script>

    <script type="text/javascript">
        tinymce.init({
            selector: '.textarea'
        });


    </script>
    @endpush



@endsection


