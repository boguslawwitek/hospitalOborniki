<div class="bg">
    <div class="top-bar">
        <div class="top-bar-left">
            <a class="facebook-icon-link-header" title='Kliknij, aby przejść do Facebooka. Strona otwiera się w nowej karcie.' href="https://www.facebook.com/spzozoborniki" rel="noreferrer" target="_blank"><i class="fa-brands fa-facebook top-bar-icon"></i></a>
            <a title='Kliknij, aby przejść do projektów unijnych.' href="/informacje/projekty-61#1"><img class="ueplbip-icons" src="/images/icons/ue.png" alt="logo unii europejskiej"/></a>
            <a title='Kliknij, aby przejść do projektów z budżetu państwa.' href="/informacje/projekty-61#2"><img class="ueplbip-icons" src="/images/icons/pl.png" alt="flaga Polski"/></a>
            <a title='Kliknij, aby przejść do Biuletynu Informacji Publicznej. Strona otwiera się w nowej karcie.' target="_blank" href="http://bip.szpital.oborniki.info"><img class="ueplbip-icons" src="/images/icons/bip.png" alt="logo BIP"/></a>
        </div>
        <div class="top-bar-right">
            <button id="reset-btn" title='Kliknij aby przywrócić ustawienia początkowe.'><span class="material-symbols-outlined">restart_alt</span></button>
            <button id="large-text-btn" title='Kliknij aby powiększyć czcionkę na stronie.'><span class="material-symbols-outlined">text_increase</span></button>
            <button id="small-text-btn" title='Kliknij aby pomnniejszyć czcionkę na stronie.'><span class="material-symbols-outlined">text_decrease</span></button>
            <button id="dark-btn" title="Kliknij aby włączyć/wyłączyć tryb ciemny."><span class="material-symbols-outlined">dark_mode</span></button>
            <button id="contrast-btn" title="Kliknij aby włączyć/wyłączyć tryb wysokiego kontrastu."><span class="material-symbols-outlined">contrast</span></button>
        </div>
    </div>
    <div class="container">
        <header class="header">
            <div>
                <a href="/">
                    <div class="logo-container">
                        <img src="/images/logo.png" alt="Logo szpitala" width="64px" height="68px" />
                        <div>szpital<span>oborniki</span></div>
                    </div>
                </a>
                <p>Samodzielny Publiczny Zakład Opieki Zdrowotnej w Obornikach</p>
            </div>
            <div class="right-container">
                <a href='tel:+48612973600'>
                    <div class="middle">
                        <span class="material-symbols-outlined">call</span><div>61 29 73 600</div>
                    </div>
                </a>
                @include('includes.search-input')
            </div>
        </header>
    </div>
</div>

<script>
    const rootThemeEl = document.getElementById('root-theme');
    const resetBtn = document.getElementById('reset-btn');
    const darkBtn = document.getElementById('dark-btn');
    const contrastBtn = document.getElementById('contrast-btn');
    const largeBtn = document.getElementById('large-text-btn');
    const smallBtn = document.getElementById('small-text-btn');

    function setTheme(themeName, fontSize) {
        rootThemeEl.className = themeName + ' ' + fontSize;
        localStorage.setItem('theme', themeName);
        localStorage.setItem('fontSize', fontSize);
    }

     window.addEventListener("load", (event) => {
        const savedTheme = localStorage.getItem('theme');
        const savedFontSize = localStorage.getItem('fontSize');

        if(savedTheme && savedFontSize) {
            setTheme(savedTheme, savedFontSize);

            if(savedTheme === 'light' && savedFontSize === 'small') {
                resetBtn.disabled = true;
                largeBtn.disabled = false;
                smallBtn.disabled = true;
            } else {
                resetBtn.disabled = false;
            }

            if(savedFontSize === 'large') {
                largeBtn.disabled = true;
            } else if(savedFontSize === 'small') {
                smallBtn.disabled = true;
            }
        } else {
            setTheme('light', 'small');
            resetBtn.disabled = true;
            largeBtn.disabled = false;
            smallBtn.disabled = true;

            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                setTheme('dark', 'small');
                resetBtn.disabled = false;
            }
        }
    });

    darkBtn.addEventListener('click', function() {
        const savedTheme = localStorage.getItem('theme');
        const savedFontSize = localStorage.getItem('fontSize');

        if(savedTheme === 'dark') {
            setTheme('light', savedFontSize);

            if(savedFontSize === 'small') {
                resetBtn.disabled = true;
            } else {
                resetBtn.disabled = false;
            }
        } else {
            setTheme('dark', savedFontSize);
            resetBtn.disabled = false;
        }
    });

    contrastBtn.addEventListener('click', function() {
        const savedTheme = localStorage.getItem('theme');
        const savedFontSize = localStorage.getItem('fontSize');

        if(savedTheme === 'contrast') {
            setTheme('light', savedFontSize);

            if(savedFontSize === 'small') {
                resetBtn.disabled = true;
            } else {
                resetBtn.disabled = false;
            }
        } else {
            setTheme('contrast', savedFontSize);
            resetBtn.disabled = false;
        }
    });

    largeBtn.addEventListener('click', function() {
        const savedTheme = localStorage.getItem('theme');
        const savedFontSize = localStorage.getItem('fontSize');

        if(savedFontSize === 'small') {
            setTheme(savedTheme, 'normal');
            smallBtn.disabled = false;
            resetBtn.disabled = false;
            largeBtn.disabled = false;
        } else if(savedFontSize === 'normal') {
            setTheme(savedTheme, 'large');
            smallBtn.disabled = false;
            resetBtn.disabled = false;
            largeBtn.disabled = true;
        }
    });

    smallBtn.addEventListener('click', function() {
        const savedTheme = localStorage.getItem('theme');
        const savedFontSize = localStorage.getItem('fontSize');

        if(savedFontSize === 'large') {
            setTheme(savedTheme, 'normal');
            smallBtn.disabled = false;
            resetBtn.disabled = false;
            largeBtn.disabled = false;
        } else if(savedFontSize === 'normal') {
            setTheme(savedTheme, 'small');
            smallBtn.disabled = true;
            largeBtn.disabled = false;

            if(savedTheme === 'light') {
                resetBtn.disabled = true;
            } else {
                resetBtn.disabled = false;
            }
        }
    });

    resetBtn.addEventListener('click', function() {
        setTheme('light', 'small');
        resetBtn.disabled = true;
        largeBtn.disabled = false;
        smallBtn.disabled = true;
    });
</script>