<template>
   <form @submit.prevent="saveCategory">
        <div class="mb-3">
            <label for="category_name" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control"
                id="category_name"
                v-model="form.name"
            />
        </div>
        <div class="mb-3">
            <label for="category_parent_category" class="form-label">Categoria</label>
            <select
                class="form-select"
                id="category_parent_category"
                v-model="form.parent_category_id"
            >
                <option selected>Selecione categoria...</option>
                <option value="1">Processador</option>
                <option value="2">Placa de vídeo</option>
                <option value="3">Placa mãe</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="category_status" class="form-label">Status</label>
            <select
                class="form-select"
                aria-label="Default select example"
                id="category_status"
                v-model="form.status"
            >
                <option selected>Selecione status</option>
                <option value="A">Ativo</option>
                <option value="I">Inativo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</template>

<script>
import { reactive } from "vue";
import useCategories from "../../composables/categories";

export default {

    setup() {
        const form = reactive({
            name: "",
            parent_category: "",
            status: ""
        });


        const { errors, storeCategory } = useCategories();

        const saveCategory = async () => {
            await storeCategory({ ...form });
        };
        return {
            form,
            errors,
            saveCategory,
        };
    },
};
</script>
