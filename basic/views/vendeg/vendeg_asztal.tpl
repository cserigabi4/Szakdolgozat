<div id="vendeg_asztal">
    <div class="text-center border shadow border-5 badge-light">
        <h2 class="pt-2 font-weight-bold">Összesen: %% ar_osszesen %% Ft</h2>
    </div>
    <hr>
    <div class="text-center border shadow border-5 mb-2">
        <h3 class="pt-2 font-weight-bold">Rendelt termékek</h3>
        <hr>
        <div class="">
           {* <ul class="list-group w-75 mx-auto list-inline justify-content-center">
                {foreach $rendelt_termekek as $termek}
                    <li class="list-group-item list-group-item-warning align-items-center mt-1 mb-2 shadow border-5">{$termek.termek.nev} {$termek.termek.ar} Ft
                       *}{* <b-icon icon="info-circle"></b-icon>*}{*
                    </li>
                {/foreach}
            </ul>*}
            <template>
                <div>
                    <b-table striped hover
                             :items="termekek"
                             :borderless="true"
                             thead-class="d-none">
                    </b-table>
                </div>
            </template>
        </div>
        <a href="/vendeg"><button type="button" class="btn btn-primary btn-lg w-100 p-2 mt-2 mb-2">Rendelés</button></a>
    </div>
    <button type="button" class="btn btn-success btn-lg w-100 p-2 mt-2 mb-2">Fizetés</button>
</div>
<script>
    new Vue({
        el: '#vendeg_asztal',
        delimiters: ['%%', '%%'],
        data: {
            termekek: [
                {foreach $rendelt_termekek as $termek}
                { nev: '{$termek.termek.nev}', ar: '{$termek.termek.ar} Ft' },
                {/foreach}
            ],
            ar_osszesen: {if $rendeles} {$rendeles.ar} {else} 0 {/if},
        }
    });
</script>
