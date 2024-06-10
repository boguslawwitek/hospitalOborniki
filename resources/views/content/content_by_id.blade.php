@extends('layouts.default')
@section('title')
- {{ $content->title }}
@endsection
@section('content')

    {!! $body !!}

    @if (count($content->employees))
    <h2>Pracownicy</h2>
    <ul>
        @foreach( $content->employees as $employee)
            <li>{{ $employee->name }} stanowisko {{ $employee->workplace  }}, tel {{ $employee->phone}} , mail {{ $employee->email }}</li>
        @endforeach
    </ul>

    @endif


    @if (count($content->notifications))
    <h2>Powiadomienia</h2>
    <ul>
        @foreach( $content->notifications as $notification)
            <li>Title: {{ $notification->title }} <hr /> Body: {{ Advoor\NovaEditorJs\NovaEditorJs::generateHtmlOutput($notification->body) }}</li>
        @endforeach
    </ul>
    @endif


    @if (count($content->photos))
    <h2>Zdjecia</h2>
    <ul>
        @foreach( $content->photos as $photo)
            <li> {{ $photo->title }} , {{ $photo->path}}  wymiary:  width: {{ $photo->width() }} height: {{ $photo->height() }}</li>
        @endforeach
    </ul>
    @endif


    @if (count($content->attachments))
    <h2>$attachment</h2>
    <ul>
        @foreach( $content->attachments as $attachment)
            <li><a href="{{ asset($attachment->path) }}" target="_blank">{{ $attachment->title }}</a></li>
        @endforeach
    </ul>
    @endif

@endsection
