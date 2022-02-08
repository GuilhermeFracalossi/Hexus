<template>


    <h1>{{ product.name}}</h1>

    <p>{{ product.price}}</p>
</template>

<script>
import { onMounted } from "vue";
import useProducts from "../composables/products";

export default {
    props: {
        id: {
            required: true,
            type: String,
        },
    },
    setup(props) {
        const { product, getProduct } = useProducts();
        //  const product = ref([]);

        onMounted(getProduct(props.id));
        return {
            product
        }
    },
};
</script>
