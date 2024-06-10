@extends('layouts.default')
@section('title')
- {{ $content->title }}
@endsection
@section('content')
    <div class="container-for-patient">
        <main class="main">
            <section>
                <h2>{{ $content->title }}</h2>
                @if (count($content->notifications))
                    <div class="timeline-container">
                        <div class="items-container">
                            <ul class="items-list">
                                @foreach ($content->notifications as $notification)
                                    @if($active_article_id == \App\Models\SystemSetting::getSettingValueByKey('covid19.content_id')) {{-- COVID19 ID --}}
                                        <li class="item danger">
                                            @if($notification->type == 'info')
                                                <div class="item-title danger"><span class="bold-600">Komunikat: </span>{{$notification->title}}</div>
                                            @else
                                                <div class="item-title danger"><span class="bold-600">Zagrożenie: </span>{{$notification->title}}</div>
                                            @endif
                                            <div class="item-desc">{{Advoor\NovaEditorJs\NovaEditorJs::generateHtmlOutput($notification->body)}}</div>
                                        </li>
                                    @else 
                                        <li class="item">
                                            <div class="item-title">{{$notification->title}}</div>
                                            <div class="item-desc">{{Advoor\NovaEditorJs\NovaEditorJs::generateHtmlOutput($notification->body)}}</div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @else
                    <div>Brak ogłoszeń</div>
                @endif
            </section>
            @include('includes.download-list')
        </main>
    </div>
@endsection