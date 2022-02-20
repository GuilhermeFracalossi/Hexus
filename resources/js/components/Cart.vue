<style scoped>
.title {
    text-align: center;
    font-weight: bold;
    color: #fff;
    margin-bottom: 20px;
}
section {
    background-color: #34373b;
    padding: 20px;
    border-radius: 5px;
}
section h2 {
    color: #fff;
    font-weight: bold;
}

.products-list th {
    font-weight: 300;
    font-size: 14px;
    color: #fff;
    padding: 10px 0px;
}
.products-list tbody tr {
    border-bottom: 1px solid #636970;
    padding: 10px;
}
.products-list td:nth-of-type(n + 2) {
    padding: 0px 20px;
}

.products-list .product-price {
    color: #0090f6;
    font-weight: bold;
    font-size: 14px;
}
.products-list .product-name {
    color: #fff;
    font-weight: bold;
    font-size: 14px;
}

.cart-left {
    flex-grow: 2;
}
.cart-right {
    flex-grow: 1;
}
.container {
    gap: 32px;
    margin-top: 50px;
}

.product-image {
    width: 70px;
    height: 70px;
    background-color: #fff;
}
.product-image img {
    width: 100%;
    height: 100%;
}
.total-price {
    color: #0090f6;
    font-weight: bold;
    font-size: 36px;
    text-align: right;
}
</style>

<template>
    <div class="container d-flex" v-if="productsCart.length > 0">
        <div class="cart-left">
            <section>
                <h2>Carrinho</h2>

                <table class="products-list">
                    <thead>
                        <tr>
                            <th colspan="2">Produto</th>
                            <th class="text-center" style="width: 140px">
                                Quant:
                            </th>
                            <th class="text-center">Preço</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for:="product in productsCart">
                            <td>
                                <div class="product-image">
                                    <img
                                        :src="'/img/' + product.images"
                                        alt=""
                                    />
                                </div>
                            </td>
                            <td class="product-name">{{ product.name }}</td>
                            <td class="text-center text-white">
                                <button
                                    :disabled="product.quantity <= 1"
                                    @click="
                                        product.quantity--,
                                            updateQuantity(product)
                                    "
                                >
                                    <i
                                        class="bi bi-dash"
                                        style="font-weight: bold; color: #fff"
                                    ></i>
                                </button>

                                {{ product.quantity }}
                                <button
                                    @click="
                                        product.quantity++,
                                            updateQuantity(product)
                                    "
                                >
                                    <i
                                        class="bi bi-plus"
                                        style="
                                            font-weight: bold;
                                            font-size: 20px;
                                            color: #0090f6;
                                        "
                                    ></i>
                                </button>
                            </td>
                            <td class="product-price text-center">
                                {{ product.price }}
                            </td>
                            <td>
                                <button @click="removeItem(product.id)">
                                    <i
                                        class="bi bi-trash"
                                        style="color: #fff; font-size: 23px"
                                    ></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-end">
                    <button
                        @click="removeAll()"
                        class="btn btn-outline-danger"
                        style="margin-top: 20px"
                    >
                        Esvaziar carrinho
                    </button>
                </div>
            </section>

            <!-- <section>
                <h2>Frete</h2>
            </section> -->
        </div>

        <div class="cart-right">
            <section>
                <h2>Resumo</h2>

                <p style="font-weight: bold; color: #cacaca">TOTAL:</p>
                <p class="total-price">{{ getTotalPrice }}</p>
                <button
                    @click="payment"
                    class="btn btn-primary"
                    style="width: 100%; margin-bottom: 20px; font-weight: bold"
                >
                    Fechar pedido
                </button>

                <router-link
                    :to="{ name: 'home' }"
                    class="btn btn-outline-primary"
                    style="width: 100%"
                >
                    Continuar comprando
                </router-link>
            </section>
        </div>
    </div>
    <div v-else>
        <h1 class="title">Seu carrinho está vazio!</h1>
        <div class="d-flex justify-content-center">
            <router-link
            :to="{ name: 'home' }"
            class="btn btn-lg btn-primary"
          
        >
            Continuar comprando
        </router-link>
        </div>
        
    </div>
</template>

<script>
import { onMounted, computed } from "vue";
import useCart from "../composables/cart";
import { useRouter } from "vue-router";

import {
    calcularPrecoPrazo,
    consultarCep,
    rastrearEncomendas,
} from "correios-brasil";
//var Boleto = require('node-boleto').Boleto;
//import { Boleto} from 'node-boleto';
export default {
    setup() {
        const router = useRouter();
        const { productsCart, getCart, removeProduct, updateItem, emptyCart } =
            useCart();

        onMounted(getCart(), console.log(productsCart));

        const removeItem = async (id) => {
            await removeProduct(id);
            await getCart();
        };

        const getTotalPrice = computed(() => {
            let total = 0;
            productsCart.value.forEach(function (product) {
                total += parseFloat(product.price);
            });
            return Number(total).toLocaleString("pt-br", {
                style: "currency",
                currency: "BRL",
            });
        });

        const updateQuantity = async (product) => {
            await updateItem(product);
        };
        const removeAll = async () => {
            await emptyCart();
            await getCart();
        };

        const payment = async () => {
            await router.push({ name: "checkout" });
        };
        return {
            productsCart,
            removeItem,
            updateQuantity,
            removeAll,
            payment,
            getTotalPrice,
        };
    },
};
</script>
