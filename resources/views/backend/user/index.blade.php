@extends('backend.master')



@section('content')

{{-- <div id="app">
    <example></example>
</div> --}}

{{-- $request->fullUrlWithQuery(['bar' => 'baz']) --}}
    <h2 class="ui horizontal divider">
            الأعضاء
    </h2>




    <table class="ui compact celled definition table">
        <thead class="full-width">
        @if(isset($users))

            <tr>
                <th>
                    #
                </th>
                <th>الإسم</th>
                <th>البريد الإلكترونى</th>
                <th>الحالة</th>
                <th>عمليات</th>
            </tr>
        @endif

        </thead>
        <tbody>
        @if (isset($users) AND count($users))
            @foreach($users as $value)
                    <tr>
                      <td class="collapsing">{{$value->id}}</td>
                      <td>{{$value->name}}</td>
                      <td>{{$value->email}}</td>
                      <td>
                          <i class="circle icon
                          @if ($value->activated != 0)
                              green
                          @endif
                          "></i>
                      </td>
                      <td class="two wide">
                          <a href = "{{'/dashboard/users/' . $value->id}}/edit" class="ui left blue mini attached edit_form button icon"><i class="edit icon"></i></a>
                          <a href="{{url('/dashboard/users/activate/') . '/' . $value->id}}"
                             class="ui right mini attached button icon"><i class="
                    @if($value->activated == 0)
                                      checkmark blue
                                  @else()
                                      ban
                                  @endif
                                      icon"></i></a>
                          <a href = "{{'/dashboard/users/' . $value->id}}/delete"  class="ui right red mini attached delete_form button icon"><i class="trash icon"></i></a>
                      </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="ui center aligned"> لا يوجد بيانات </td>
                </tr>
            @endif
        </tbody>

    </table>
@if(isset($users))
    {{ $users->links() }}
@endif

   @push('scripts')
       {{-- <script type="text/javascript">
           $('.aeform.modal')
             .modal('attach events', '.form.button')
           ;
       </script> --}}
   @endpush

@endsection
