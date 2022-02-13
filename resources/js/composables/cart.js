import { ref } from "vue";
import axios from "axios";

import { useRouter } from "vue-router";

export default function useCart() {
    const cart = ref([]);
    const router = useRouter();



   // const errors = ref("");
    const addProduct = async (data) => {
        console.log(data)
        try {
            await axios.post("/cart", data);
            //await router.push({ name: "cart" });
        } catch (err) {
            console.log(err);
        }
    };
    const getCart = async () => {
        let response = await axios.get("/cart/list");
        
        cart.value = response.data.data;
        console.log(cart.values)
    };



    return {
        cart,
        addProduct,
        getCart
    };
}