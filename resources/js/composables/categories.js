import { useRouter } from "vue-router";
import { ref } from "vue";
import axios from "axios";


export default function useCategories () {

    const categories = ref([]);
    const category = ref([]);
    const router = useRouter();

    const errors = ref("");
    const getCategories = async(id) => {
        let response =  await axios.get('/api/categories')
        categories.value = response.data.data;
    }
    const getCategory = async(id) => {
        let response =  await axios.get(`/api/categories/${id}`);
        category.value = response.data.data;
    }

    const storeCategory = async(data) => {
        try {
            await axios.post("/api/categories/", data);
            await router.push({ name: "categories.index" });
        } catch (err) {
            console.log(err);
        }
    }
    const updateCategory = async(id) => {
        try{
            await axios.put('/api/categories/'+id, category.value );
            await router.push({name: 'categories.index'})
        }catch(err){
            console.log(err)
        }
    }

    const destroyCategories = async(ids) => {
        try {
            await axios.delete('/api/categories/'+ {ids: ids})
        } catch(err) {
            console.log(err)
        }
    }
    
    return {
        categories,
        category,
        errors,
        getCategory,
        getCategories,
        storeCategory,
        updateCategory,
        destroyCategories
    }

}