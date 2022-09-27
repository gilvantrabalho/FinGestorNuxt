<template>
    <div>

        <div class="row">
            <div class="col-md-4">
                <CardMoney :loading="loading" title="Entrada" color="bg-primary" :value="this.e_sum"
                    icon="bi bi-box-arrow-in-down" />
            </div>
            <div class="col-md-4">
                <CardMoney :loading="loading" title="Saída" color="bg-danger" :value="this.s_sum"
                    icon="bi bi-box-arrow-up" />
            </div>
            <div class="col-md-4">
                <CardMoney :loading="loading" title="Líquido" color="bg-success" :value="this.l_sum" icon="bi bi-box" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-6">
                <CardContainer v-slot:body>
                    <h5 class="text-secondary">Entradas do mês</h5>
                    <hr class="mb-4 text-secondary">
                    <ChartEntrada />
                </CardContainer>
            </div>
            <div class="col-md-12 col-lg-6">
                <CardContainer v-slot:body>
                    <h5 class="text-secondary">Saídas do mês</h5>
                    <hr class="mb-4 text-secondary">
                    <ChartSaida />
                </CardContainer>
            </div>
        </div>

    </div>
</template>

<script>
import CardContainer from '../components/cards/CardContainer.vue';
import Card from '../components/cards/Card.vue';
import CardMoney from '../components/cards/CardMoney.vue';
import ChartEntrada from '../components/chats/ChartEntrada.vue';
import ChartSaida from '../components/chats/ChartSaida.vue';
export default {
    auth: true,
    components: { CardContainer, Card, CardMoney, ChartEntrada, ChartSaida },
    data() {
        return {
            e_sum: 0,
            s_sum: 0,
            l_sum: 0,
            loading: false
        }
    },
    created() {
        this.getSumCards();
    },
    methods: {
        getSumCards: function () {
            this.loading = true;
            this.$axios.get(`dashboard/transaction/sum-cards/1`)
                .then(res => {
                    this.e_sum = res.data.response.e_sum.value;
                    this.s_sum = res.data.response.s_sum.value;
                    this.l_sum = res.data.response.l_sum[0].subtracao
                })
                .catch(error => {
                    console.log(error)
                })
                .then(() => {
                    this.loading = false;
                })
        }
    }
}
</script>