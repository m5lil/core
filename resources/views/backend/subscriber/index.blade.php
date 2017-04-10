@extends('backend.master')



@section('content')

    {{-- <div id="app">
        <example></example>
    </div> --}}


    <h4 class="ui horizontal divider">
        الرسائل
    </h4>
    <div class="ui modal eshow">
        <div class="header">إرسال نشرة بريدية</div>
        <div class="content">
            <div class="ui header" id="subject"></div>
            {{Form::open(array('route' => 'subscribers.store','method' => 'post'))}}
            <div class="ui form bottom attached">
                <div class="field">
                    <label>العنوان الرئيسي</label>
                    <input name="subject" type="text" placeholder="العنوان">
                </div>
                <div class="field">
                    <label>مضمون النشرة</label>
                    <textarea name="message" class="textarea"></textarea>
                </div>
                {{Form::submit('إرسال!',['class' => 'ui positive right labeled icon button'])}}
            </div>
            {{Form::close()}}


        </div>
    </div>

    <table class="ui compact basic table">
        <thead class="full-width">
        <tr>
            <th>
                #
            </th>
            <th>الإسم</th>
            <th>الإيميل</th>
            <th>منذ</th>
            <th>عمليات</th>
        </tr>
        </thead>

        <tbody>
        @foreach($subscribers as $value)
            <tr
                    @if (!$value->read)
                    class="positive"
                    @endif
            >
                <td class="collapsing">
                    {{$value->id}}
                </td>
                <td><strong>{{$value->name}}</strong></td>
                <td>{{$value->email}}</td>
                <td>{{ \Date::parse($value->created_at)->diffForHumans() }}</td>
                <td class="two wide">
                    <a href="{{url('/dashboard/subscribers/' . $value->id)}}/delete"
                       class="ui right red mini attached button icon"><i class="trash icon"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot class="full-width">
        <tr>
            <th>
            </th>
            <th colspan="4">
                <button class="ui right floated small primary labeled icon show_msg form button">
                    <i class="send icon"></i> إرسال نشرة بريدية
                </button>
            </th>
        </tr>
        </tfoot>

    </table>




    @push('scripts')
    <script src="{{url('plugins/tinymce/tinymce.min.js')}}" charset="utf-8"></script>

    <script type="text/javascript">


        $('.eshow.modal')
            .modal('attach events', '.form.button')
            .modal({
                onDeny: function () {
                    return false;
                }
            });



        tinymce.init({
            selector: '.textarea'
        });

    </script>
    @endpush


@endsection
