import { ref } from "vue";
import axios from "axios";

import { useRouter } from "vue-router";

export default function useUsers() {
    const users = ref([]);
    const router = useRouter();
    const user = ref([]);
    const usersListing = ref([]);

    const errors = ref("");


    const getUser = async (id) => {
        let response = await axios.get(`/api/users/${id}`);
        user.value = response.data.data;
        console.log(user.value);
    };

    const getUsersForListing = async (search) => {
        let response = await axios.get("/api/users");
        let data = {};
        response.data.data.forEach((element) => {
            if (!search) {
                data[element.id] = element;
                return;
            }
            if (
                element.name.toLowerCase().search(search.toLowerCase()) !==
                    -1 ||
                element.cpf.toLowerCase().search(search.toLowerCase()) !== -1
            ) {
                data[element.id] = element;
            }
        });
        usersListing.value = data;

    };

    const storeUser = async (data) => {
        console.log(data)
        try {
            await axios.post("/api/users/", data);
            await router.push({ name: "users.index" });
        } catch (err) {
            console.log(err);
        }
    };

    const updateUser = async (id) => {
        try {
            await axios.put("/api/users/" + id, user.value);
            await router.push({ name: "users.index" });
        } catch (err) {
            console.log(err);
        }
    };
    const destroyUsers = async (ids) => {
        try {
            await axios.delete(`/api/users/delete`, {data: { ids: Array.from(ids) }});
        } catch (err) {
            console.log(err);
        }
    };

    return {
        users,
        user,
        usersListing,
        errors,
        getUsersForListing,
        getUser,
        storeUser,
        updateUser,
        destroyUsers,
    };
}
