@extends('backend.master')



@section('content')

    {{--<div class="ui label">--}}
        {{--<i class="hashtag icon"></i><span style="color:#f50057;">{{count(\App\Inbox::get())}}</span>&nbsp;  رسالة للإدارة--}}
    {{--</div>--}}
    {{--<div class="ui label">--}}
        {{--<i class="hashtag icon"></i><span style="color:#f50057;">{{count(\App\Page::get())}}</span>&nbsp;  صفحة--}}
    {{--</div>--}}
    {{--<div class="ui label">--}}
        {{--<i class="hashtag icon"></i><span style="color:#f50057;">{{count(\App\Subscriber::get())}}</span>&nbsp;  مشترك فى القائمة البريدية--}}
    {{--</div>--}}

    <hr/>

    <div class="ui four link cards">
        <a href="/dashboard/settings" class="card">
            <div class="image">
                <img src="{{url('/images/png/cogwheel-2.png')}}">
            </div>
            <div class="content">
                <div class="header">الإعدادت العامة</div>
                <div class="description">
                    تعديل إعدادت الموقع من الإسم وبيانات الإتصال وروابط الصفحات الإجتماعية وخلافه
                </div>
            </div>
        </a>
    </div>
@endsection
