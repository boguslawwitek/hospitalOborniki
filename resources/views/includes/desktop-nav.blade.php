<div class="container-nav">
    @php
        $mainMenu = new \App\Helpers\MainMenuHelper();
    @endphp
    <nav class="nav" id="desktop-nav">
        <ul>
            @include('includes.nav')
        </ul>
    </nav>
</div>


<script>
    const dropdowns = document.querySelectorAll('#desktop-nav ul .dropdown');
    const dropdownBtns = document.querySelectorAll('#desktop-nav .dropdown-li button');
    const dropdownIcons = document.querySelectorAll('#desktop-nav .dropdown-li button i.dropdown-icon');

    dropdowns.forEach(function(dropdown, index){
        dropdownBtns.forEach(function(btn, btnIndex) {
            btn.addEventListener('click', function() {
                if(index === btnIndex) {
                    if(dropdown.classList.contains('open')) dropdown.classList.remove('open');
                    else dropdown.classList.add('open');

                    if(dropdownIcons[index].classList.contains('up')) dropdownIcons[index].classList.remove('up');
                    else dropdownIcons[index].classList.add('up');
                } else {
                    if(dropdown.classList.contains('open')) dropdown.classList.remove('open');
                    if(dropdownIcons[index].classList.contains('up')) dropdownIcons[index].classList.remove('up');
                }
            });
        });
    });
</script>
