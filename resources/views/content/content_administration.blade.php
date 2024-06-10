@extends('layouts.default')
@section('title')
- {{ $content->title }}
@endsection
@section('content')
    @if (count($content->employees))
    <div class="container-administration">
        <main class="main">
            <section>
                <h2>{{$content->title}}</h2>
                <div class="cards">
                    @foreach($content->employees as $employee)
                        <div class="card" v-for="person in employees">
                            <div class="name">{{$employee->name}}</div>
                            <div class="role">{{$employee->workplace}}</div>
                            @if ($employee->phone)
                            <div class="contact"><div class="icon"><span class="material-symbols-outlined">call</span></div>{{$employee->phone}}</div>
                            @endif
                            @if ($employee->email)
                            <div class="contact"><div class="icon"><span class="material-symbols-outlined">mail</span></div>{{$employee->email}}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
    </div>
    @else 
        <div class="container-administration">
            <main class="main">
                <section>
                    <h2>Brak pracowników</h2>
                </section>
            </main>
        </div>
    @endif
@endsection