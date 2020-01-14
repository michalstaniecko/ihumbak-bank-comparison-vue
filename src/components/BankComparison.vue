<template>
  <div>

    <filters v-on:update:filters="filtersUpdate"/>
    <banks v-bind:banks="filteredBanks" />
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
    data() {
      return {
        banks: [],
        filters: [],
        filteredBanks: []
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
            if (!bank.params[filter.name][filter.value]) {
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
