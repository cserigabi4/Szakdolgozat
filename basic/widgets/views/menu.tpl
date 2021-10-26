<div id="">
<nav class="navbar navbar-expand-lg navbar-light bg-dark text-dark shadow-lg text-center">
    <a class="navbar-brand text-light" href="#">Vendéglátós Szoftver</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-center" id="navbarNav">
        <ul class="navbar-nav text-white text-center">
            {foreach $items as $item}
                <!-- itt egy if hogy van e joga látni a menüt-->
            <li class="nav-item {if $item["active"]}active{/if} text-dark">
                <a class="nav-link text-light {if $item["disable"]}disabled{/if}" href="{$item["url"]}">{$item["nev"]} <span class="sr-only">(current)</span></a>
            </li>
            {/foreach}
        </ul>
    </div>
</nav>
</div>
