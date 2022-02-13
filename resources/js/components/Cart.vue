<template>
    


<h1>Carrinho</h1>

</template>


<script>
import { onBeforeMount, onMounted } from "vue";
import useProducts from "../composables/products";

export default {

     props: {
        id: {
            required: false,
            type: String,
        },
    },
    setup(props) {
        const { product } = useProducts();
        //  const product = ref([]);

        onBeforeMount(console.log('aa'));
        onMounted(console.log('tete'));


        
        return {
            product
        };
    },
};
</script>