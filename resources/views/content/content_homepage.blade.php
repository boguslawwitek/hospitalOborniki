@extends('layouts.default')
@section('title')
- Strona główna
@endsection
@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')
    <div class="container-home">
        <main class="main">
            <section class="section1">
              <h1>{{ $content->title }}</h1>
              <div class="img-container">
                  <img class="main-image" src={{ asset('images/szpital.jpeg') }} alt="" />
              </div>
              <div class="float-text">
                {!! $body !!}
              </div>
            </section>
            @include('includes.gallery')
            @include('includes.download-list')
        </main>
    </div>
@endsection