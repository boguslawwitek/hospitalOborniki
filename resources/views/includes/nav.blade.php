@foreach ($mainMenu->getMenu() as $mainMenu)
    @if ($mainMenu['type'] == 'link')
        @if ($mainMenu['id'] == $active_menu_id)
            <li><a href="/{{ $mainMenu['url'] }}" class="active">{{ $mainMenu['name'] }}</a></li>
        @else
            <li><a href="/{{ $mainMenu['url'] }}">{{ $mainMenu['name'] }}</a></li>
        @endif
    @else

        <li class="dropdown-li">
            @if ($mainMenu['id'] == $active_menu_id)
                    <button class="active">{{ $mainMenu['name'] }}<i class="fa-solid fa-angle-down icons dropdown-icon"></i></button>
            @else
                    <button>{{ $mainMenu['name'] }}<i class="fa-solid fa-angle-down icons dropdown-icon"></i></button>
            @endif

            <ul class="dropdown">
                @foreach ($mainMenu['articles'] as $article)
                    <li>
                        @if ($article->cid == $active_article_id)
                            <a class="active" href="{{ $article->url }}">{{ $article->title }}</a>
                        @else
                            <a href="{{ $article->url }}" @if($article->newTab) target="_blank" @endif >{{ $article->title }}  @if($article->newTab) <i class="fa-solid fa-arrow-up-right-from-square external"></i> @endif </a>
                        @endif
                    </li>
                @endforeach
                @if(isset($submenu->extraMenu))
                    @foreach($submenu->extraMenu as $eMenu)
                        <li>
                            <button>{{ $eMenu['name'] }}<i class="fa-solid fa-angle-down icons"></i></button>

                                @if ($article->cid == $active_article_id)
                                    <a class="active" href="{{ route('main.articles_by_id', ['slug' => $submenu->slug, 'id' => $submenu->id])}})">{{ $submenu->title }}</a>
                                @else
                                    <a href="{{ route('main.articles_by_id', ['slug' => $submenu->slug, 'id' => $submenu->id])}})">{{ $submenu->title }}</a>
                                @endif

                            @foreach ($mainMenu['articles'] as $article)
                                <li>
                                    @if ($article->cid == $active_article_id)
                                        <a class="active" href="{{ $article->url }})">{{ $article->title }}</a>
                                    @else
                                        <a href="{{ $article->url }})">{{ $article->title }}</a>
                                    @endif
                                </li>
            @endforeach
        </li>

                        @endforeach
                @endif
            </ul>
        </li>
    @endif
@endforeach
