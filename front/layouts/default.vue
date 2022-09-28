<template>
    <div class="cont-layout">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm p-3 mb-4">
            <div class="container">
                <NuxtLink to="/" class="navbar-brand">Navbar</NuxtLink>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <NuxtLink to="/" class="active nav-link">Home</NuxtLink>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Transações
                            </a>
                            <ul class="dropdown-menu shadow border-0 animate__animated animate__fadeInUp"
                                aria-labelledby="navbarDropdown">
                                <li>
                                    <NuxtLink to="/transactions/add" class="dropdown-item">Adicionar</NuxtLink>
                                </li>
                                <li>
                                    <NuxtLink to="/transactions/my-transactions" class="dropdown-item">
                                        Minhas Transações
                                    </NuxtLink>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>

                    </div>
                </div>
                <div>
                    <span>Olá, {{ this.$auth.user.name }}</span>
                    <button class="btn btn-sm btn-secondary ms-2">Sair</button>
                </div>
            </div>
        </nav>
        <div class="container">
            <Nuxt />
        </div>
        <footer class="bg-white shadow-sm p-3">
            <small class="text-secondary">FinGestor 2022</small>
        </footer>
    </div>
</template>

<style>
footer {
    /* background: #ffab62; */
    width: 100%;
    /* height: 30px; */
    position: absolute;
    bottom: 0;
    left: 0;
}

@font-face {
    font-family: 'satoshi';
    src: url(../assets/fonts/Satoshi-Medium.otf);
}

.container {
    font-family: 'satoshi' !important;
}

.cont-layout {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: #F0F8FF;
}

.style-thead .one {
    border-top-left-radius: 3px;
}

.ult {
    border-top-right-radius: 3px;
}

.style-thead th {
    padding: 15px;
    font-weight: 500 !important;
}

.style-tbody tr td {
    padding: 15px;
}

button.close {
    background-color: red;
    border: none;
    background-color: transparent;
    font-size: 20px;
}

select {
    min-height: 60px;
    border-left: none;
    border-radius: 30px !important;
    font-size: 18px;
    /* border-top-right-radius: 30px !important; */
    /* border-bottom-right-radius: 30px !important; */
}

select option:first {
    color: #999 !important;
}
</style>

<script>
import 'animate.css';
export default {

}
</script>