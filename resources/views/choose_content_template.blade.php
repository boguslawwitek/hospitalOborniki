@extends('layouts.default')
@section('title')
    - {{ $content->title }}
@endsection


@section('content')
    @php
        $templatePath = 'resources.views.content.' . $content->template .'.blade.php';
        dump($templatePath);
    @endphp
    @include($templatePath)
    {{-- @include('content.' . $content->template .'.blade.php') --}}
@endsection

