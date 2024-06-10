@if (count($content->attachments))
<section>
    <div class="download-list-container">
        <p class="bold-600">Poniżej znajdują się pliki do pobrania:</p>
        <ol class="download-list">
            @foreach($content->attachments as $attachment)
                <li>
                    <a href="{{ asset('storage/' . $attachment->path) }}" target="_blank">{{$attachment->title}}</a>
                </li>
            @endforeach
        </ol>
    </div>
</section>   
@endif 