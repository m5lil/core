@extends('backend.master')



@section('content')


    <h4 class="ui horizontal divider">
الأقسام
    </h4>


    <div class="ui modal category_form">
        <div class="content">
            {{ Form::open(array('route' => 'categories.store', 'class' => 'ui form', 'id' => 'formpage')) }}

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
                </div>
            @endforeach
            <div class="field">
                <label>عنوان الـ رابط</label>
                <input name="slug" type="text"
                       value="" placeholder="إسم القسم أو إختصار معبر لها باللغةالإنجليزية">
            </div>

            <div class="field">
                <select name="statue" class="ui dropdown">
                    <option value="1">منشورة</option>
                    <option value="0">غير منشورة</option>
                </select>
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
            <th>عنوان القسم</th>
            <th>الحالة</th>
            <th>أنشأت منذ</th>
            <th>عمليات</th>
        </tr>
        </thead>

        <tbody>
        @if (isset($categories) AND count($categories))
            @foreach($categories as $value)
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
                            <a href="{{url('/dashboard/blog/categories/' . $value->id)}}/edit"
                               class="ui left blue mini attached button icon"><i class="edit icon"></i></a>
                            <a href="{{url('/dashboard/blog/categories/' . $value->id)}}/delete"
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
        $('.category_form.modal')
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
    @endpush

@endsection
