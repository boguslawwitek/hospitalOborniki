@extends('layouts.default')
@section('title')
    - {{ $subsidesType->title }}
@endsection
@section('content')


    <hr />
    Lista dofinansowan:
    <ol>
        @foreach ($subsidesType->subsides as $subside)
            <li>
                <a href="{{ route('main.subsidies', ['slug' => $subsideTypeSlug, $subsidesType->id, $subside->getSlug(), $subside->id]) }}" style="color:black">
                    {{ $subside->title }} <br />
                <img src="{{ asset('storage/' .$subsidesType->photo) }}" alt="{{ $subside->title }}" /></a>
            </li>

        @endforeach
    </ol>
@endsection
