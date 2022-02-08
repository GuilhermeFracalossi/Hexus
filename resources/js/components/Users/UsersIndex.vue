<template>
    <div>
        <div>
            <button
                class="btn btn-primary"
                @click="$router.push({ name: 'users.create' })"
            >
                Incluir
            </button>

            <button class="btn btn-danger" @click="deleteUsers(selectedUsers)">
                Excluir
            </button>
            <input
                type="text"
                class="form-control"
                v-model="search"
                placeholder="Pesquisar usuários (nome ou cpf)"
            />
        </div>

        <table class="table">
            <thead>
                <tr scope="col">
                    <td scope="col"></td>
                    <td scope="col">Nome</td>
                    <td scope="col">CPF</td>
                    <td scope="col">Telefone</td>
                    <td scope="col">Status</td>
                </tr>
            </thead>
            <tbody>
                <template v-for:="user in usersListing">
                    <tr>
                        <td>
                            <input
                                class="form-check-input"
                                type="checkbox"
                                v-bind:value="user.id"
                                v-model="selectedUsers"
                            />
                        </td>
                        <td @click="editUser(user.id)">{{ user.name }}</td>
                        <td @click="editUser(user.id)">{{ user.cpf }}</td>
                        <td @click="editUser(user.id)">{{ user.phone }}</td>
                        <td @click="editUser(user.id)">{{ user.status }}</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import useUsers from "../../composables/users";
import { onMounted, ref, watch } from "vue";
import router from "../../router";
export default {
    setup() {
        const selectedUsers = ref([]);
        const { usersListing, getUsersForListing, destroyUsers } = useUsers();
        const search = ref([]);
        var timer  = undefined;
        onMounted(getUsersForListing);
        
        watch(
            search,
            (newSearch, oldSearch) => {
                console.log(usersListing)
                clearTimeout(timer);

                timer = setTimeout(() => {
                    getUsersForListing(newSearch);
                }, 500);
            },
            {
                flush: "post",
            }
        );
        const editUser = (id) => {
            return router.push({ name: "users.edit", params: { id: id } });
        };
        const deleteUsers = async (ids) => {
            await destroyUsers(ids);
            await getUsersForListing();
        };

        return {
            search,
            usersListing,
            selectedUsers,
            deleteUsers,
            editUser,
        };
    },
};
</script>
