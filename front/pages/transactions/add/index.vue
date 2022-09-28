<template>
    <div>

        <div class="shadow-sm p-3 rounded bg-white">
            <b-breadcrumb class="m-0" :items="items"></b-breadcrumb>
        </div>

        <CardContainer v-slot:body>

            <div class="row">
                <div class="col-md-4">

                    <div class="mb-4 bg-light p-3">
                        <h5>Adicionar nova Transação</h5>
                    </div>

                    <form @submit.prevent="submit" class="mt-3" method="post">

                        <InputComponent type="text" v-model="valor" class="mb-3" placeholder="R$ 000,00" />

                        <select v-model="tipo" name="" id="" class="form-control mb-3">
                            <option value="">Selecione...</option>
                            <option value="E">Entrada</option>
                            <option value="S">Saída</option>
                        </select>

                        <TextAreaComponent v-model="descricao" placeholder="Descrição da Transação..." />

                        <Button :loading="loading" class="mt-3" title="Enviar" type="submit" />
                    </form>

                    <FormErrors class="mt-3" :errors="errors" />

                </div>
                <div class="col-md-8 ps-4">

                    <div class="mb-4 bg-light p-3">
                        <h5>Transação adicionadas hoje</h5>
                    </div>

                    <div v-if="statusDelete" class="alert alert-warning shadow" role="alert">
                        <span>Deseja mesmo excluir esse item?</span>
                        <div class="text-end mt-2">
                            <button @click="() => { statusDelete = false; }" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-x-circle"></i> Cancelar</button>
                            <button @click="deleteItem()" class="btn btn-sm btn-success">
                                <i class="bi bi-trash"></i> Excluir</button>
                        </div>
                    </div>

                    <div v-if="loadingForm">
                        <Spinner />
                    </div>
                    <div v-else class="animate__animated animate__fadeIn">
                        <div v-if="transactions.length > 0">
                            <v-table class="table table-hover table-striped table-borderless" :data="transactions"
                                :currentPage.sync="currentPage" :pageSize="5" @totalPagesChanged="totalPages = $event">
                                <thead class="style-thead bg-primary text-white" slot="head">
                                    <th class="one">Valor(R$)</th>
                                    <th>Tipo</th>
                                    <th>Descrição</th>
                                    <th class="ult"></th>
                                </thead>
                                <tbody class="border-top-0 style-tbody" slot="body" slot-scope="{displayData}">
                                    <tr v-for="(row, index) in displayData" :key="row.guid">
                                        <td>R$ {{ row.value }}</td>
                                        <td>
                                            <span v-if="row.type == 'E'" class="badge bg-success">ENTRADA</span>
                                            <span v-else class="badge bg-danger">SAÍDA</span>
                                        </td>
                                        <td>{{ row.description }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pen"></i>
                                            </button>

                                            <button @click="() => { selectItemDelete(index, row.id); }"
                                                class="btn btn-sm btn-outline-danger" type="button">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </v-table>
                            <smart-pagination :currentPage.sync="currentPage" :totalPages="totalPages" />
                        </div>
                        <div v-else>
                            <div class="bg-light p-3 text-center shadow-sm">
                                Não foram encontradas transações para esse usuário!
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </CardContainer>
    </div>
</template>

<style>
.breadcrumb {
    font-size: 14px;
}

.breadcrumb a {
    text-decoration: none !important;
}
</style>

<script>
import CardContainer from '../../../components/cards/CardContainer.vue';
import InputComponent from '../../../components/forms/input/InputComponent.vue';
import TextAreaComponent from '../../../components/forms/textarea/TextAreaComponent.vue';
import Button from '../../../components/buttons/Button.vue';
import FormErrors from '../../../components/messages/FormErrors.vue';
import Spinner from '../../../components/spinners/Spinner.vue';
import Modal from '../../../components/modals/Modal.vue';
export default {
    components: { CardContainer, InputComponent, TextAreaComponent, Button, FormErrors, Spinner, Modal },
    data() {
        return {
            idSelected: '',
            indexSelected: '',
            statusDelete: false,
            loadingForm: false,
            loading: false,
            errors: [],
            selectedFile: '',
            valor: '',
            tipo: '',
            descricao: '',
            totalPages: 10,
            currentPage: 1,
            transactions: [],
            items: [
                {
                    text: 'Home',
                    href: '/'
                },
                {
                    text: 'Transações',
                    active: true
                }
            ]
        }
    },
    created() {
        this.loadingForm = true
        this.$axios.get('transaction/get-by-user_id/1')
            .then(res => {
                let data = res.data.response;
                this.transactions.push(...data.transactions.reverse());
            })
            .catch(error => {

            })
            .then(() => {
                this.loadingForm = false;
            })
    },
    methods: {
        submit: async function (event) {
            if (!this.valor) this.errors.push("Informe um valor");
            if (!this.tipo) this.errors.push("Informe um tipo de transação.");
            if (!this.descricao) this.errors.push("Informe uma descrição.");

            if (this.errors.length == 0) {
                this.loading = true;
                this.$axios.post('/transaction/create', {
                    user_id: this.$auth.user.id,
                    value: this.valor,
                    type: this.tipo,
                    description: this.descricao
                })
                    .then(res => {
                        let data = res.data.response;

                        if (!res.data.error) {
                            this.transactions.unshift(data.transactions);
                            event.target.reset()
                        } else {
                            this.$notify.error(data.message);
                        }


                    })
                    .catch(error => {

                    })
                    .then(() => {
                        this.loading = false;
                    })
            }
        },
        selectItemDelete: function (index, id) {

            this.statusDelete = true;
            this.idSelected = id;
            this.indexSelected = index;
            // if (this.statusDelete === true) {
            //     this.transactions.splice(index, 1);
            // }

        },
        deleteItem: function () {
            console.log(this.idSelected, this.indexSelected)

            this.$axios.delete(`transaction/delete/${this.idSelected}`)
                .then(res => {
                    console.log(!res.data.error)
                    if (!res.data.error) {
                        console.log(res.data.response)
                        this.transactions.splice(this.indexSelected, 1)
                        this.statusDelete = false;
                        this.$notify.success({
                            title: 'Sucesso!',
                            message: res.data.response.message
                        });
                    } else {
                        this.$notify.error('Oops.', res.data.response.message);
                    }
                })
                .catch(error => {

                })
                .then(() => {

                })
        }
    }
}
</script>