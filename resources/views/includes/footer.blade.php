<footer class="footer">
    <div class="container-footer">
        <div>
            <div class="bold-600">Pomocne linki</div>
            <ul>
                @php
                    $footer = \App\Models\Category::where('id', 17)->first();
                @endphp
                @foreach ($footer->additionalLinks as $link)
                <li><a href="{{ $link->url }}" @if($link->open_in_new_tab) target="_blank" @endif> {{ $link->title }}</a></li>
                @endforeach
            </ul>
        </div>
        <div>
            <div class="bold-600">Rejestracja na miejscu</div>
            <div class="hours-container">
            <div>
                <ul>
                    <li>Poniedziałek</li>
                    <li>Wtorek</li>
                    <li>Środa</li>
                    <li>Czwartek</li>
                    <li>Piątek</li>
                </ul>
            </div>
            <div>
                <ul>
                    <li class="bold-500">{{ \App\Models\SystemSetting::getSettingValueByKey('monday') }}</li>
                    <li class="bold-500">{{ \App\Models\SystemSetting::getSettingValueByKey('tuesday') }}</li>
                    <li class="bold-500">{{ \App\Models\SystemSetting::getSettingValueByKey('wednesday') }}</li>
                    <li class="bold-500">{{ \App\Models\SystemSetting::getSettingValueByKey('thursday') }}</li>
                    <li class="bold-500">{{ \App\Models\SystemSetting::getSettingValueByKey('friday') }}</li>
                </ul>
            </div>
            </div>
        </div>
        <a href='/informacje/wosp-52'><div class="wosp">
            <img class="wosp-img" src={{ asset('images/wosp.png') }} alt="Wielka Orkiestra Świątecznej Pomocy" width="300px" height="285px" />
        </div></a>
    </div>
    <div class="copyright">
        <p>© 2023 Samodzielny Publiczny Zakład Opieki Zdrowotnej w Obornikach. Wszelkie prawa zastrzeżone.</p>
        <p class="author">Wykonane przez <a href='http://e-tmk.com' target="_blank" rel="noreferrer">TMK</a> & <a href='http://bwitek.dev' target="_blank" rel="noreferrer">Bogusław Witek</a></p>
    </div>
</footer>
