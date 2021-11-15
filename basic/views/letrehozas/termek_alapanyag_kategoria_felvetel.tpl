<div id="app">
    <div class="border rounded shadow-lg p-3 mb-5 bg-white w-50 m-auto">
        <b-tabs content-class="mt-3" fill>
            <b-tab title="Termék felvétel" active>
                    <div class="form-group">
                        <label for="termek_nev">Név</label>
                        <input name="termek_nev" type="text" v-model="termek_nev" class="form-control" id="termek_nev" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="termek_kategoria">Kategória</label>
                        <b-form-select name="termek_kategoria" id="termek_kategoria" v-model="termek_kategoria" :options="termek_kategoria_options"></b-form-select>
                    </div>
                    <div class="form-group">
                        <label for="termek_ar">Ár</label>
                        <input name="termek_ar" type="number" v-model="termek_ar" class="form-control" id="termek_ar" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="termek_osszetevoi">Termék összetevői</label>
                       <b-form-tags
                                id="tags-component-select"
                                v-model="termek_alapanyagok"
                                size="lg"
                                class="mb-2"
                                add-on-change
                                no-outer-focus
                        >
                            <template v-slot="{ tags,inputId, inputAttrs, inputHandlers, disabled, removeTag }">
                                <ul v-if="tags.length > 0" class="list-inline d-inline-block mb-2">
                                    <li v-for="tag in tags" :key="tag" class="list-inline-item">
                                        <b-form-tag
                                                @remove="removeTag(tag)"
                                                :title="tag"
                                                :disabled="disabled"
                                                variant="info"
                                        >%% tag %%</b-form-tag>
                                    </li>
                                </ul>
                                <b-form-select
                                        v-bind="inputAttrs"
                                        v-on="inputHandlers"
                                        :disabled="disabled || availableOptions.length === 0"
                                        :options="availableOptions"
                                >
                                    <template #first>
                                        <option disabled value="">Válasszon!</option>
                                    </template>
                                </b-form-select>
                            </template>
                        </b-form-tags>
                    </div>
                    <button class="btn btn-dark" @click="termekRequest()">Mentés</button>
            </b-tab>
            <b-tab title="Kategória felvétel">
                    <div class="form-group">
                        <label for="kategoria_nev">Név</label>
                        <input name="kategoria_nev" type="text" v-model="kategoria_nev" class="form-control" id="kategoria_nev" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="kategoria_allergen">Allergén</label>
                        <b-form-checkbox id="kategoria_allergen" v-model="kategoria_allergen" name="kategoria_allergen" value="true" unchecked-value="">Alergén kategória</b-form-checkbox>
                    </div>
                    <div class="form-group">
                        <label for="kategoria_afa">Áfa kulcs</label>
                        <b-form-select name="kategoria_afa" id="kategoria_afa" v-model="kategoria_afa" :options="kategoria_afa_options"></b-form-select>
                    </div>
                    <button class="btn btn-dark" @click="kategoriaRequest()">Mentés</button>
            </b-tab>
            <b-tab title="Alapanyag felvétel">
                    <b-alert :show="alapanyag_hiba.length != 0" variant="danger">%% alapanyag_hiba %%</b-alert>
                    <b-alert :show="alapanyag_siker" variant="success">Sikeres mentés!</b-alert>
                    <div class="form-group">
                        <label for="alapanyag_nev">Név</label>
                        <input name="alapanyag_nev" v-model="alapanyag_nev" type="text" class="form-control" id="alapanyag_nev" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="alapanyag_mennyiseg">Mennyiség</label>
                        <input name="alapanyag_mennyiseg" v-model="alapanyag_mennyiseg" type="number" class="form-control" id="alapanyag_mennyiseg" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="alapanyag_mertekegyseg">Mértékegység</label>
                        <input name="alapanyag_mertekegyseg" v-model="alapanyag_mertekegyseg" type="text" class="form-control" id="alapanyag_mertekegyseg" placeholder="">
                    </div>
                    <button class="btn btn-dark" @click="alapanyagRequest()">Mentés</button>
            </b-tab>
        </b-tabs>
    </div>
</div>
<script>
    new Vue({
        el: '#app',
        delimiters: ['%%', '%%'],
        data: {
            options: [],
            termek_alapanyagok: [],
            alapanyag_nev: '',
            alapanyag_mennyiseg: 0,
            alapanyag_mertekegyseg: '',
            kategoria_nev: '',
            kategoria_allergen: '',
            kategoria_afa: null,
            kategoria_afa_options: [{ value: null, text: 'Válasszon!'}, { value: 5, text: '5%'},{ value: 18, text: '18%'},{ value: 27, text: '27%'}],
            termek_nev: '',
            termek_kategoria: '',
            termek_kategoria_options: [],
            termek_ar: 0,
            termek_osszetevoi_options: [],
            alapanyag_hiba: '',
            alapanyag_siker: false,
        },
        created: function () {
            {foreach $kategoriak as $kategoria}
                this.termek_kategoria_options.push({ value: '{$kategoria.id}', text: '{$kategoria.nev}'});
            {/foreach}
            {foreach $alapanyagok as $alapanyag}
           this.termek_osszetevoi_options.push({ value: '{$alapanyag.nev}', text: '{$alapanyag.nev}'});
            {/foreach}
        },
        computed: {
            availableOptions() {
                return this.termek_osszetevoi_options.filter(opt => this.termek_alapanyagok.indexOf(opt) === -1)
            }
        },
        methods: {
            alapanyagRequest: function(){
                let self = this;
                let form_data = new FormData();
                form_data.append('alapanyag_nev',this.alapanyag_nev);
                form_data.append('alapanyag_mennyiseg',this.alapanyag_mennyiseg);
                form_data.append('alapanyag_mertekegyseg',this.alapanyag_mertekegyseg);
                axios({
                    method: 'post',
                    url: '/letrehozas/alapanyag',
                    timeout: 10000,
                    data: form_data
                }).then(function (response) {
                    if (response.data.message) {
                        self.alapanyag_siker = true;
                        self.alapanyag_hiba = '';
                        console.log(response.data.data);
                        self.termek_osszetevoi_options.push({ value: response.data.data, text: response.data.data});
                        return;
                    }
                    if (response.data.data.nev) {
                        self.alapanyag_siker = false;
                        self.alapanyag_hiba = response.data.data.nev[0];
                    }
                }).catch(function(error) {
                    console.log('nem jo');
                });
            },
            kategoriaRequest: function(){
                let self = this;
                let form_data = new FormData();
                form_data.append('kategoria_nev', this.kategoria_nev);
                form_data.append('kategoria_allergen', this.kategoria_allergen);
                form_data.append('kategoria_afa', this.kategoria_afa);
                axios({
                    method: 'post',
                    url: '/letrehozas/kategoria',
                    timeout: 10000,
                    data: form_data
                }).then(function (response) {
                    self.termek_kategoria_options.push({ value: response.data.id, text: self.kategoria_nev});
                }).catch(function(error) {
                    console.log('nem jo');
                });
            },
            termekRequest: function(){
                console.log(this.value)
                let form_data = new FormData();
                form_data.append('termek_nev', this.termek_nev);
                form_data.append('termek_kategoria', this.termek_kategoria);
                form_data.append('termek_ar', this.termek_ar);
                form_data.append('termek_alapanyagok', this.termek_alapanyagok);
                axios({
                    method: 'post',
                    url: '/letrehozas/termek',
                    timeout: 10000,
                    data: form_data
                }).then(function (response) {
                    console.log('siker');
                }).catch(function(error) {
                    console.log('nem jo');
                });
            },
        }

    });
</script>