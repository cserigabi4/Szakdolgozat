<div id="">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Vendéglátós Szoftver</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            {foreach $items as $item}
                <!-- itt egy if hogy van e joga látni a menüt-->
            <li class="nav-item {if $item["active"]}active{/if}">
                <a class="nav-link {if $item["disable"]}disabled{/if}" href="{$item["url"]}">{$item["nev"]} <span class="sr-only">(current)</span></a>
            </li>
            {/foreach}
        </ul>
    </div>
</nav>
</div>
