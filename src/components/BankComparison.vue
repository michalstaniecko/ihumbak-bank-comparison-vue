<template>
  <div>
    <filters v-on:update:filters="filtersUpdate" v-bind:filters="allFilters"/>
    <banks v-bind:banks="filteredBanks" v-bind:filters="allFilters" />
  </div>
</template>

<script>
  import Banks from './../components/Banks';
  import Filters from './../components/Filters';
  import axios from 'axios';

  export default {
    name: "Bank-Comparison",
    components: {
      Banks,
      Filters
    },
    props: ['imgPath'],
    data() {
      return {
        banks: [],
        filters: [],
        filteredBanks: [],
        allFilters: {
          'bezplatne_prowadzenie_konta': 'Bezpłatne prowadzenie konta',
          'bezplatna_karta': 'Bezpłatna karta',
          'bezplatne_przelewy': 'Bezpłatne przelewy',
          'bezplatne_stale_zlecenia': 'Bezpłatne stałe zlecenia',
          'bezplatne_przelewy_blyskawiczne': 'Bezpłatne przelewy błyskawiczne',
          'bezplatne_autoryzacje_sms': 'Bezpłatne autoryzację SMS',
          'bezplatne_wyplaty_z_bankomatu': 'Bezpłatne wypłaty z bankomatu',
          'bezplatne_wplaty_we_wplatomacie': 'Bezpłatne wpłaty we wpłatomacie',
          'bezplatne_polecenia_zaplaty': 'Bezpłatne polecenia zapłaty'
        },
      }
    },
    mounted() {
      axios.get('https://dev.sardynkibiznesu.pl/wp-json/wp/v2/bank/')
        .then((response) => {
          return (response)
        })
        .then(response => {
          this.banks = response.data;
          this.filteredBanks = this.banks;
        })
        .catch((error) => {
          console.log(error);
        })
    },
    methods: {
      filtersUpdate(filters) {
        this.filters = (filters);
        this.filteredBanks = this.banks.filter(bank => {
          let flag = true;
          this.filters.map(filter => {
            if (!bank.acf.params[filter.name][filter.value]) {
              flag = false;
            }
          })
          return flag;
        })

      }
    },
  }
</script>

<style scoped>

</style>
