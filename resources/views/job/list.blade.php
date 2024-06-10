@extends('layouts.default')
@section('title')
- {{ $title }}
@endsection
@section('content')
    <div class="container-for-patient">
        <main class="main">
            <section>
                <h2>{{ $title }}</h2>
                @if (count($jobs))
                    <div class="timeline-container">
                        <div class="items-container">
                            <ul class="items-list">
                                @foreach ($jobs as $job)
                                    <li class="item">
                                        <div class="item-title">{{$job->title}}</div>
                                        <div class="item-desc">{{Advoor\NovaEditorJs\NovaEditorJs::generateHtmlOutput($job->body)}}</div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @else
                    <div>Brak ogłoszeń</div>
                @endif
            </section>
        </main>
    </div>
@endsection