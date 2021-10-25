<div id="app">
    <template>
        <b-row>
            <b-col> <b-table striped hover :fields="fields" :items="items" class="table-light shadow-lg pl-3 pr-3 pb-3 bg-white rounded align-self-baseline mr-2 mb-5 mx-auto text-center"></b-table></b-col>
            <b-col> <b-table striped hover  :items="items" class="table-light shadow-lg pl-3 pr-3 pb-3 bg-white rounded align-self-baseline mr-2 mb-5 mx-auto text-center"></b-table></b-col>
        </b-row>

    </template>
</div>
<script>
    new Vue({
        el: '#app',
        data: {
            fields: ['Név', 'Kategória', 'Ár'],
            items: [
                { nev: 'Termek', kategoria:'Teszt', ar:'500' },
                { nev: 'Termek', kategoria:'Teszt', ar:'500' },
                { nev: 'Termek', kategoria:'Teszt', ar:'500' },
            ]
        }
    });
</script>