<template>
    <div>
        <div>
            <button
                class="btn btn-primary"
                @click="$router.push({ name: 'categories.create' })"
            >
                Incluir
            </button>
            <button class="btn btn-danger" @click="deleteCategories(selectedCategories)">Excluir</button>

        </div>

        <table class="table">
            <thead>
                <tr scope="col">
                    <td scope="col"></td>
                    <td scope="col">Nome</td>
                    <td scope="col">Categoria Pai</td>
                    <td scope="col">Status</td>
                </tr>
            </thead>
            <tbody>
                <template v-for:="category in categories">
                    <tr >
                        <td>
                            <input
                                class="form-check-input"
                                type="checkbox"
                                v-bind:value="category.id"
                                v-model="selectedCategories"
                            />
                        </td>
                        <td @click="editCategory(category.id)">{{ category.name }}</td>
                        <td @click="editCategory(category.id)">{{ category.parent_category }}</td>
                        <td @click="editCategory(category.id)">{{ category.status }}</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import useCategories from "../../composables/categories";
import { onMounted, ref } from "vue";
import router from "../../router";
export default {

    setup() {
        const selectedCategories = ref([])
        const { categories, getCategories, destroyCategories } = useCategories();

        onMounted(getCategories);

        const editCategory = (id) => {
            return router.push({ name: 'categories.edit', params: { id: id} })
        }
        const deleteCategories = async (ids) => {
            await destroyCategories(ids)
            await getCategories()
        }

        return { 
            categories,
            selectedCategories,
            deleteCategories,
            editCategory
        };
    }
};
</script>
