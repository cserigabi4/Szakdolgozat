<div id="app">
    <template>
        <b-row>
            <b-col>
               <div class="shadow-lg  bg-white rounded align-self-baseline mr-1 mb-1  w-25 text-center"><h2>{$asztal.nev} <b-icon icon="info-circle-fill" scale="0.6" variant="primary" v-b-modal.modal-asztal ></b-icon></h2></div>
                <b-table sticky-header striped hover  @row-clicked="felvetel" :fields="fields" :items="termekek" class="table-light shadow-lg pl-3 pr-3 pb-3 bg-white rounded align-self-baseline mr-2 mb-5 mx-auto text-center"></b-table>
                <a href="/asztalterkep"><b-button class="btn btn-danger btn-lg" >Vissza</b-button></a>
            </b-col>
            <b-col class="h-25">
                <div class="shadow-lg  bg-white rounded align-self-baseline mr-1 mb-1  w-25 text-center"><h4>Fizetendő: %% ar_osszesen %% Ft</h4></div>
                <b-table sticky-header striped hover @row-clicked="torles" :fields="fields" :items="felvett_termekek" class="table-light shadow-lg pl-3 pr-3 pb-3 bg-white rounded align-self-baseline mr-2 mb-5 mx-auto text-center"></b-table>
                <b-button v-b-modal.modal-fizetes class="btn btn-dark float-right btn-lg" >Fizetés</b-button>
            </b-col>
        </b-row>
    </template>
    <b-modal id="modal-fizetes" title="Véglegesítés" hide-footer>
        <h4>Fizetendő: %% ar_osszesen %% Ft</h4>
        <hr>
        <div class="form-group">
            <label for="kedvezmeny">Kedvezmény:</label>
            <b-row>
                <b-col>
                    <input name="kedvezmeny" type="number" v-model="kedvezmeny" class="form-control" id="kedvezmeny" placeholder="">
                </b-col>
                <b-col>
                    <button class="btn btn-primary" @click="kedvezmenySzamol">Számol</button>
                </b-col>
            </b-row>
        </div>
        <div class="form-group mt-3">
            <label for="fizetett">Fizetett:</label>
            <input name="fizetett" type="number" v-model="fizetett" class="form-control" id="fizetett" placeholder="">
        </div>
        <hr>
        <b-row>
            <b-col>
                <b-button class="mt-3 btn-warning" block @click="$bvModal.hide('modal-fizetes')">Mégse</b-button>
            </b-col>
            <b-col>
                <b-button class="mt-3  btn-success" block @click="fizetes">Fizetés</b-button>
            </b-col>
        </b-row>
    </b-modal>
    <b-modal id="modal-asztal" title="Asztal információ" hide-footer>
        <div class="text-center">
            <h3>{$asztal.nev}</h3>
        </div>
        <b-button class="mt-3" block @click="$bvModal.hide('modal-asztal')">Oké</b-button>
    </b-modal>
    <b-modal ref="modal-visszajaro" id="modal-visszajaro" title="Fizetés Sikeres" hide-footer>
        <div class="text-center">
            <p>Visszajáró: %% visszajaro %%</p>
        </div>
        <b-button class="mt-3" block @click="$bvModal.hide('modal-visszajaro')">Oké</b-button>
    </b-modal>
</div>
<script>
    new Vue({
        el: '#app',
        delimiters: ['%%', '%%'],
        data: {
            fields: ['Név', 'Kategória', 'Ár'],
            termekek: [
                {foreach $termekek as $termek}
                { Név: '{$termek.nev}', Kategória: '{$termek.kategoria.nev}', Ár:'{$termek.ar}', id: '{$termek.id}' },
                {/foreach}
            ],
            ar_osszesen: {if $rendeles} {$rendeles.ar} {else} 0 {/if},
            kedvezmeny: 0,
            fizetett: null,
            visszajaro: 0,
            asztal_id: {$asztal.id},
            rendeles_id: {if $rendeles} {$rendeles.id} {else} null {/if},
            felvett_termekek: [
                {if $rendeles}
                    {foreach $rendelt_termekek as $termek}
                    { Név: '{$termek.termek.nev}', Kategória: '{$termek.termek.kategoria.nev}', Ár:'{$termek.termek.ar}', id: '{$termek.termek.id}' },
                    {/foreach}
                {/if}
            ],
        },
        methods: {
            felvetel(item, index, event){
              console.log(item);
              this.felvett_termekek.push(item);
              this.ar_osszesen +=  parseInt(item.Ár);
              this.asztalMentes(item.id);
            },
            torles(item, index){
                this.felvett_termekek.splice(index, 1);
                this.ar_osszesen -=  parseInt(item.Ár);
                this.termekTorles(item.id);
            },
            kedvezmenySzamol() {
                this.ar_osszesen -= (this.ar_osszesen * (this.kedvezmeny/100));
            },
            asztalMentes: function(termek_id){
                let self = this;
                let form_data = new FormData();
                form_data.append('termek_id',termek_id);
                form_data.append('asztal_id',this.asztal_id);
                form_data.append('ar',this.ar_osszesen);

                if (this.rendeles_id) {
                    form_data.append('rendeles_id',this.rendeles_id);
                }
                axios({
                    method: 'post',
                    url: '/eladofelulet/mentes',
                    timeout: 10000,
                    data: form_data
                }).then(function (response) {
                    self.rendeles_id = response.data.rendeles_id;
                    console.log('siker',self.rendeles_id);
                }).catch(function(error) {
                    console.log('nem jo');
                });
            },
            termekTorles: function(termek_id){
                let form_data = new FormData();
                form_data.append('termek_id',termek_id);
                form_data.append('rendeles_id',this.rendeles_id);

                axios({
                    method: 'post',
                    url: '/eladofelulet/torles',
                    timeout: 10000,
                    data: form_data
                }).then(function (response) {
                    console.log('siker');
                }).catch(function(error) {
                    console.log('nem jo');
                });
            },
            fizetes: function(){
                let self = this;
                this.$bvModal.hide('modal-fizetes');
                let form_data = new FormData();
                form_data.append('rendeles_id',this.rendeles_id);
                form_data.append('kedvezmeny',this.kedvezmeny);

                axios({
                    method: 'post',
                    url: '/eladofelulet/fizetes',
                    timeout: 10000,
                    data: form_data
                }).then(function (response) {
                    self.rendeles_id = null;
                    self.felvett_termekek = [];
                    if (self.fizetett) {
                        console.log('itt');
                        self.visszajaro = self.fizetett - self.ar_osszesen;
                        self.$refs['modal-visszajaro'].show()
                    }
                    self.ar_osszesen =  0;
                    console.log('siker');
                }).catch(function(error) {
                    console.log('nem jo');
                });
            }
        }
    });
</script>