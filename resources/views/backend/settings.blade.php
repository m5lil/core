@extends('backend.master')

@section('content')
    <h4 class="ui horizontal divider">
        خصائص الموقع
    </h4>

    {!! Form::open(['action' => 'SettingController@update', 'method' => 'post' ,'class' => 'ui form','files' => true]) !!}

    @foreach ($settings as $setting)
        <div class="field">
            <label style="color: teal;">{{ $setting->set_slug }} : </label>

            @if($setting->type == 1)
                {!! Form::text($setting->set_name, $setting->value , ['class' => 'form-control']) !!}
            @elseif($setting->type == 2)
                {!! Form::textarea($setting->set_name, $setting->value , ['class' => 'form-control']) !!}
            @elseif($setting->set_name == 'statue')
                {!! Form::select($setting->set_name,['online' => 'Online', 'offline' => 'Offline'] , $setting->value , ['class' => 'form-control']) !!}
            @elseif($setting->set_name == 'direction')
                {!! Form::select($setting->set_name,['rtl' => 'Right to left', 'ltr' => 'Left To Right'] , $setting->value , ['class' => 'form-control']) !!}

            @elseif($setting->set_name == 'fav_icon')
                {!! Form::file($setting->set_name) !!}
                {!! Form::hidden('fav_icon_w', 16) !!}
                {!! Form::hidden('fav_icon_h', 16) !!}

                <img src="{{url('/uploads/thumb/' . $setting->value)}}" alt="thumbnail">

            @elseif($setting->set_name == 'logo')
                {!! Form::file($setting->set_name) !!}
                <img src="{{url('/uploads/thumb/' . $setting->value)}}" alt="thumbnail">
            @endif

        </div>
        <br/>
    @endforeach
    <div class="field">
        <input type="submit" name="submit" value="حفظ" class="ui teal button">
    </div>

    {!! Form::close() !!}

@endsection
