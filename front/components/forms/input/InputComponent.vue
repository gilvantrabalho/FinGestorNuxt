<template>
    <div class="input-group mb-3">
        <span class="input-group-text icon-span" id="basic-addon1">
            <i id="icon-input" :class="classicon"></i>
        </span>
        <input :type="type" class="form-control input-style" v-model="model" :placeholder="placeholder"
            aria-describedby="basic-addon1">
    </div>
</template>

<style>
.icon-span {
    background-color: transparent !important;
    border-top-left-radius: 30px;
    border-bottom-left-radius: 30px;
    padding-left: 20px;
}

.input-style {
    min-height: 60px;
    border-left: none;
    border-radius: 0px;
    font-size: 18px;
    border-top-right-radius: 30px !important;
    border-bottom-right-radius: 30px !important;
}

#icon-input {
    font-size: 20px;
    color: #9C9C9C;
}
</style>

<script>
export default {
    props: ['label', 'type', 'placeholder', 'required', 'classicon'],

    computed: {
        model: {
            get() {
                return this.value;
            },
            set(value) {
                this.$emit('input', value);
            },
        }
    }
}
</script>