<template>
    <div>
        <div>
            <button
                class="btn btn-primary"
                @click="$router.push({ name: 'categories.create' })"
            >
                Incluir
            </button>
            <button
                class="btn btn-danger"
                @click="deleteCategories(selectedCategories)"
            >
                Excluir
            </button>

            <input type="text" class="form-control" v-model="search" placeholder="Pesquisar categorias" />
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
                <template v-for:="(category, id) in categoriesListing">
                    <tr>
                        <td>
                            <input
                                class="form-check-input"
                                type="checkbox"
                                v-bind:value="category.id"
                                v-model="selectedCategories"
                            />
                        </td>
                        <td @click="editCategory(id)">{{ category.name }}</td>
                        <td @click="editCategory(id)">
                            {{
                                category.parent_category_id != 0
                                    ? categoriesListing[
                                          category.parent_category_id
                                      ].name
                                    : ""
                            }}
                        </td>
                        <td @click="editCategory(id)">
                            {{ category.status == "A" ? "Ativo" : "Inativo" }}
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import useCategories from "../../composables/categories";
import { onMounted, ref, watch } from "vue";
import router from "../../router";
export default {
    setup() {
        const selectedCategories = ref([]);
        const search = ref([]);
        var timer  = undefined;
        const {
            categoriesListing,
            destroyCategories,
            getCategoriesForListing,
        } = useCategories();

        onMounted(getCategoriesForListing);
        watch(
            search,
            (newSearch, oldSearch) => {
                clearTimeout(timer);

                timer = setTimeout(() => {
                    getCategoriesForListing(newSearch);
                }, 500);
            },
            {
                flush: "post",
            }
        );

        const editCategory = (id) => {
            return router.push({ name: "categories.edit", params: { id: id } });
        };
        const deleteCategories = async (ids) => {
            await destroyCategories(ids);
            await getCategoriesForListing();
        };

        return {
            search,
            categoriesListing,
            selectedCategories,

            deleteCategories,
            editCategory,
        };
    },
   
};
</script>
