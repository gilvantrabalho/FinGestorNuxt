<template>
    <div>
        <button v-if="!loading" class="btn-person btn btn-primary" :type="type">
            {{ title }}
        </button>

        <button v-else disabled class="btn-person btn btn-primary btn-disa" :type="type">
            {{ title }}
            <div class="spinner-grow position-absolute" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </button>

    </div>
</template>

<style>
.btn-person {
    width: 100%;
    padding: 15px;
    border-radius: 30px;
    font-weight: 600;
}

.btn-disa {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>

<script>
export default {
    props: {
        title: {
            type: String,
            default: "Exemplo",
            require: true
        },
        type: {
            type: String,
            default: "text",
            require: true,
        },
        loading: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            styles: {
                color: 'red'
            }
        }
    }
}
</script>