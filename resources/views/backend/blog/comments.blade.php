@extends('backend.master')



@section('content')


    <h4 class="ui horizontal divider">
التعليقات
    </h4>

    <div class="ui modal eshow">
        <div class="header">
            <p id="title"></p>
        </div>
        <div class="content">
            <div class="ui header" id="subject"></div>
            <strong>الإيميل</strong> : <p id="email"></p>
            <strong>تم التعليق فى المقال </strong> : <p id="post_id"></p>
            <strong>بواسطة العضو </strong> : <p id="user_id"></p>
            <strong>التعليق</strong> : <p id="body"></p>
        </div>
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
        @if (isset($comments) AND count($comments))
            @foreach($comments as $value)
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
                            <a href = '/dashboard/blog/comments/{{$value->id}}'
                               class="ui left blue mini attached show_msg button icon"><i class="unhide icon"></i></a>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.show_msg').on('click',function(e){
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function (data) {
                //success data
                $('.eshow.modal').modal({
                    onShow : function() {
                        $('#id').empty().append(data.data.id);
                        $('#title').empty().append(data.data.title);
                        $('#email').empty().append(data.data.email);
                        $('#body').empty().append(data.data.body);
                        $('#post_id').empty().append(data.post_name);
                        $('#user_id').empty().append(data.user_name);
                    }
                }).modal('show');
            });
        });


    </script>
    @endpush

@endsection
