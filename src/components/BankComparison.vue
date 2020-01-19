<template>
  <div>
    <filters v-on:update:filters="filtersUpdate" v-bind:filters="allFilters"/>
    <banks v-bind:banks="filteredBanks" v-bind:filters="allFilters"/>
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
          'bezplatne_prowadzenie_konta': {
            'label': 'Bezpłatne prowadzenie konta',
            'choices': [
              {
                'value': 'bezplatne', 'label': 'Bezpłatne'
              },
              {
                'value': 'bezwarunkowo', 'label': 'Bezwarunkowo'
              }
            ]
          },
          'bezplatna_karta': {
            'label': 'Bezpłatna karta',
            'choices': [
              {
                'value': 'bezplatne', 'label': 'Bezpłatne'
              },
              {
                'value': 'bezwarunkowo', 'label': 'Bezwarunkowo'
              }
            ]
          },
          'bezplatne_przelewy': {
            'label': 'Bezpłatne przelewy',
            'choices': [
              {
                'value': 'bezplatne', 'label': 'Bezpłatne'
              },
              {
                'value': 'bezwarunkowo', 'label': 'Bezwarunkowo'
              }
            ]
          },
          'bezplatne_stale_zlecenia': {
            'label': 'Bezpłatne stałe zlecenia',
            'choices': [
              {
                'value': 'bezplatne', 'label': 'Bezpłatne'
              },
              {
                'value': 'bezwarunkowo', 'label': 'Bezwarunkowo'
              }
            ]
          },
          'bezplatne_przelewy_blyskawiczne': {
            'label': 'Bezpłatne przelewy błyskawiczne',
            'choices': [
              {
                'value': 'bezplatne', 'label': 'Bezpłatne'
              },
              {
                'value': 'bezwarunkowo', 'label': 'Bezwarunkowo'
              }
            ]
          },
          'bezplatne_autoryzacje_sms': {
            'label': 'Bezpłatne autoryzację SMS',
            'choices': [
              {
                'value': 'bezplatne', 'label': 'Bezpłatne'
              },
              {
                'value': 'bezwarunkowo', 'label': 'Bezwarunkowo'
              }
            ]
          },
          'bezplatne_wyplaty_z_bankomatu': {
            'label': 'Bezpłatne wypłaty z bankomatu',
            'choices': [
              {
                'value': 'bezplatne', 'label': 'Bezpłatne'
              },
              {
                'value': 'bezwarunkowo', 'label': 'Bezwarunkowo'
              }
            ]
          },
          'bezplatne_wplaty_we_wplatomacie': {
            'label': 'Bezpłatne wpłaty we wpłatomacie',
            'choices': [
              {
                'value': 'bezplatne', 'label': 'Bezpłatne'
              },
              {
                'value': 'bezwarunkowo', 'label': 'Bezwarunkowo'
              }
            ]
          },
          'bezplatne_polecenia_zaplaty': {
            'label': 'Bezpłatne polecenia zapłaty',
            'choices': [
              {
                'value': 'bezplatne', 'label': 'Bezpłatne'
              },
              {
                'value': 'bezwarunkowo', 'label': 'Bezwarunkowo'
              }
            ]
          },
          /*'konto_oszczednosciowe': {
            'label': 'Konto oszczędnościowe',
            'choices': [
              {'value':'Tak'}
            ],
          },*/
          'promo': {
            'label': 'Aktualna promocja',
            'choices': [
              {'value':1, 'label': 'Tak'}
            ]
          }
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

        this.filteredBanks = this.banks;

        if (!this.filters.length) return false;

        this.filteredBanks = this.banks.filter(bank => {
          let flag = false;
          this.filters.map(filter => {
            if (bank.acf.params[filter.name] && bank.acf.params[filter.name][filter.value]) {
              flag = true;
            }
            if (bank.acf.benefits.promo.enabled) {
              flag = true;
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
