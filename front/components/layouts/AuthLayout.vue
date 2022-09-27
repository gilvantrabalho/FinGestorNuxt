<template>
    <div class="cont-auth">
        <slot name="body"></slot>
    </div>
</template>

<style>
.cont-auth {
    position: absolute;
    width: 100%;
    height: 94.4%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-image: url('../../assets/img/fundo/fundo-auth.jpg');
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
}
</style>

<script>
export default {

}
</script>