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
                                            <b-button variant="success" @click="termekFelvetel({$termek.id},{$termek.ar})">Hozzáadás az asztalhoz</b-button>
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
            felvett_termekek: [],
        },
        methods: {
            termekFelvetel: function(termek_id,ar){
                console.log(termek_id);
                let self = this;
                let form_data = new FormData();
                form_data.append('termek_id',termek_id);
                form_data.append('ar',ar);
                axios({
                    method: 'post',
                    url: '/vendeg/felvetel',
                    timeout: 10000,
                    data: form_data
                }).then(function (response) {
                    console.log('siker',self.rendeles_id);
                }).catch(function(error) {
                    console.log('nem jo');
                });
            },
        }
    });
</script>