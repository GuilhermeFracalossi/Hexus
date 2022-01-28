<template>
    <div>
        <div>
            <button
                class="btn btn-primary" @click="$router.push({ name: 'users.create' })">
                Incluir
            </button>
            <button class="btn btn-danger" @click="deleteUsers(selectedUsers)">Excluir</button>

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
                <template v-for:="user in users">
                    <tr >
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
import { onMounted, ref } from "vue";
import router from "../../router";
export default {

    setup() {
        const selectedUsers = ref([])
        const { users, getUsers, destroyUsers } = useUsers();

        onMounted(getUsers);

        const editUser = (id) => {
            return router.push({ name: 'users.edit', params: { id: id} })
        }
        const deleteUsers = async (ids) => {
            await destroyUsers(ids)
            await getUsers()
        }

        return { 
            users,
            selectedUsers,
            deleteUsers,
            editUser
        };
    }
};
</script>
