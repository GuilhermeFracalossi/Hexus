<style scoped src="../../css/home.css"></style>

<style scoped>
.title {
    margin-top: 50px;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 32px;
    color: #f4f4f4;
}
</style>
<template>
    <h1 class="title" v-if="products.length == 0">Nenhum produto encontrado</h1>
    <h1 class="title" v-else>{{title}}</h1>


    <section class="container products" v-if="products.length > 0">
        <div class="products-container">
            <div
                class="product"
                v-for:="product in products"
                @click="
                    $router.push({
                        name: 'product.view',
                        params: { id: product.id },
                    })
                "
            >
                <div class="rating">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-half"></i>
                    <i class="bi bi-star"></i>
                    <p class="rating-text">(3.5)</p>
                </div>

                <div class="product-image">
                    <img :src="'/img/' + product.images" alt="" />
                </div>

                <div class="product-info">
                    <p class="description">{{ product.name }}</p>
                    <p class="price">{{ product.price }}</p>
                    <p class="payment">À vista no boleto</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { ref, onMounted, watch, onUpdated } from "vue";
import useProducts from "../../js/composables/products";

export default {
    props: {
        category: {
            required: false,
            type: String,
        },
        query: {
            required: false,
            type: String,
        },
    },
    setup(props) {
        const { products, getActiveProducts } = useProducts();

        const title = ref();
        onMounted(() => {
           
            if (props.category) {

                getActiveProducts(true, props.category);
                title.value = props.category;
            
            } else if (props.query) {
                getActiveProducts(true, null, props.query);
                title.value = "Busca por: " + props.query;
            }
        });

        watch(props, async (newValue, oldValue) => {
            title.value = "Busca por: " + newValue.query;
            getActiveProducts(true, null, newValue.query);
        });

        // const loadProducts = async () => {
        //     if (props.category) {
        //         title.value = props.category;
        //         getActiveProducts(true, props.category);
        //     } else if (props.query) {
        //         title.value = "Busca por: " + props.query;
        //         getActiveProducts(true, null, props.query);
        //     }
        // };

        return {
            products,
            title
        };
    },
};
</script>
