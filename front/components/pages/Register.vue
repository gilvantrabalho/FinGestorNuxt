<template>
    <Card class="tm">

        <template v-slot:header>
            <div class="rrr">
                <div class="fff shadow">
                    <img width="100%" class="p-4" src="~assets/img/logo/icon-logo.png" alt="">
                </div>
            </div>
        </template>

        <template v-slot:body>
            <FormErrors :errors="errors" />

            <form @submit.prevent="submit" class="mt-3" method="post">
                <InputComponent type="text" classicon="bi bi-person-fill" v-model="name" class="mb-3"
                    placeholder="Digite seu nome..." />
                <InputComponent type="email" classicon="bi bi-envelope-fill" v-model="email" class="mb-3"
                    placeholder="Digite seu email..." />
                <InputComponent type="password" classicon="bi bi-lock-fill" v-model="password"
                    placeholder="Digite sua senha..." />
                <Button :loading="loading" class="mt-3" title="Cadastrar" type="submit" />
            </form>

        </template>

    </Card>
</template>

<style>
.tm {
    width: 500px !important;
    padding-bottom: 80px !important;
}

.ops-esqueceu-senha {
    display: flex;
    justify-content: space-between;
    margin-top: 7px;
}

.ops-esqueceu-senha span {
    font-size: 15px;
    font-weight: 450;
}

.rrr {
    display: flex;
    justify-content: center;
}

.fff {
    display: flex !important;
    width: 150px;
    height: 150px;
    z-index: 999;
    background-color: white;
    border-radius: 50%;

    margin-top: -100px;
    margin-bottom: 20px;
}

hr {
    color: red;
    /* background-color: red; */
    margin-bottom: -17px;
}

.nav-login {
    /* padding-top: -200px !important; */
    display: flex;
    justify-content: center;
}

.nav-login span {
    background-color: white;
    padding-left: 20px;
    padding-right: 20px;
    font-size: 20px;
}
</style>

<script>
import Card from '../cards/Card.vue'
import FormErrors from '../messages/FormErrors.vue'
import Button from '../buttons/Button.vue'
import InputComponent from '../forms/input/InputComponent.vue'

export default {
    name: 'home',
    components: {
        Card,
        FormErrors,
        Button,
        InputComponent
    },
    data() {
        return {
            loading: false,
            name: '',
            email: '',
            password: '',
            errors: []
        }
    },
    methods: {
        submit: function (event) {
            this.errors = []
            if (!this.name) this.errors.push("Informe um nome.");
            if (!this.email) this.errors.push("Informe um email válido.");
            if (!this.password) this.errors.push("Informe uma senha.");

            if (this.errors.length == 0) {
                this.loading = true;
                this.$axios.post('/user/create', {
                    name: this.name,
                    email: this.email,
                    password: this.password
                })
                    .then(res => {
                        let data = res.data.response
                        if (res.data.error) {
                            if (data.message.email[0]) {
                                this.$notify.error({
                                    title: 'Oops',
                                    message: data.message.email[0]
                                })
                            }
                        } else {
                            event.target.reset()
                            this.$notify.success({
                                title: 'Sucesso!',
                                message: data.message
                            })
                        }
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
}
</script>