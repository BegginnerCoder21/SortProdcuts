import axios from "axios";
import {ref} from "vue";

export function useProducts(){

    const products = ref();
    const getProducts = async () => {
        let { data } = await axios.get('api/products');

        products.value = data.products;
    }
    return {
        products,
        getProducts
    }
}
