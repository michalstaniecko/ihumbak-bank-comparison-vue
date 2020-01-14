import Vue from 'vue';
import BankComparison from './components/BankComparison';
import Choices from 'choices.js/public/assets/scripts/choices.min';

Vue.use(Choices);

new Vue({
  el: '#app',
  components: {
    BankComparison
  }
});
