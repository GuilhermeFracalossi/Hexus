<template>
    <form @submit.prevent="saveCategory">
        <div class="mb-3">
            <label for="category_name" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control"
                id="category_name"
                v-model="category.name"
            />
        </div>
        <div class="mb-3">
            <label for="category_parent_category" class="form-label">Categoria</label>
            <select
                class="form-select"
                id="category_parent_category"
                v-model="category.parent_category"
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
                v-model="category.status"
            >
                <option selected>Selecione status</option>
                <option value="A">Ativo</option>
                <option value="I">Inativo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" @click="$router.push({name: 'categories.index'})">Cancelar</button>

    </form>
</template>

<script>
import useCategories from "../../composables/categories";
import { onMounted } from "vue";
export default {
    props: {
        id: {
            required: true,
            type: String,
        },
    },
    setup(props) {
        const { category, getCategory, updateCategory } = useCategories();

        onMounted(getCategory(props.id));
        const saveCategory = async () => {
            await updateCategory(props.id);
        };

        return {
            category,
            saveCategory,
        };
    },
};
</script>
