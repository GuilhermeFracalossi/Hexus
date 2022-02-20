<style scoped>
.title {
    color: #fff;
    font-size: 28px;
    font-weight: bold;
    text-align: center;
    margin: 40px 0px;
}

.payment-methods-container {
    display: flex;
    gap: 20px;
    height: 200px;
}
.payment-methods-container > div {
    flex-grow: 1;
}

.label-payment {
    width: 100%;
    height: 100%;
    line-height: 160px;
}

.pay-btn {
    padding: 20px 40px;
    margin: 30px 0px;
    font-weight: bold;
    
}
</style>
<template>
    <div class="container">
        <h1 class="title">Escolha o método de pagamento</h1>

        <div class="payment-methods-container">
            <div>
                <input
                    type="radio"
                    class="btn-check"
                    name="options"
                    id="boleto"
                    autocomplete="off"
                    checked
                />
                <label
                    class="btn btn-outline-primary btn-lg label-payment"
                    for="boleto"
                    >Boleto</label
                >
            </div>
            <div>
                <input
                    type="radio"
                    class="btn-check"
                    name="options"
                    id="pix"
                    autocomplete="off"
                />
                <label
                    class="btn btn-outline-primary btn-lg label-payment"
                    for="pix"
                    >Pix</label
                >
            </div>
        </div>
    </div>

    <div class="d-flex justify-center">
        <button @click="confirmOrder" class="btn btn-success btn-lg pay-btn">
            Pagar
        </button>
    </div>
</template>

<script>
import { onMounted } from "vue";
import useCart from "../composables/cart";
import { useRouter } from "vue-router";

export default {
    setup() {
        const router = useRouter();
        const { productsCart, getCart, emptyCart } = useCart();

        onMounted(getCart());

        const confirmOrder = async () => {
            //await getCart();
            //console.log(productsCart);
            emptyCart();
            router.push({ name: "confirmOrder" });
        };
        return {
            productsCart,
            confirmOrder,
        };
    },
};
</script>
