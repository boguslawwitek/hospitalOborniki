<div class="container-nav">
    @php
        $mainMenu = new \App\Helpers\MainMenuHelper();
    @endphp
    <nav class="nav" id="mobile-nav">
        <div class="mobile-bar">
            <button id="hamburger-btn" class="hamburger hamburger--slider" :class="menuIsOpen ? 'is-active' : null" type="button" aria-label="Menu" aria-controls="navigation">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
            <p>szpital<span>oborniki</span></p>
        </div>
        <ul>
            @include('includes.nav')
            <li>
                <div class="container-search">
                    <div class="search-container">
                        <input id="search-input-mobile" class="search-input" type="text" name="search" placeholder="Wyszukaj..." autoComplete="off" />
                        <button id="search-btn-mobile" class="search-btn"><i class="fa-solid fa-magnifying-glass icon"></i></button>
                        <div id="livesearch"></div>

                        <div id="search-modal-mobile" style="display: none" class="articles">
                            <div id="search-articles-mobile" class="article">
                            </div>
                            <div id="no-search-info-mobile" class="article">
                                <a class="disabled"><div>Brak wyników...</div></a>
                            </div>
                        </div>

                    </div>
                </div>
            </li>
        </ul>
    </nav>
</div>


<script>
    // Hamburger menu
    let menuIsOpen = false;
    const mainMenu = document.querySelector('#mobile-nav ul');
    const hamburgerBtn = document.getElementById('hamburger-btn');

    if(menuIsOpen) mainMenu.style.display = 'flex';
    else mainMenu.style.display = 'none';

    hamburgerBtn.addEventListener('click', function() {
        if(menuIsOpen) {
            mainMenu.style.display = 'none';
            if(hamburgerBtn.classList.contains('is-active')) hamburgerBtn.classList.remove('is-active');
        } else {
            mainMenu.style.display = 'flex';
            if(!hamburgerBtn.classList.contains('is-active')) hamburgerBtn.classList.add('is-active');
        }

        menuIsOpen = !menuIsOpen;
    });

    // Dropdowns
    const dropdownsMobile = document.querySelectorAll('#mobile-nav ul .dropdown');
    const dropdownBtnsMobile = document.querySelectorAll('#mobile-nav .dropdown-li button');
    const dropdownIconsMobile = document.querySelectorAll('#mobile-nav .dropdown-li button i.dropdown-icon');

    dropdownsMobile.forEach(function(dropdown, index){
        dropdownBtnsMobile.forEach(function(btn, btnIndex) {
            btn.addEventListener('click', function() {
                if(index === btnIndex) {
                    if(dropdown.classList.contains('open')) dropdown.classList.remove('open');
                    else dropdown.classList.add('open');

                    if(dropdownIconsMobile[index].classList.contains('up')) dropdownIconsMobile[index].classList.remove('up');
                    else dropdownIconsMobile[index].classList.add('up');
                } else {
                    if(dropdown.classList.contains('open')) dropdown.classList.remove('open');
                    if(dropdownIconsMobile[index].classList.contains('up')) dropdownIconsMobile[index].classList.remove('up');
                }
            });
        });
    });
</script>

<script>
    const searchInputIDMobile = 'search-input-mobile';
    const searchButtonIDMobile = 'search-btn-mobile';
    const searchModalIDMobile = 'search-modal-mobile';
    const noSearchInfoIDMobile = 'no-search-info-mobile';
    const searchArticlesIDMobile = 'search-articles-mobile';

    const searchInputElMobile = document.getElementById(searchInputIDMobile);
    const searchButtonElMobile = document.getElementById(searchButtonIDMobile);

    searchInputElMobile.addEventListener('input', function(e) {

        if (e.target.value == "") {
            document.getElementById(searchModalIDMobile).style.display = 'none';
            document.getElementById(noSearchInfoIDMobile).style.display = 'none';
            document.getElementById(searchArticlesIDMobile).textContent = '';
            return;
        }

        function createElement(content) {
            const searchArticlesContainer = document.getElementById(searchArticlesIDMobile);

            let a = document.createElement('a');
            a.setAttribute('href', content.url);
            let div = document.createElement('div');
            div.innerHTML = "<span class='material-symbols-outlined article-icon'>article</span>" + content.title;
            a.appendChild(div);

            searchArticlesContainer.appendChild(a);
        }

        const req = new XMLHttpRequest();
        req.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {

                const json = JSON.parse(this.responseText);
                document.getElementById(searchArticlesIDMobile).textContent = '';
                console.log(json);
                console.log(e.target.value);

                if(json.content.length > 0 || json.wards.length > 0 || json.employee.length > 0) {
                    document.getElementById(searchModalIDMobile).style.display = 'block';
                    document.getElementById(noSearchInfoIDMobile).style.display = 'none';
                } else if(e.target.value == "") {
                    document.getElementById(searchModalIDMobile).style.display = 'none';
                    document.getElementById(noSearchInfoIDMobile).style.display = 'none';
                } else {
                    document.getElementById(searchModalIDMobile).style.display = 'block';
                    document.getElementById(noSearchInfoIDMobile).style.display = 'block';
                }

                if(json.content) {
                    for(content of json.content) {
                        createElement(content);
                    }
                }

                if(json.wards) {
                    for(ward of json.wards) {
                        createElement(ward);
                    }
                }

                if(json.employee) {
                    for(employe of json.employee) {
                        createElement(employe);
                    }
                }
            }
        }

        req.open("GET","/search/"+e.target.value, true);
        req.send();
    });

    searchButtonElMobile.addEventListener('click', function() {
        searchInputElMobile.focus();
    });
</script>
