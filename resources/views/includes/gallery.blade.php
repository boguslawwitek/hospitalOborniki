@if (count($content->photos))
<section>
    <h2>Galeria</h2>
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

<script>
    const lightbox = new window.PhotoSwipeLightbox({
    gallery: '#gallery-content',
    children: 'a',
    pswpModule: window.PhotoSwipe
    });

    lightbox.init();
</script>