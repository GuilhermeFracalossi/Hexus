import { ref } from "vue";
import axios from "axios";

import { useRouter } from "vue-router";

export default function useOrders() {
    const orders = ref([]);
    const router = useRouter();
    const order = ref([]);


    const errors = ref("");


    const getOrder = async (id) => {
        let response = await axios.get(`/api/orders/${id}`);
        order.value = response.data.data;
    };

    const storeOrder = async (data) => {
        try {
            await axios.post("/api/orders/", data);
            await router.push({ name: "orders.index" });
        } catch (err) {
            console.log(err);
        }
    };

    const updateOrder = async (id) => {
        try {
            await axios.put("/api/orders/" + id, order.value);
            await router.push({ name: "orders.index" });
        } catch (err) {
            console.log(err);
        }
    };
    const destroyOrders = async (ids) => {
        try {
            await axios.delete(`/api/orders/delete`, {data: { ids: Array.from(ids) }});
        } catch (err) {
            console.log(err);
        }
    };

    return {
        orders,
        order,
        errors,
        getOrder,
        storeOrder,
        updateOrder,
        destroyOrders,
    };
}
