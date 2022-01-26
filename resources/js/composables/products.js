import { ref } from "vue";
import axios from "axios";

import { useRouter } from "vue-router";

export default function useProducts() {
    const products = ref([]);
    const router = useRouter();
    const product = ref([]);


    const errors = ref("");
    const getProducts = async () => {
        let response = await axios.get("/api/products");
        products.value = response.data.data;
    };

    const getProduct = async (id) => {
        let response = await axios.get(`/api/products/${id}`);
        product.value = response.data.data;
    };


    const storeProduct = async (data) => {
        try {
            await axios.post("/api/products/", data);
            await router.push({ name: "products.index" });
        } catch (err) {
            console.log(err);
        }
    };

    const updateProduct = async (id) => {
        try {
            console.log(product.value)
            await axios.put("/api/products/"+id, product.value);
            await router.push({ name: "products.index" });
        } catch (err) {
            console.log(err);
        }
    };
    const destroyProducts = async (ids) => {
        await axios.delete(`/api/products/deleteMultiple`,  {ids: ids})
    }

    return {
        products,
        product,
        errors,
        getProducts,
        getProduct,
        storeProduct,
        updateProduct,
        destroyProducts
    };
}
