<template>
    <div>
        <h1>Aqui vai o banner</h1>
    </div>

    <div>
        
        <template v-for:="product in products">
            <div class="card" style="width: 18rem" @click="$router.push({ name: 'product.view', params: {id: product.id } })">
                <!-- <img src="..." class="card-img-top" alt="..." /> -->
                <div class="card-body">
                    <h5 class="card-title">{{product.name}}</h5>
                    <p class="card-text">{{ product.price }}</p>
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
            </div>
        </template>
    </div>
</template>
<script>
import { reactive, onMounted } from "vue";
import useProducts from "../../js/composables/products";
import useCategories from "../../js/composables/categories";

export default {
    setup() {
        const { products, getActiveProducts } = useProducts();
        //const { categories, getActiveCategories } = useCategories();

        onMounted(getActiveProducts(true));

        // const saveProduct = async () => {
        //     await storeProduct({ ...form });
        // };
        return {
            products,
        };
    },
};
</script>
