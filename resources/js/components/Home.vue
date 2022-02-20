<style scoped src="../../css/home.css"></style> 

<template>
    <div
        id="promo-carousel"
        class="carousel slide container"
        data-bs-ride="carousel"
    >
        <div class="carousel-indicators">
            <button
                type="button"
                data-bs-target="#promo-carousel"
                data-bs-slide-to="0"
                class="active"
                aria-current="true"
                aria-label="Slide 1"
            ></button>
            <button
                type="button"
                data-bs-target="#promo-carousel"
                data-bs-slide-to="1"
                aria-label="Slide 2"
            ></button>
            <button
                type="button"
                data-bs-target="#promo-carousel"
                data-bs-slide-to="2"
                aria-label="Slide 3"
            ></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img
                    src="/images/carosel1.png"
                    class="d-block w-100"
                    alt="..."
                />
            </div>
            <div class="carousel-item">
                <img
                    src="/images/carosel2.webp"
                    class="d-block w-100"
                    alt="..."
                />
            </div>
            <div class="carousel-item">
                <img
                    src="/images/carosel3.png"
                    class="d-block w-100"
                    alt="..."
                />
            </div>
 
        </div>
        <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#promo-carousel"
            data-bs-slide="prev"
        >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#promo-carousel"
            data-bs-slide="next"
        >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section class="container products">
        <h2>PC gamer monstro é na Hexus!</h2>

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

    <section class="container categories">
            <h2>Categorias</h2>


            <div class="categories-container">
                <div class="category" v-for:="category in categories" @click="$router.push({ name: 'ProductsListing' , params: { category: category.name} })">
                    <p class="category-title">{{ category.name }}</p>
                </div>
            </div>
        </section>

    <Footer/>
</template>


<script>
import { onMounted} from "vue";
import router from "../router";
import useProducts from "../../js/composables/products";
import useCategories from "../../js/composables/categories";
export default {
    
    setup() {
        const { products, getActiveProducts } = useProducts();
        const { categories, getCategories } = useCategories();

        onMounted( ()=> {

            getActiveProducts(true), 
            getCategories("A")
            
        });


        return {
            products,
            categories
        };
    },
};
</script>
