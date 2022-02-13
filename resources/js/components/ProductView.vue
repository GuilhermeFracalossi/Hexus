<style scoped lang="css">
  @import "~/css/productView.css"; 
</style>
<template>
    <section class="product-view">
        <h2>{{ product.name }}</h2>

        <div class="full-product">
            <div class="d-flex gap-3">
                <!-- <div class="left-images-mini">
                    <div>
                        <img
                            src="../resources/images/product-sample.jpg"
                            alt=""
                        />
                    </div>
                    <div>
                        <img
                            src="../resources/images/product-sample (2).jpg"
                            alt=""
                        />
                    </div>
                    <div>
                        <img
                            src="../resources/images/product-sample (3).jpg"
                            alt=""
                        />
                    </div>
                    <div>
                        <img
                            src="../resources/images/product-sample (5).jpg"
                            alt=""
                        />
                    </div>
                </div> -->
                <!-- <div class="divisor-vertical"></div> -->

                <div class="product-main-image">
                    <img
                        src="{{('img/' . $product->image) }}"
                        alt=""
                    />
                </div>
            </div>
            <div class="product-info">
                <div>
                    <!-- <div class="rating">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                        <i class="bi bi-star"></i>
                        <p class="rating-star-text">(3.5)</p>
                        <p class="rating-count-text">140 avaliações</p>
                    </div> -->

                    <div class="older-price">{{product.price}}</div>

                    <div class="current-price">R$ 3.499,90</div>

                    <div class="payment">
                        <p class="discount-payment">
                            À vista no boleto com 13% OFF
                        </p>
                        <p>Ou em até 12x {{Math.round(product.price / 12, -2)}} no cartão sem juros</p>
                        <a href="">Outras formas de pagamento</a>
                    </div>
                </div>
                <div class="shipping-container">
                    <p>Calcular o frete</p>
                    <div class="d-flex gap-2">
                        <input
                            type="text"
                            placeholder="Insira o CEP"
                            name="cep"
                            id="cepField"
                        />
                        <button
                            class="btn btn-outline-primary"
                            id="submit_cep_btn"
                        >
                            Ok
                        </button>
                    </div>
                </div>
            </div>
            <div class="actions-product">
                <div class="top-buttons">
                    <i class="bi bi-share" @click="shareLink"></i>
                    <i class="bi bi-heart"></i>
                </div>
                <button @click="addToCart" class="primary" id="buy-product-btn">Comprar</button>
            </div>
        </div>
    </section>

    <h1>{{ product.name }}</h1>

    <p>{{ product.price }}</p>
</template>

<script>
import { onMounted } from "vue";
import useProducts from "../composables/products";
import useCart from "../composables/cart";

export default {
    props: {
        id: {
            required: true,
            type: String,
        },
    },
    setup(props) {
        const { product, getProduct } = useProducts();
        const { addProduct } = useCart();

        //  const product = ref([]);

        onMounted(getProduct(props.id));

        const addToCart = async () => {
            await addProduct({id: props.id});
        }
        // const shareLink = () => {
        //     $vToastify.success("Foda");
        // }
        
        return {
            product,
            addToCart
        };
    },
};
</script>
