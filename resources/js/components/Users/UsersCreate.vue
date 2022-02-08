<template>
    <form @submit.prevent="saveUser">
        <div class="mb-3">
            <label for="user_name" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control"
                id="user_name"
                v-model="form.name"
            />
        </div>
        <div class="mb-3">
            <label for="user_category" class="form-label">Email</label>
            <input
                type="email"
                class="form-control"
                id="user_category"
                v-model="form.email"
            />
        </div>
        <div class="mb-3">
            <label for="user_password" class="form-label">Senha</label>
            <input
                type="password"
                class="form-control"
                id="user_password"
                v-model="form.password"
            />
        </div>

        <div class="mb-3">
            <label for="user_confirm_password" class="form-label"
                >Confirme a senha</label
            >
            <input
                type="password"
                class="form-control"
                id="user_confirm_password"
                v-model="form.password_confirmation"
            />
        </div>

        <div class="mb-3">
            <label for="user_cpf" class="form-label">CPF</label>
            <input
                type="text"
                class="form-control"
                id="user_cpf"
                v-model="form.cpf"
            />
        </div>

        <div class="mb-3">
            <label for="user_role" class="form-label">Cargo</label>
            <select class="form-select" id="user_role" v-model="form.role">
                <option value="0">Selecione o cargo</option>
                <option value="A">Administrador</option>
                <option value="U">Usuário</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="user_status" class="form-label">Status</label>
            <select class="form-select" id="user_status" v-model="form.status">
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
import { reactive } from "vue";
import userUsers from "../../composables/users";

export default {
    setup() {
        const form = reactive({
            name: "",
            email: "",
            status: "0",
            cpf: "",
            role: "0",
        });

        const { errors, storeUser } = userUsers();

        const saveUser = async () => {
            await storeUser({ ...form });
        };
        return {
            form,
            errors,
            saveUser,
        };
    },
};
</script>
