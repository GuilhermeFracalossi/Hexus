<template>
    <div>
        <div>
            <button
                class="btn btn-primary"
                @click="$router.push({ name: 'products.create' })"
            >
                Incluir
            </button>
            <button class="btn btn-danger" @click="deleteProducts(selectedProducts)">Excluir</button>

        </div>

        <table class="table">
            <thead>
                <tr scope="col">
                    <td scope="col"></td>
                    <td scope="col">Nome</td>
                    <td scope="col">Descrição</td>
                    <td scope="col">Informação</td>
                    <td scope="col">Categorias</td>
                    <td scope="col">Preço</td>
                </tr>
            </thead>
            <tbody>
                <template v-for:="product in products">
                    <tr >
                        <td>
                            <input
                                class="form-check-input"
                                type="checkbox"
                                v-bind:value="product.id"
                                v-model="selectedProducts"
                            />
                        </td>
                        <td @click="editProduct(product.id)">{{ product.name }}</td>
                        <td @click="editProduct(product.id)">{{ product.description }}</td>
                        <td @click="editProduct(product.id)">{{ product.information }}</td>
                        <td @click="editProduct(product.id)">{{ product.category }}</td>
                        <td @click="editProduct(product.id)">{{ product.price }}</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import useProducts from "../../composables/products";
import { onMounted, ref } from "vue";
import router from "../../router";
export default {

    setup() {
        const selectedProducts = ref([])
        const { products, getProducts, destroyProducts } = useProducts();

        onMounted(getProducts);

        const editProduct = (id) => {
            return router.push({ name: 'products.edit', params: { id: id} })
        }
        const deleteProducts = async (ids) => {
            await destroyProducts(ids)
            await getProducts()
        }

        return { 
            products,
            selectedProducts,
            deleteProducts,
            editProduct
        };
    }
};
</script>
