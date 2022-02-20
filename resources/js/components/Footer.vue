<template>
    <footer>
        <div class="content container">
            <h3>Formas de pagamento</h3>

            <div class="payment-methods-images">
                <img
                    src="/images/boleto-logo.png"
                    id="boleto"
 
                />
                <img src="/images/pix.png" id="pix" />
            </div>
            <h3 style="margin-bottom: 20px">Mapa do site</h3>
            <div class="site-map">
                <router-link :to="{name: 'ProductsListing', params: {category: category.name} }" v-for:="category in categories">
                    {{category.name}}
                </router-link>

            </div>
            <div class="d-flex align-items-center flex-column bottom-footer">
                <hr />
                <div class="brand-footer">
                    <img
                        src="/images/brand.svg"
                        width="250"
                       
                    />
                </div>
                <p>Todos os direitos reservados</p>
            </div>
        </div>
    </footer>
</template>

<script>
import {onMounted} from "vue";
import useCategories from "../../js/composables/categories";

export default {
    setup() {
    
        const { categories, getCategories} = useCategories();
        onMounted(getCategories('A'));
        return {
            categories
        }

    },
}
</script>

