@if ( file_exists(public_path(setting()->icon))&&setting()->icon!="")
    <link rel="shortcut icon" href="{{asset(setting()->icon)}}"/>
@else
<link rel="shortcut icon" href="{{asset('uploads/defaults/kienthuc.png')}}"/>
@endif
