<template>
    <form @submit.prevent="saveProduct">
        <div class="mb-3">
            <label for="product_name" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control"
                id="product_name"
                v-model="form.name"
            />
        </div>
        <div class="mb-3">
            <label for="product_category" class="form-label">Categoria</label>
            <select
                class="form-select"
                id="product_category"
                v-model="form.category"
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
                v-model="form.price"
            />
        </div>
        <div class="mb-3">
            <label for="product_status" class="form-label">Status</label>
            <select
                class="form-select"
                aria-label="Default select example"
                id="product_status"
                v-model="form.status"
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
                v-model="form.description"
            ></textarea>
        </div>
        <div class="mb-3">
            <label for="product_info" class="form-label">Informações</label>
            <textarea
                class="form-control"
                id="product_info"
                rows="6"
                v-model="form.information"
            ></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</template>

<script>
import { reactive } from "vue";
import useProducts from "../../composables/products";

export default {

    setup() {
        const form = reactive({
            name: "",
            category: "",
            price: "",
            status: "",
            description: "",
            information: "",
        });


        const { errors, storeProduct } = useProducts();

        const saveProduct = async () => {
            await storeProduct({ ...form });
        };
        return {
            form,
            errors,
            saveProduct,
        };
    },
};
</script>
