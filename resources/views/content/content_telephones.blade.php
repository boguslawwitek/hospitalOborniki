@extends('layouts.default')
@section('title')
    - {{ $content->title }}
@endsection
@section('content')
    <div class="container-telephones">
        <main class="main">
            <section>
                <h2>{{$content->title}}</h2>
                <div class="flex">
                    <div class="content">
                        <div class="telephones-container">
                            @foreach($phoneSections as $section)
                                <div class="telephones">
                                    <h3><div class="icon"><span class="material-symbols-outlined">call</span></div>{{ $section->title }}</h3>
                                    <ul>
                                        @foreach($section->phones as $phone)
                                        <li><span class="phone-title">{{ $phone->title }}&nbsp;</span><span class="number">{{ $phone->telephone }}</span></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            @include('includes.download-list')
        </main>
    </div>
@endsection
