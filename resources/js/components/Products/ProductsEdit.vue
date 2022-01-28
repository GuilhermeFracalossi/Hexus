<template>
    <form @submit.prevent="saveProduct">
        <div class="mb-3">
            <label for="product_name" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control"
                id="product_name"
                v-model="product.name"
            />
        </div>
        <div class="mb-3">
            <label for="product_category" class="form-label">Categoria</label>
            <select
                class="form-select"
                id="product_category"
                v-model="product.category"
            >
                <option selected>Selecione categoria...</option>
                <option value="1">Processador</option>
                <option value="2">Placa de vídeo</option>
                <option value="3">Placa mãe</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="product_price" class="form-label">Preço</label>
            <input
                type="text"
                class="form-control"
                id="product_price"
                v-model="product.price"
            />
        </div>
        <div class="mb-3">
            <label for="product_status" class="form-label">Status</label>
            <select
                class="form-select"
                aria-label="Default select example"
                id="product_status"
                v-model="product.status"
            >
                <option selected>Selecione status</option>
                <option value="A">Ativo</option>
                <option value="I">Inativo</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="product_description" class="form-label"
                >Descrição</label
            >
            <textarea
                class="form-control"
                id="product_description"
                rows="3"
                v-model="product.description"
            ></textarea>
        </div>
        <div class="mb-3">
            <label for="product_info" class="form-label">Informações</label>
            <textarea
                class="form-control"
                id="product_info"
                rows="6"
                v-model="product.information"
            ></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" @click="$router.push({name: 'produtos.index'})">Cancelar</button>

    </form>
</template>

<script>
import useProducts from "../../composables/products";
import { onMounted } from "vue";
export default {
    props: {
        id: {
            required: true,
            type: String,
        },
    },
    setup(props) {
        const { product, getProduct, updateProduct } = useProducts();

        onMounted(getProduct(props.id));
        const saveProduct = async () => {
            console.log(props.id)
            await updateProduct(props.id);
        };

        return {
            product,
            saveProduct,
        };
    },
};
</script>
