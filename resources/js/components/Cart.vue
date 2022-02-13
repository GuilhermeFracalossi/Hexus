<template>
    <div class="container">
        <section>
            <h2>Carrinho</h2>

            <table>
                <thead>

                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </section>

        <section>
            <h2>Frete</h2>
        </section>

        <section>
            <h2>Resumo</h2>
        </section>
    </div>
</template>

<script>
import { onMounted } from "vue";
import useCart from "../composables/cart";

export default {
    setup() {
        const { product, getCart } = useCart();
        //  const product = ref([]);

        onMounted(()=> {
            getCart()
        });

        return {
            product,
        };
    },
};
</script>
