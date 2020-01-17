<template>
  <div class="bank-listing-container__item-inner">

    <div class="bank-listing-container__item-title">

      <h3>{{ bank.title.rendered }}</h3>
      <a href="#" class="bank-listing-container__item-cta"><div>Otwórz konto</div><div>na stronie banku</div></a>
    </div>
    <div class="tabs-menu">
      <a href="#" @click.prevent="selectTab('params')" :class="{'tab-active' : selectedTab === 'params'}">Parametry konta</a>
      <a href="#" @click.prevent="selectTab('promo')" :class="{'tab-active' : selectedTab === 'promo'}">Aktualna promocja</a>
    </div>
    <div v-if="selectedTab==='params'">

      <ul class="bank-listing-container__params">
        <li v-for="(param, key) in bank.params" class="bank-listing-container__params-item" :class="{ 'bank-free': param.bezwarunkowo, 'bank-warning': !param.bezwarunkowo && param.bezplatne, 'bank-fee':!param.bezplatne }">
          <div class="bank-listing-container__params-name">
            {{ filters[key] }}
            <i class="fa fa-check" v-if="param.bezwarunkowo" title="Bezpłatne bezwarunkowo"></i>
            <span v-if="!param.bezwarunkowo && param.bezplatne" title="Bezpłatne pod warunkiem"><i class="fa fa-check"></i><i class="fa fa-warning" ></i></span>
            <i class="fa fa-times" v-if="!param.bezplatne" title="Opłata"></i>

          </div>
          <div class="bank-listing-container__params-desc">

            <div v-if="!param.bezwarunkowo && param.bezplatne">
              <span>Warunek:</span> {{ param.warunek }}
            </div>
            <div v-if="!param.bezwarunkowo">
              <span>Opłata:</span> {{ param.jaka_oplata }}
            </div>
          </div>
        </li>
      </ul>
    </div>
    <div v-if="selectedTab === 'promo'">
      aktualna promocja
    </div>

  </div>
</template>

<script>
  export default {
    props: ['bank', 'index', 'filters'],
    name: "BankItem",
    data() {
      return {
        selectedTab: 'params',
      }
    },
    methods: {
      selectTab(tab) {
        this.selectedTab = tab;
      }
    }
  }
</script>

<style scoped>

</style>
