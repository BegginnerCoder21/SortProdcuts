import axios from "axios";
import {ref} from "vue";
import dropdown from "bootstrap/js/src/dropdown.js";

export function useProducts(){

    const products = ref();

    const orderBy = ref(null);
    const direction = ref('desc');
    const toggleDirection = () => direction.value = direction.value == 'asc' ? 'desc' : 'asc';
    const getProducts = async () => {
        let { data } = await axios.get('api/products',{
            params : {
                orderBy : orderBy.value,
                direction : direction.value
            }
        });

        products.value = data.products;
    }

    const orderByProduct = async (criteria) => {
        orderBy.value = criteria;
        toggleDirection();

        await getProducts();
    }
    return {
        products,
        getProducts,
        orderByProduct,
        orderBy
    }
}
