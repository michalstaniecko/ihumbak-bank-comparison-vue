<template>
  <div>

    <div class="form-filters">
      <div class="form-filters__container">
        <div class="form-filters__item" v-for="(filter, key) in filters">
          <div>{{ filter }}</div>
          <select :name="key" class="filter js-select " style="width:100%" v-on:choice="optionChanged">
            <option value="">Wybierz</option>
            <option value="bezplatne">Bezpłatne</option>
            <option value="bezwarunkowo">Bezpłatne bezwarunkowo</option>
          </select>
        </div>
      </div>
    </div>
    <div class="selected-filters" v-if="this.selectedFilters.length">
      <div class="selected-filters__tip">Wybrane filtry, kliknij by usunąć:</div>
      <ul>
        <li class="selected-filters__item" v-for="filter in this.selectedFilters" @click="clearSelect(filter)">
          {{ filter.name }}: {{ filter.value }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>

  export default {
    data() {
      return {
        selectedFilters: [],
        filters: {
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
        choices: []
      }
    },
    methods: {
      clearSelect(filter) {
        let choice = '';
        this.choices.map(_choice => {
          if (_choice._baseId.includes(filter.name)) {
            choice = _choice;
            _choice.setChoiceByValue('');
          }
        })
        this.selectedFilters = this.selectedFilters.filter(filter => {

          return ! choice._baseId.includes(filter.name);
        })
      },
      optionChanged(e) {
        console.log(e);
        this.selectedFilters = this.selectedFilters.filter(filter => {
          if (filter.name == e.target.name) return false;
          return true;
        });

        if (e.detail.choice.value === '') {
          this.selectedFilters = this.selectedFilters.filter(filter => {
            if (filter.name == e.target.name) return false;
            return true;
          });
        } else {
          this.selectedFilters.push({
            name: e.target.name,
            value: e.detail.choice.value,
          });

        }

        this.$emit('update:filters', this.selectedFilters);

      }
    },
    mounted() {
      const elements = document.querySelectorAll('.js-select');
      elements.forEach((elem) => {
        this.choices.push(new Choices(elem, {
          searchEnabled: false,
          itemSelectText: '',
          placeholderValue: 'Wybierz',
          shouldSort: false
        }));
      })
    },
    watch: {
      selectedFilters() {

        this.$emit('update:filters', this.selectedFilters);
      }
    }
  }
</script>
