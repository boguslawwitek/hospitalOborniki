@extends('layouts.default')
@section('title')
- {{ $content->title }}
@endsection
@section('content')
    <div class="container-for-patient">
        <main class="main">
            <section>
                <h2 v-if="title">{{$content->title}}</h2>
                <div class="flex">
                <div class="content">
                    {!! $body !!}
                </div>
                </div>
            </section>
            @include('includes.gallery')
            @include('includes.download-list')
        </main>
    </div>
@endsection