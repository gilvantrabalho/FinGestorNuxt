<template>
    <div>
        <CardContainer v-slot:body>

            <vue-good-table :columns="columns" :rows="rows" :search-options="{
              enabled: true
            }" :pagination-options="{
              enabled: true,
              mode: 'records'
            }">
            </vue-good-table>

        </CardContainer>
    </div>
</template>

<script>
import CardContainer from '../../../components/cards/CardContainer.vue';
export default {
    name: 'my-transactions',
    auth: true,
    components: { CardContainer },
    created() {

    },
    data() {
        return {
            columns: [
                {
                    label: 'Id',
                    field: 'id',
                },
                {
                    label: 'Name',
                    field: 'name',
                },
                {
                    label: 'Idade',
                    field: 'age',
                }
            ],
            rows: [
                {
                    id: 1,
                    name: "John",
                    age: 20
                },
                {
                    id: 2,
                    name: "Gilvan",
                    age: 26
                },
                {
                    id: 2,
                    name: "Gilvan",
                    age: 26
                },
                {
                    id: 2,
                    name: "Gilvan",
                    age: 26
                },
                {
                    id: 2,
                    name: "Gilvan",
                    age: 26
                },
                {
                    id: 2,
                    name: "Gilvan",
                    age: 26
                },
                {
                    id: 2,
                    name: "Gilvan",
                    age: 26
                },
                {
                    id: 2,
                    name: "Gilvan",
                    age: 26
                },
                {
                    id: 2,
                    name: "Gilvan",
                    age: 26
                },
                {
                    id: 2,
                    name: "Gilvan",
                    age: 26
                },
                {
                    id: 2,
                    name: "Gilvan",
                    age: 26
                },
                {
                    id: 2,
                    name: "Brunna",
                    age: 26
                },
                {
                    id: 2,
                    name: "Gilvan",
                    age: 26
                },
                {
                    id: 2,
                    name: "Miguel",
                    age: 26
                },
                {
                    id: 2,
                    name: "Gilvan",
                    age: 26
                },
                {
                    id: 2,
                    name: "Gilvan",
                    age: 26
                },
            ]
        }
    },
    methods: {

    }
}
</script>