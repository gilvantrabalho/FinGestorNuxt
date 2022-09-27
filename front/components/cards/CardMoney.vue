<template>
    <div class="shadow bg-white rounded card-no-header">
        <div class="d-flex h-100">
            <div :class="`barra rounded ${color}`"></div>
            <div class="cont-left">
                <div class="ms-4">
                    <h4 class="p-0 m-1 text-secondary">{{ title }}</h4>
                    <div v-if="!loading" class="ms-3 number">R$ {{ value }}</div>
                    <div v-else class="d-flex justify-content-center">
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cont-right border-start">
                <i :class="`${icon} icon-style text-secondary`"></i>
            </div>
        </div>
    </div>
</template>

<style>
.card-no-header {
    height: 130px;
    /* display: flex; */
}

.barra {
    width: 5px;
}

.cont-left {
    flex: 3 !important;
    display: flex;
    /* justify-content: center; */
    align-items: center;
}

.cont-right {
    flex: 1 !important;
    display: flex;
    justify-content: center;
    align-items: center;
}

.number {
    font-size: 18px;
}

.icon-style {
    font-size: 40px !important;
}
</style>

<script>
export default {
    props: {
        title: {
            type: String,
            required: true
        },
        color: {
            type: String,
            required: true
        },
        value: {
            type: Number,
            required: true
        },
        icon: {
            type: String,
            required: true
        },
        loading: {
            type: Boolean,
            default: false
        }
    }
}
</script>