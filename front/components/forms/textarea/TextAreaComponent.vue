<template>
    <div class="text-start">
        <label v-if="label" class="text-left mb-3" for="">
            <span>{{ label }}</span>
            <span class="text-danger">{{ required ? '*' : '' }}</span>
        </label>
        <textarea v-model="model" class="form-control" rows="5" :placeholder="placeholder"></textarea>
    </div>
</template>

<style>
textarea {
    /* min-height: 100px; */
    margin-bottom: 0px;
    padding: 20px 27px 20px 20px !important;

    border: 1px solid #d9dbe9;
    border-radius: 20px !important;
    transition: border-color 300ms ease;
    color: #777990;
    font-size: 18px;
    /* line-height: 1em; */
}

.form-control {
    box-shadow: none !important;
}

.form-group {
    flex-direction: column;
    align-items: start !important;
    justify-content: start !important;
}

::-webkit-input-placeholder {
    color: #9C9C9C !important;
}

:-moz-placeholder {
    /* Firefox 18- */
    color: red !important;
}

::-moz-placeholder {
    /* Firefox 19+ */
    color: red !important;
}

:-ms-input-placeholder {
    color: red !important;
}
</style>

<script>
export default {
    props: ['label', 'placeholder', 'required'],
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