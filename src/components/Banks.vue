<template>
  <div class="bank-listing-container">
    <div v-for="(bank, index) in banks" class="bank-listing-container__item"  >
      <bank-item v-bind:bank="bank" v-bind:index="index" v-bind:filters="filters"/>
    </div>
  </div>
</template>

<script>
  import BankItem from './BankItem';
  export default {
    components: {
      BankItem
    },
    name: "Banks",
    props: ['banks', 'filters'],
    data() {
      return {
      }
    },


    methods: {
    },
  }
</script>

<style scoped>

</style>
