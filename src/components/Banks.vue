<template>
  <div class="bank-listing-container">
    <div v-for="(bank, key) in banks" class="bank-listing-container__item"  >
      {{ bank.title.rendered }}
      <ul>
        <li v-for="(param, key) in bank.params">
          {{ key }} {{ param.bezplatne ? 'Brak opłat' : 'Opłata' }}
          <div v-if="!param.bezplatne">
            Opłata: {{ param.jaka_oplata }}
          </div>
          <div v-if="!param.bezwarunkowo">
            Warunek: {{ param.warunek }}
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
  export default {
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
