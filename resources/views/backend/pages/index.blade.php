@extends('backend.master')



@section('content')


    <h4 class="ui horizontal divider">
        الصفحات
    </h4>



    <div class="ui modal aeform">
        <div class="content">
            {{ Form::open(array('route' => 'pages.store', 'class' => 'ui form', 'id' => 'formpage','files' => true)) }}

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
                        <input name="title[{{$local}}]" type="text" placeholder="العنوان">
                    </div>

                    <div class="field">
                        <label>المحتوى</label>
                        <textarea name="body[{{$local}}]" class="textarea"></textarea>
                    </div>
                    <div class="field">
                        <label>عنوان الـ SEO</label>
                        <input name="seo_title[{{$local}}]" type="text" placeholder="العنوان فى محركات البحث">
                    </div>
                    <div class="field">
                        <label>كلمات مفتاحية للـ SEO</label>
                        <input name="seo_keywords[{{$local}}]" type="text" placeholder="الكلمات المفتاحية">
                    </div>
                    <div class="field">
                        <label>وصف الـ SEO</label>
                        <input name="seo_description[{{$local}}]" type="text" placeholder="الوصف فى محركات البحث">
                    </div>
                </div>
            @endforeach

            <div class="field">
                <label>العنوان</label>
                <input name="slug" id="title" type="text"
                        placeholder="إسم الصفحة أو إختصار معبر لها باللغةالإنجليزية">
            </div>


            <div class="field">
                {!! Form::label('photo', 'الصورة*', array('class'=>'col-sm-2 control-label')) !!}
                    {!! Form::file('photo') !!}
                    {!! Form::hidden('photo_w', 4096) !!}
                    {!! Form::hidden('photo_h', 4096) !!}
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
    </div>

    <table class="ui compact celled definition table">
        <thead class="full-width">
        <tr>
            <th>
                #
            </th>
            <th>عنوان الصفحة</th>
            <th>الحالة</th>
            <th>أنشأت منذ</th>
            <th>عمليات</th>
        </tr>
        </thead>

        <tbody>
        @if (count($pages))
            @foreach($pages as $value)
                <tr class="item-{{$value->id}}">
                    <td class="collapsing">
                        {{ $value->id }}
                    </td>
                    <td>
                        <strong class="content-{{$value->id}}">{{ $value->title }}</strong><br/>{{ str_limit(strip_tags($value->body), 150, '...') }}
                    </td>
                    <td>
                        <i class="circle icon @if ($value->statue) green @endif"></i>
                    </td>
                    <td>{{ \Date::parse($value->created_at)->diffForHumans() }}</td>
                    <td>
                        <div class="ui tiny buttons">
                            <a href="{{url('/dashboard/pages/' . $value->id)}}/edit"
                               class="ui left blue mini attached button icon"><i class="edit icon"></i></a>
                            <a href="{{url('/dashboard/pages/' . $value->id)}}/delete"
                               class="ui right red mini attached button icon"><i class="trash icon"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="ui center aligned"> لا يوجد بيانات</td>
            </tr>
        @endif
        </tbody>

        <tfoot class="full-width">
        <tr>
            <th>
            </th>
            <th colspan="4">
                <button class="ui right floated small primary labeled icon form button">
                    <i class="user icon"></i> صفحة جديدة
                </button>
            </th>
        </tr>
        </tfoot>
    </table>

    @push('scripts')
    <script src="{{url('plugins/tinymce/tinymce.min.js')}}" charset="utf-8"></script>
    <script type="text/javascript">
        $('.aeform.modal')
            .modal('attach events', '.form.button')
            .modal({
                onDeny: function () {
                    return false;
                }
            });
        ;
        tinymce.init({
            selector: '.textarea'
        });
//        $.ajaxSetup({
//            headers: {
//                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//            }
//        });

    </script>
    @endpush

@endsection
