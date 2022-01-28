import { ref } from "vue";
import axios from "axios";

import { useRouter } from "vue-router";

export default function useUsers() {
    const users = ref([]);
    const router = useRouter();
    const user = ref([]);


    const errors = ref("");
    const getUsers = async () => {
        let response = await axios.get("/api/users");
        users.value = response.data.data;
    };

    const getUser = async (id) => {
        let response = await axios.get(`/api/users/${id}`);
        user.value = response.data.data;
        console.log(user.value)
    };


    const storeUser = async (data) => {
        try {
            await axios.post("/api/users/", data);
            await router.push({ name: "users.index" });
        } catch (err) {
            console.log(err);
        }
    };

    const updateUser = async (id) => {
        try {
            await axios.put("/api/users/"+id, user.value);
            await router.push({ name: "users.index" });
        } catch (err) {
            console.log(err);
        }
    };
    const destroyUsers = async (ids) => {
        try {
            await axios.delete(`/api/users/deleteMultiple`,  {ids: ids})
        } catch(err) {
            console.log(err);
        }
    }

    return {
        users,
        user,
        errors,
        getUsers,
        getUser,
        storeUser,
        updateUser,
        destroyUsers
    };
}
