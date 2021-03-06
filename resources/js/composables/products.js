import { ref } from "vue";
import axios from "axios";

import { useRouter } from "vue-router";

export default function useProducts() {
    const products = ref([]);
    const router = useRouter();
    const product = ref([]);
    const productsListing = ref([]);


    const errors = ref("");
    const getProducts = async () => {
        let response = await axios.get("/api/products");
        products.value = response.data.data;
    };

    const getProduct = async (id) => {

        let response = await axios.get(`/api/products/${id}`);
        product.value = response.data.data;
    };

    const getActiveProducts = async (random = false, category = null, search = null) => {
        let variable = '';
        if (category != null) {
            variable += '&category='+category
        }
        if (search != null) {
            variable += '&search='+search
        }
        let response = await axios.get("/api/products?random="+random+"&status=A"+ variable);
        products.value = response.data;
    };

    const getProductsForListing = async(search) => {
        let response =  await axios.get('/api/products')
        let data = {};
        response.data.data.forEach(element => {
            if (!search) {
                data[element.id] = element
                return;
            }
            
            if (element.name.toLowerCase().search(search.toLowerCase()) !== -1) {
                data[element.id] = element

            }
        });
        productsListing.value = data
    }

    const storeProduct = async (data) => {
        try {
            await axios.post("/api/products/", data);
            await router.push({ name: "products.index" });
        } catch (err) {
            console.log(err);
        }
    };

    const updateProduct = async (id, data) => {

        try {

            await axios.put("/api/products/"+id, data);
            await router.push({ name: "products.index" });
        } catch (err) {
            console.log(err);
        }
    };
    const destroyProducts = async (ids) => {
        try {
            await axios.delete('/api/products/delete',   {data: {ids: Array.from(ids)}} )
        } catch (err) {
            console.log(err)
        }
    }

    return {
        products,
        product,
        productsListing,
        errors,
        getProducts,
        getProduct,
        getProductsForListing,
        getActiveProducts,
        storeProduct,
        updateProduct,
        destroyProducts
    };
}
