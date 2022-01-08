<div id="vendeg_app">
    <template>
        <div class="accordion" role="tablist">
            {foreach $kategoriak as $kategoria}
                <b-card no-body class="mb-1">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                        <b-button block v-b-toggle.accordion-{$kategoria.id} variant="light">{$kategoria.nev}</b-button>
                    </b-card-header>
                    <b-collapse id="accordion-{$kategoria.id}" visible accordion="my-accordion" role="tabpanel">
                        <b-card-body  style="position:relative; height:700px; overflow-y:scroll;">
                            <b-card-group deck>
                                {if $kategoria->getTermekek() != null}
                                {foreach $kategoria->getTermekek() as $termek}
                                    <b-card
                                            border-variant="primary"
                                            header="{$termek.nev}"
                                            header-bg-variant="primary"
                                            header-text-variant="white"
                                            align="center"
                                    >
                                        <b-card-text>
                                            <b-img  rounded thumbnail src="http://localhost/Szakdolgozat/Szakdolgozat/basic/img/termekek/sor.png" fluid alt="Fluid image"></b-img>
                                        </b-card-text>
                                        <b-card-text>
                                            <b-button variant="info">Részletek</b-button>
                                            <b-button variant="success">Hozzáadás az asztalhoz</b-button>
                                        </b-card-text>
                                    </b-card>
                                {/foreach}
                                {else}
                                <b-card-text>Nincsennek termékek!</b-card-text>
                                {/if}
                            </b-card-group>
                        </b-card-body>
                    </b-collapse>
                </b-card>
            {/foreach}
        </div>
    </template>
</div>
<script>
    new Vue({
        el: '#vendeg_app',
        delimiters: ['%%', '%%'],
        data: {
            text: 'szoveg'
        }
    });
</script>