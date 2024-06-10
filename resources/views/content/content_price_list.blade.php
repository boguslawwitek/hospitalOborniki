@extends('layouts.default')
@section('title')
- {{ $content->title }}
@endsection
@section('content')
    <div class="container-for-patient">
        <main class="main">
            <section>
                <h2>{{$content->title}}</h2>
                @if (count($content->attachments))
                    @php 
                        $attachment = $content->attachments->last();
                    @endphp
                    <a target="_blank" href={{ asset('storage/' . $attachment->path) }} class="download-pdf">Otwórz w nowej karcie</a>
                    <a target="_blank" href={{ asset('storage/' . $attachment->path) }} class="download-pdf" download="">Pobierz dokument</a>
                    <object data={{ asset('storage/' . $attachment->path) }} type="application/pdf" frameborder="0" class="embed-pdf">
                        <p>Twoja przeglądarka nie wspiera podglądu. Użyj przycisku "Otwórz w nowej karcie" powyżej.</p>
                        <embed src={{ asset('storage/' . $attachment->path) }} class="embed-pdf" />
                    </object>
                @endif
            </section>
        </main>
    </div>
@endsection