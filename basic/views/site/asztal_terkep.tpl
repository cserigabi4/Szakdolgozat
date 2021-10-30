<div id="outerContainer">
    <div id="container">
        {if $asztalok}
            {foreach $asztalok as $asztal}
                <div id="{$asztal['nev']}" class="shadow-lg bg-white rounded align-self-baseline mx-auto text-center" style="width: 100px;height: 50px; position: absolute; top: 100px; left:300px;">
                    <p>{$asztal['nev']}</p>
                </div>
            {/foreach}
        {/if}
    </div>
</div>
<script>
    {if $asztalok}
    {foreach $asztalok as $asztal}
    var d = document.querySelector("#{$asztal['nev']}");
    setTranslate({$asztal['x']},{$asztal['y']}, d)
    {/foreach}
    {/if}

    function setTranslate(xPos, yPos, el) {
        el.style.transform = "translate3d(" + xPos + "px, " + yPos + "px, 0)";
    }
</script>