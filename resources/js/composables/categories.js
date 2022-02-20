import { useRouter } from "vue-router";
import { ref } from "vue";
import axios from "axios";


export default function useCategories () {

    const categories = ref([]);
    const categoriesListing = ref([]);
    const category = ref([]);
    const router = useRouter();

    const errors = ref("");


    const getCategories = async(status = '') => {
        
        let variables = '';
        if (status != "") {
            variables = "?status="+status
        }
        let response =  await axios.get('/api/categories'+variables)
        categories.value = response.data.data;

    }
    const getCategoriesForListing = async(search) => {
        let response =  await axios.get('/api/categories')
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
        categoriesListing.value = data
        
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
            await axios.delete('/api/categories/delete', {data : {ids: Array.from(ids) }})
        } catch(err) {
            console.log(err)
        }
    }
    
    return {
        categories,
        category,
        categoriesListing,
        errors,
        getCategory,
        getCategories,
        getCategoriesForListing,
        storeCategory,
        updateCategory,
        destroyCategories
    }

}