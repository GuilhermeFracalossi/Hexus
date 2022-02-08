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
            <label for="category_parent_category" class="form-label"
                >Categoria pai</label
            >
            <select
                class="form-select"
                id="category_parent_category"
                v-model="form.parent_category_id"
            >
                <option value="0">Selecione uma categoria</option>
                <option
                    v-for:="category in categories"
                    v-bind:value="category.id"
                >
                    {{ category.name }}
                </option>
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
                <option value="0">Selecione status</option>
                <option value="A">Ativo</option>
                <option value="I">Inativo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" @click="$router.push({name: 'categories.index'})">Cancelar</button>

    </form>
</template>

<script>
import { onMounted, reactive } from "vue";
import useCategories from "../../composables/categories";

export default {
    setup() {
        const form = reactive({
            name: "",
            parent_category_id: 0,
            status: "0",
        });
        const { categories, errors, storeCategory, getCategories } = useCategories();

        onMounted(getCategories);

        const saveCategory = async () => {
            await storeCategory({ ...form });
        };

        return {
            form,
            categories,
            errors,
            saveCategory,
        };
    },
};
</script>
