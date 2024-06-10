@extends('layouts.default')
@section('title')
- {{ $content->title }}
@endsection
@section('content')
    <div class="container-hospital">
    <main class="main">
        <section>
            <h2>{{$content->title}}</h2>
            <div class="flex">
            <div class="content diets-content">
                {!! $body !!}
                <hr class="hr" />
                @php
                    $diet = \App\Models\Diet::active()->orderBy('when', 'desc')->get()->first();
                @endphp

                <h3>{{ $diet->title }} &minus; {{ date_format($diet->when,"d.m.Y") }}</h3>
                <div class="diets">
                    <div class="diet-container" id="gallery-diet-{{$diet->id}}">
                        @if (isset($diet->breakfast) && json_decode($diet->breakfast)->blocks != [])
                            <div>
                                <div class="img-diets-container">
                                        <a href={{asset('storage/' . $diet->breakfast_photo)}}
                                            data-pswp-width={{1024}}
                                            data-pswp-height={{1024}}
                                            target="_blank">
                                            <img class="img-diets" src="{{ asset('storage/' . $diet->breakfast_photo) }}" title="Śniadanie {{ date_format($diet->when,"d.m.Y") }}" />
                                        </a>
                                </div>
                                <h4>Śniadanie</h4>
                                {{ Advoor\NovaEditorJs\NovaEditorJs::generateHtmlOutput($diet->breakfast) }}
                            </div>
                        @endif
                        @if (isset($diet->diner) && json_decode($diet->diner)->blocks != [])
                            <div>
                                <div class="img-diets-container">
                                    <a href={{asset('storage/' . $diet->diner_photo)}}
                                        data-pswp-width={{1024}}
                                        data-pswp-height={{1024}}
                                        target="_blank">
                                        <img class="img-diets" src="{{ asset('storage/' . $diet->diner_photo) }}" title="Obiad {{ date_format($diet->when,"d.m.Y") }}" />
                                    </a>
                                </div>
                                <h4>Obiad</h4>
                                {{ Advoor\NovaEditorJs\NovaEditorJs::generateHtmlOutput($diet->diner) }}
                            </div>
                        @endif
                    </div>
                    
                    <script>
                        new window.PhotoSwipeLightbox({
                        gallery: '#gallery-diet-' + {{$diet->id}},
                        children: 'a',
                        pswpModule: window.PhotoSwipe
                        }).init();
                    </script>

                    @if(isset($diet->attachment))
                        <div class="diet-file">Plik <a class="diet-link" href="{{ asset('storage/' . $diet->attachment) }}"> jadlospis-{{date_format($diet->when,"d.m.Y")}}.pdf</a></div>
                    @endif
                </div>

                <hr class="hr" />
                <a href="/informacje/archiwum-programu-pilotazowego-dobry-posilek-w-szpitalu-63">Kliknij, aby przejść do archiwum programu pilotażowego „Dobry posiłek w szpitalu”, gdzie znajdują się diety ze wszystkich dni.</a>

            </div>
            </div>
        </section>
        @include('includes.gallery')
        @include('includes.download-list')
    </main>
    </div>
@endsection
