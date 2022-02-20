<style scoped lang="css" src="../../css/ProductView.css"></style>
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
                    <img :src="'/img/'+ product.images" alt="" />
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

                    <div class="older-price"></div>

                    <div class="current-price">
                        {{
                            Number(product.price).toLocaleString("pt-br", {
                                style: "currency",
                                currency: "BRL",
                            })
                        }}
                    </div>

                    <div class="payment">
                        <p class="discount-payment">
                            À vista no boleto com 13% OFF
                        </p>
                        <p>Ou em até 12x {{  Number(Math.round(product.price / 12, -2)).toLocaleString("pt-br", {
                                style: "currency",
                                currency: "BRL",
                            })}} no cartão sem juros</p>
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
                            @click="calcularFrete()"
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
                <button @click="addToCart" class="primary" id="buy-product-btn">
                    Comprar
                </button>
            </div>
        </div>
    </section>
     <section class="product-description">
            <div class="section-header-product d-flex align-items-center">
                <i class="bi bi-file-earmark-text" style="color: #f4f4f4; font-size: 40px;"></i>
                <h3>Descrição</h3>
            </div>
            <h4>{{product.name}}</h4>

            <p>
                {{product.description}}
            </p>


        </section>
        <section class="product-info">
            <div class="section-header-product d-flex align-items-center">
                <i class="bi bi-info-circle" style="color: #f4f4f4; font-size: 40px;"></i>
                <h3>Informações</h3>
            </div>

            <p>
                {{product.information}}
            </p>
        </section>

        <Footer/>
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

        onMounted(getProduct(props.id), console.log(product));

        const addToCart = async () => {
            await addProduct({ id: props.id });
        };

        const calcularFrete = () => {
            //console.log( VueToastify.success("Successfully updated value!"))
            
        };

        return {
            product,
            addToCart,
            calcularFrete,
        };
    },
};
</script>
