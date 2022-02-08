<template>
    <form @submit.prevent="saveUser">
        <input type="hidden" id="user_id" v-model="user.id">
        <div class="mb-3">
            <label for="user_name" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control"
                id="user_name"
                v-model="user.name"
            />
        </div>
        <div class="mb-3">
            <label for="user_category" class="form-label">Email</label>
            <input
                type="email"
                class="form-control"
                id="user_category"
                v-model="user.email"
            />
        </div>

        <div class="mb-3">
            <label for="user_cpf" class="form-label">CPF</label>
            <input
                type="text"
                class="form-control"
                id="user_cpf"
                v-model="user.cpf"
            />
        </div>

        <div class="mb-3">
            <label for="user_role" class="form-label">Cargo</label>
            <select class="form-select" id="user_role" v-model="user.role">
                <option selected>Selecione o cargo</option>
                <option value="A">Administrador</option>
                <option value="U">Usuário</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="user_status" class="form-label">Status</label>
            <select class="form-select" id="user_status" v-model="user.status">
                <option value="0">Selecione status</option>
                <option value="A">Ativo</option>
                <option value="I">Inativo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" @click="$router.push({name: 'users.index'})">Cancelar</button>
    </form>
</template>

<script>
import useUsers from "../../composables/users";
import { onMounted } from "vue";
export default {
    props: {
        id: {
            required: true,
            type: String,
        },
    },
    setup(props) {
        const { user, getUser, updateUser } = useUsers();

        onMounted(getUser(props.id));
        const saveUser = async () => {
            await updateUser(props.id);
        };

        return {
            user,
            saveUser,
        };
    },
};
</script>
