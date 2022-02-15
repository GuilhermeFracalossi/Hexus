<template>
    <div class="container" v-if="productsCart.length > 0">
        <section>
            <h2>Carrinho</h2>

            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Produto</th>
                        <th>Quant:</th>
                        <th>Preço</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for:="product in productsCart">
                        <td><img src="" alt="" /></td>
                        <td>{{ product.name }}</td>
                        <td>
                            <button
                                :disabled="product.quantity <= 1"
                                @click="
                                    product.quantity--, updateQuantity(product)
                                "
                            >
                                <i class="bi bi-dash"></i>
                            </button>

                            {{ product.quantity }}
                            <button
                                @click="
                                    product.quantity++, updateQuantity(product)
                                "
                            >
                                <i class="bi bi-plus"></i>
                            </button>
                        </td>
                        <td>{{ product.price }}</td>
                        <td>
                            <i
                                @click="removeItem(product.id)"
                                class="bi bi-trash"
                            ></i>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button @click="removeAll()" class="btn btn-danger">
                Esvaziar carrinho
            </button>
        </section>

        <section>
            <h2>Frete</h2>
        </section>

        <section>
            <h2>Resumo</h2>
        </section>
    </div>
    <div v-else>
        <h1>Seu carrinho está vazio!</h1>
        <router-link :to="{ name: 'home' }" class="btn btn-primary">
            Continuar comprando
        </router-link>
    </div>
</template>

<script>
import { onMounted } from "vue";
import useCart from "../composables/cart";

export default {
    setup() {
        const { productsCart, getCart, removeProduct, updateItem, emptyCart } =
            useCart();

        onMounted(getCart());

        const removeItem = async (id) => {
            await removeProduct(id);
            await getCart();
        };

        const updateQuantity = async (product) => {
            await updateItem(product);
        };
        const removeAll = async () => {
            await emptyCart();
            await getCart();
        };
        return {
            productsCart,
            removeItem,
            updateQuantity,
            removeAll,
        };
    },
};
</script>
