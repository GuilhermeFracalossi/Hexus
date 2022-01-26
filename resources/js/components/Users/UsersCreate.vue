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
            <label for="user_cpf" class="form-label">CPF</label>
            <input
                type="text"
                class="form-control"
                id="user_cpf"
                v-model="form.cpf"
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
                v-model="form.confirmPassword"
            />
        </div>
        <div class="mb-3">
            <label for="user_cargo" class="form-label">Cargo</label>
            <select class="form-select" id="user_status" v-model="form.cargo">
                <option selected>Selecione o cargo</option>
                <option value="A">Ativo</option>
                <option value="I">Inativo</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="user_status" class="form-label">Status</label>
            <select class="form-select" id="user_status" v-model="form.status">
                <option selected>Selecione status</option>
                <option value="A">Ativo</option>
                <option value="I">Inativo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="product_description" class="form-label">Descrição</label>
            <textarea
                class="form-control"
                id="product_description"
                rows="3"
                v-model="form.description"
            ></textarea>
        </div>
        <div class="mb-3">
            <label for="product_info" class="form-label">Informações</label>
            <textarea
                class="form-control"
                id="product_info"
                rows="6"
                v-model="form.information"
            ></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
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
            password: "",
            confirmPassword: "",
            status: "",
            cpf: "",
            role: "",
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
