<style scoped>
.title {
    font-size: 32px;
    color: #f4f4f4;
    font-weight: bold;
}
</style>

<template>
    <div class="d-flex justify-content-center align-items-center my-3">
        <i
            class="bi bi-check-circle"
            style="font-size: 100px; color: #80f76a"
        ></i>
        <h1 class="title mx-4">Obrigado pela compra!</h1>
    </div>

    <div class="d-flex justify-content-center">
        <router-link :to="{ name: 'home' }" class="btn btn-lg btn-primary"
            >Voltar a página inicial</router-link
        >
    </div>
</template>
