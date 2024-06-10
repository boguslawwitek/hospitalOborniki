<div class="container-search">
    <div class="search-container">
        <input id="search-input" class="search-input" type="text" name="search" placeholder="Wyszukaj..." autoComplete="off" />
        <button id="search-btn" class="search-btn"><i class="fa-solid fa-magnifying-glass icon"></i></button>
        <div id="livesearch"></div>

        <div id="search-modal" style="display: none" class="articles">
            <div id="search-articles" class="article">
                {{-- <a href=""><div><span class="material-symbols-outlined article-icon">article</span>article_title</div></a> --}}
            </div>
            <div id="no-search-info" class="article">
                <a class="disabled"><div>Brak wyników...</div></a>
            </div>
        </div>

    </div>
</div>

<script>
    const searchInputID = 'search-input';
    const searchButtonID = 'search-btn';
    const searchModalID = 'search-modal';
    const noSearchInfoID = 'no-search-info';
    const searchArticlesID = 'search-articles';

    const searchInputEl = document.getElementById(searchInputID);
    const searchButtonEl = document.getElementById(searchButtonID);

    searchInputEl.addEventListener('input', function(e) {

        if (e.target.value == "") {
            document.getElementById(searchModalID).style.display = 'none';
            document.getElementById(noSearchInfoID).style.display = 'none';
            document.getElementById(searchArticlesID).textContent = '';
            return;
        }

        function createElement(content) {
            const searchArticlesContainer = document.getElementById(searchArticlesID);

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
                document.getElementById(searchArticlesID).textContent = '';
                console.log(json);
                console.log(e.target.value);

                if(json.content.length > 0 || json.wards.length > 0 || json.employee.length > 0) {
                    document.getElementById(searchModalID).style.display = 'block';
                    document.getElementById(noSearchInfoID).style.display = 'none';
                } else if(e.target.value == "") {
                    document.getElementById(searchModalID).style.display = 'none';
                    document.getElementById(noSearchInfoID).style.display = 'none';
                } else {
                    document.getElementById(searchModalID).style.display = 'block';
                    document.getElementById(noSearchInfoID).style.display = 'block';
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

    searchButtonEl.addEventListener('click', function() {
        searchInputEl.focus();
    });
</script>