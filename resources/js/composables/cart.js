import { ref } from "vue";
import axios from "axios";

import { useRouter } from "vue-router";

export default function useCart() {

    const router = useRouter();

    const productsCart = ref([]);


   // const errors = ref("");
    const addProduct = async (data) => {

        try {
            await axios.post("/cart", data);
            await router.push({ name: "cart" });
        } catch (err) {
            console.log(err);
        }
    };
    const getCart = async () => {
        let response = await axios.get("/cart/list");
        
        if (response.data.length == 0) {
            response.data = [0]
        }
        let products = await axios.get("/api/products", {params: {ids: Object.keys(response.data)}});

        products.data.data.forEach(product => {
            product['quantity'] = response.data[product.id]
        })
      
        productsCart.value = products.data.data;
       
       
    };

    const updateItem = async (product) => {
        await axios.put("/cart/"+ product.id, product );
    }

    const removeProduct = async (id) => {
        await axios.delete("/cart/"+ id);
    }

    const emptyCart = async () => {
        await axios.delete("/cart/all");
    }



    return {
        productsCart,
        addProduct,
        getCart,
        updateItem,
        removeProduct,
        emptyCart
    };
}