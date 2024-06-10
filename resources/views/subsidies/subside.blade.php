@extends('layouts.default')
@section('title')
    - {{ $subsidies->title }}
@endsection
@section('content')
    <div class="container-subsides">
      <main class="main">
        <section>
            <h2>{{$subsidies->title}}</h2>
            @if($subsidies->image)
                <img class="first-img subsidies-logo-img" src="{{ asset('storage/' .$subsidies->image) }}" alt="{{ $subsidies->title }}" />
            @endif
            <div class="flex">
              <div class="content">
                {{$body}}
              </div>
            </div>
        </section>
        @if(count($subsidies->photos))
            <section class="images">
                @foreach ($subsidies->photos as $photo)
                    <img class="subsidies-article-img" src="{{ asset('storage/' .$photo->photo) }}" alt="{{ $subsidies->title }}" />
                @endforeach
            </section>
        @endif
        @if(count($subsidesType->subsides) > 1)
        <section>
            <div class="flex">
                <div class="content">
                    <h3>Inne dofinansowania z <strong>{{$subsidesType->title}}</strong>:</h3>
                    <ul>
                        @foreach ($subsidesType->subsides as $subside)
                            @if ($subside->id == $subsidies->id) @continue @endif
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
                </div>
            </div>
        </section>
        @endif
      </main>
    </div>
@endsection
