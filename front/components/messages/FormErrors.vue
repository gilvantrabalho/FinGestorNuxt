<template>
    <div v-if="errors.length" class="alert alert-danger border-0">
        <div v-for="item in errors" class="cont">
            <span class="x-icon">x</span>
            <span class="">{{ item }}</span>
        </div>
    </div>
</template>

<style>
.x-icon {
    font-size: 20px;
    color: red;
    font-weight: 500;
}
</style>

<script>
export default {
    props: ['errors']
}
</script>