@extends('layouts.default')
@section('title')
- {{ $ward->title }}
@endsection
@section('content')
   <div class="container-ward">
      <main class="main">
         <section v-if="ward">
            <h2>{{$ward->title}}</h2>
            <div class="flex">
               <div class="left">
                  <div>{{Advoor\NovaEditorJs\NovaEditorJs::generateHtmlOutput($ward->body)}}</div>
               </div>
               <div class="right">
                  <div>
                     <div class="image-map">
                           <div class="pswp-gallery pswp-gallery--single-column" id="gallery-ward-map">
                              <div>
                                 <a href={{ asset('storage/' . \App\Models\StaticFiles::getFilePathByKey('ward-map')) }}
                                    data-pswp-width="1920"
                                    data-pswp-height="1080"
                                    target="_blank">
                                    <img src={{ asset('storage/' . \App\Models\StaticFiles::getFilePathByKey('ward-map')) }} alt="" />
                                 </a>
                              </div>
                           </div>
                     </div>
                     <div class="map-info">Kliknij zdjęcie, aby powiększyć</div>
                  </div>
               <ul>
                  @if (isset($ward->localization))
                     <li class="place">{{$ward->localization}}</li>
                  @endif
                  @if (isset($ward->contact_data))
                     <li class="call">
                        <div class="contact">
                           {{Advoor\NovaEditorJs\NovaEditorJs::generateHtmlOutput($ward->contact_data)}}
                        </div>
                     </li>
                  @endif
               </ul>
               </div>
            </div>
         </section>
         @if (isset($ward->additional_data) && json_decode($ward->additional_data)->blocks != [])
            <section>
            <div class="important">
               {{Advoor\NovaEditorJs\NovaEditorJs::generateHtmlOutput($ward->additional_data)}}
            </div>
            </section>
         @endif
         @if (count($ward->photos))
         <section>
               <h2>Galeria</h2>
               <div class="my-gallery" id="gallery-ward">
                     @foreach($ward->photos as $photo)
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
         @if (count($ward->attachments))
         <section>
            <div class="download-list-container">
               <p class="bold-600">Poniżej znajduje się pliki do pobrania:</p>
               <ol class="download-list">
                     @foreach($ward->attachments as $attachment)
                        <li>
                           <a href="{{ asset('storage/' . $attachment->path) }}" target="_blank">{{$attachment->title}}</a>
                        </li>
                     @endforeach
               </ol>
            </div>
         </section>   
         @endif 
      </main>
   </div>
   <script>
      const lightboxGalleryWardMap = new window.PhotoSwipeLightbox({
         gallery: '#gallery-ward-map',
         children: 'a',
         pswpModule: window.PhotoSwipe
      });

      lightboxGalleryWardMap.init();

      const lightboxGalleryWard = new window.PhotoSwipeLightbox({
         gallery: '#gallery-ward',
         children: 'a',
         pswpModule: window.PhotoSwipe
      });

      lightboxGalleryWard.init();
   </script>
@endsection