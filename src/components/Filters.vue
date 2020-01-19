<template>
  <div>

    <div class="form-filters">
      <div class="form-filters__container">
        <div class="form-filters__item" v-for="(filter, key) in filters">
          <div>{{ filter.label }}</div>
          <select :name="key" class="filter js-select " style="width:100%" v-on:choice="optionChanged">
            <option value="">Wybierz</option>
            <option v-bind:value="choice.value" v-for="choice in filter.choices">{{ choice.label}}</option>
          </select>
        </div>
      </div>
    </div>
    <div class="selected-filters" v-if="this.selectedFilters.length">
      <div class="selected-filters__tip">Wybrane filtry, kliknij by usunąć:</div>
      <ul>
        <li class="selected-filters__item" v-for="filter in this.selectedFilters" @click="clearSelect(filter)">
          <strong>{{ filters[filter.name].label }}:</strong> {{ filteredValue(filter.value)  }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>

  export default {
    props: ['filters'],
    data() {
      return {
        selectedFilters: [],
        choices: []
      }
    },
    methods: {
      filteredValue(value) {
        if (value == 1) {
          value = 'Tak'
        }

        return value;
      },
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
