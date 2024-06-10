@extends('layouts.default')
@section('title')
    - {{ $content->title }}
@endsection
@section('content')
    <div class="container-subsides">
        <main class="main">
            <section>
                <h2>{{$content->title}}</h2>
                <div class="flex">
                <div class="content">
                    <div>
                        @foreach (\App\Models\SubsidiesTypes::all() as $subsidesType)
                            @php
                                $subsideTypeSlug = \Illuminate\Support\Str::slug($subsidesType->title);
                            @endphp

                            <h3 id="{{$subsidesType->id}}">{{$subsidesType->title}}</h3>
                            <ul>
                                @foreach ($subsidesType->subsides as $subside)
                                    <li class="ue-el">
                                        <a href="{{ route('main.subsidies', ['slug' => $subsideTypeSlug, $subsidesType->id, $subside->getSlug(), $subside->id]) }}">
                                            {{ $subside->title }}<br>
                                            @if($subside->image)
                                                <img class="subsidies-logo-img" src="{{ asset('storage/' .$subside->image) }}" alt="{{ $subside->title }}" />
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
                </div>
            </section>
            @if (count($content->photos))
            <section>
                <h2>Galeria projektów</h2>
                <div class="my-gallery" id="gallery-content">
                        @foreach($content->photos as $photo)
                        <div>
                            <a href={{asset('storage/' . $photo->path)}}
                                    data-pswp-width={{$photo->width()}}
                                    data-pswp-height={{$photo->height()}}
                                    target="_blank">
                                    <img src={{asset('storage/' . $photo->path)}} alt={{$photo->title}} />
                            </a>
                        </div>
                        @endforeach
                </div>
            </section>
            @endif
            @include('includes.download-list')
        </main>
    </div>

    <script>
        const lightboxSubsides = new window.PhotoSwipeLightbox({
        gallery: '#gallery-content',
        children: 'a',
        pswpModule: window.PhotoSwipe
        });

        lightboxSubsides.init();
    </script>
@endsection