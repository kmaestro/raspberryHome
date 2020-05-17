<template>
  <div>
<!--    <div class="page-title">-->
<!--      <h3>Счет</h3>-->

<!--      <button class="btn waves-effect waves-light btn-small">-->
<!--        <i class="material-icons">refresh</i>-->
<!--      </button>-->
<!--    </div>-->

    <Loader v-if="loading"/>

    <div v-else class="row">
<!--      <div class="col s12 m6 l4">-->
<!--        <div class="card light-blue bill-card">-->
<!--          <div class="card-content white-text">-->
<!--            <span class="card-title">Счет в валюте</span>-->

<!--            <p class="currency-line">-->
<!--              <span>12.0 Р</span>-->
<!--            </p>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->

      <div class="col s12 m6 l8">
        <div class="card orange darken-3 bill-card">
          <div class="card-content white-text">
            <div class="card-header">
              <span class="card-title">Курс валют</span>
            </div>
            <table>
              <thead>
              <tr>
                <th>Валюта</th>
                <th>Курс</th>
                <th>Дата</th>
              </tr>
              </thead>

              <tbody>
              <tr v-for="cur in currencies" :key="cur">
                <td>{{cur}}</td>
                <td>{{currency.rates[cur].toFixed(5)}}</td>
                <td>{{currency.date | date('date')}}</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'Home',
    data: () => ({
      loading: true,
      currency: null,
      currencies: ['RUB', 'USD', 'EUR']
    }),
    async mounted() {
      this.currency = await this.$store.dispatch('fetchCurrency')
      this.loading = false
    },
    methods: {
      async refresh() {
        this.loading = true
        this.currency = await this.$store.dispatch('fetchCurrency')
        this.loading = false
      }
    },
  }
</script>
