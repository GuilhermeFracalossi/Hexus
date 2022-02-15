<template>
    <div>
        <div>
           
            <router-link :to="{ name: 'products.create' }" class="btn btn-primary">Incluir</router-link>
                
         
            <button
                class="btn btn-danger"
                @click="deleteProducts(selectedProducts)"
                :disabled="selectedProducts.length == 0"
            >
                Excluir
            </button>
            <input type="text" class="form-control" v-model="search" placeholder="Pesquisar produtos" />
        </div>

        <table class="table">
            <thead>
                <tr scope="col">
                    <td scope="col"></td>
                    <td scope="col">Nome</td>
                    <td scope="col">Categoria</td>
                    <td scope="col">Preço</td>
                    <td scope="col">Status</td>
                    <td scope="col">Modificado em:</td>
                </tr>
            </thead>
            <tbody>
                <template v-for:="product in productsListing">
                    <tr>
                        <td>
                            <input
                                class="form-check-input"
                                type="checkbox"
                                v-bind:value="product.id"
                                v-model="selectedProducts"
                            />
                        </td>
                        <td @click="editProduct(product.id)">
                            {{ product.name }}
                        </td>
                        <td @click="editProduct(product.id)">
                            {{ product.category }}
                        </td>
                        <td @click="editProduct(product.id)">
                            {{ product.price }}
                        </td>
                        <td @click="editProduct(product.id)">
                            {{ product.status }}
                        </td>
                        <td @click="editProduct(product.id)">
                            {{ product.updated_at.substring(0, 10) }}
                        </td>

                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import useProducts from "../../composables/products";
import { onMounted, ref, watch } from "vue";
import router from "../../router";
export default {
    setup() {
        const selectedProducts = ref([]);
        const search = ref([]);
        const { productsListing, getProductsForListing, destroyProducts } = useProducts();
        var timer  = undefined;

        onMounted(getProductsForListing);

        watch(
            search,
            (newSearch, oldSearch) => {
                clearTimeout(timer);

                timer = setTimeout(() => {
                    getProductsForListing(newSearch);
                }, 500);
            },
            {
                flush: "post",
            }
        );
        const editProduct = (id) => {
            return router.push({ name: "products.edit", params: { id: id } });
        };
        const deleteProducts = async (ids) => {
            await destroyProducts(ids);
            await getProductsForListing();
        };

        return {
            search,
            productsListing,
            selectedProducts,
            deleteProducts,
            editProduct,
        };
    },
};
</script>
