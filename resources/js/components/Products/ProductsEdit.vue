<template>
    <form @submit.prevent="saveProduct" enctype="multipart/form-data">
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
                v-model="product.price"
            />
        </div>
        <div class="mb-3">
            <label for="product_brand" class="form-label">Marca</label>
            <input
                type="text"
                class="form-control"
                id="product_brand"
                v-model="product.brand"
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
        <router-link :to="{name: 'products.index'}" class="btn btn-secondary">Cancelar</router-link>

    </form>
</template>

<script>
import useProducts from "../../composables/products";
import { onMounted } from "vue";
import useCategories from "../../composables/categories";

export default {
    props: {
        id: {
            required: true,
            type: String,
        },
    },
    setup(props) {
        const { product, getProduct, updateProduct } = useProducts();
        var files;
        const { categories, getCategories } = useCategories();


        onMounted(async()=> {
            await getCategories(),
            await getProduct(props.id)
        });
        const submitFiles = (event) => {
            files = event.target.files[0];
        }
        const saveProduct = async () => {
            let data = new FormData();

            data.append('name', product.value.name)
            data.append('category', product.value.category)
            data.append('price', product.value.price)
            data.append('status', product.value.status)
            data.append('brand', product.value.brand)
            data.append('description', product.value.description)
            data.append('information', product.value.information)
            if (files) {
                data.append('images', files)
            }

            await updateProduct(props.id, data);
        };

        return {
            product,
            categories,
            saveProduct,
            submitFiles
        };
    },
};
</script>
