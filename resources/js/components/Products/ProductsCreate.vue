<template>
    <form @submit.prevent="saveProduct" enctype="multipart/form-data">
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
                <option value="0">Selecione categoria...</option>
                
                <option v-bind:value="category.id" v-for:="category in categories">{{category.name}}</option>

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
                <option value="0">Selecione status</option>
                <option value="A">Ativo</option>
                <option value="I">Inativo</option>
            </select>
        </div>
         <div class="mb-3">
            <label for="product_brand" class="form-label">Marca</label>
            <input
                type="text"
                class="form-control"
                id="product_brand"
                v-model="form.brand"
            />
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
        <div class="mb-3">
            <label for="formFileMultiple" class="form-label"
                >Imagens</label
            >
            <input
                class="form-control"
                type="file"
                id="product_images"
                @change="submitFiles"
        
            />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button
            type="button"
            class="btn btn-secondary"
            @click="$router.push({ name: 'products.index' })"
        >
            Cancelar
        </button>
    </form>
</template>

<script>
import { onMounted, reactive } from "vue";
import useProducts from "../../composables/products";
import useCategories from "../../composables/categories";

export default {
    setup() {
        const form = reactive({
            name: "",
            category: 0,
            price: "",
            status: 0,
            description: "",
            brand: "",
            information: "",
        });
        var files;

        const { errors, storeProduct } = useProducts();

        const { categories, getCategories } = useCategories();

        const submitFiles = (event) => {
            files = event.target.files[0];
        }
        onMounted(getCategories);

        const saveProduct = async () => {
            let data = new FormData();
            data.append('name', form.name)
            data.append('category', form.category)
            data.append('price', form.price)
            data.append('status', form.status)
            data.append('brand', form.status)
            data.append('description', form.description)
            data.append('information', form.information)
            data.append('images', files)

            await storeProduct(data);
        };
        return {
            form,
            errors,
            saveProduct,
            submitFiles,
            categories
        };
    },
};
</script>
