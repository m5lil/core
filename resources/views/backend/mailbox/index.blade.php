@extends('backend.master')



@section('content')

    {{-- <div id="app">
        <example></example>
    </div> --}}


    <h4 class="ui horizontal divider">
        الرسائل
    </h4>

    <div class="ui modal eshow">
        <div class="header">محتوى الرساله</div>
        <div class="content">
            <div class="ui header" id="subject"></div>
            <p id="body"></p>
            <hr/>
            <span id="name"></span> -
            <span id="phone"></span> -
            <span id="email"></span>
        </div>
    </div>
    <div class="ui modal ereply">
        <div class="header">محتوى الرساله</div>
        <div class="content">
            <div class="ui header" id="subject"></div>
            <p id="name"></p>
            <p id="body"></p>
            <hr/>
            <p id="phone"></p>
            <p id="email"></p>
        </div>
    </div>

    <table class="ui compact basic table">
        <thead class="full-width">
        <tr>
            <th>
                #
            </th>
            <th>عنوان الرسالة</th>
            <th>المرسل</th>
            <th>إيميل المرسل</th>
            <th>منذ</th>
            <th>عمليات</th>
        </tr>
        </thead>

        <tbody>
        @foreach($inbox as $value)
            <tr
                    @if (!$value->read)
                    class="positive"
                    @endif
            >

                <td class="collapsing">
                    @if (!$value->read)
                        <div class="ui blue ribbon label"><i class="hide icon"></i></div>
                    @endif
                    {{$value->id}}
                </td>
                <td>{{$value->subject}}</td>
                <td><strong>{{$value->name}}</strong></td>
                <td>{{$value->email}}</td>
                <td>{{ \Date::parse($value->created_at)->diffForHumans() }}</td>
                <td class="two wide">
                    <a href='/dashboard/inbox/{{$value->id}}' class="ui left blue mini attached show_msg button icon"><i
                                class="unhide icon"></i></a>
                    <a href="{{$value->id}}" class="ui right red mini attached delete_msg button icon"><i
                                class="trash icon"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>



    @push('scripts')
    <script type="text/javascript">


        // Show Message
        $('.show_msg').on('click', function (e) {
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function (data) {
                //success data
                $('#id').empty().append(data.id);
                $('#subject').empty().append(data.subject);
                $('#name').empty().append(data.name);
                $('#phone').empty().append(data.phone);
                $('#email').empty().append(data.email);
                $('#body').empty().append(data.body);

                $('.eshow.modal').modal('show');
            });
        });



        // TODO : Replay Message



        $('.delete_msg').on('click', function (e) {
            e.preventDefault();
            var target = $(this).attr("href");
            var self = $(this)

            swal({
                title: 'هل أنت متأكد?',
                text: "لن تكون قادر على التراجع !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم, بقم بالحذف!',
                cancelButtonText: 'لا, قم بالإلغاء!',
                confirmButtonClass: 'ui blue button',
                cancelButtonClass: 'ui red button',
                buttonsStyling: false
            }).then(function () {
                $.ajax({
                    type: 'post',
                    url: 'inbox/delete',
                    data: {
                        '_token': $("input[name='_token']").val(),
                        'id': self.attr("href")
                    },
                    success: function (data) {
                        $('.item' + '-' + target).remove();
                    }
                });
                swal(
                    'تم الحذف!',
                    'لقد قمت بالحذف بنجاح.',
                    'success'
                )
            }, function (dismiss) {
                if (dismiss === 'cancel') {
                    swal(
                        'تم التراجع',
                        'السجل الذى كنت على وشك حذفه بأمان :)',
                        'error'
                    )
                }
            })
        });


    </script>
    @endpush

@endsection
