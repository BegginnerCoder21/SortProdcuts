<template>
    <div class="my-5">
        <div class="hidden sm:block">
            <nav class="flex space-x-4" aria-label="Tabs">
                <a
                    class="text-gray-500 hover:text-gray-700 rounded-md px-3 py-2 text-sm font-medium cursor-pointer"
                    @click="orderByProduct('name')"
                    :class="{'text-indigo-500' : orderBy == 'name'}"
                >
                    Trier par nom
                </a>

                <a
                    class="text-gray-500 hover:text-gray-700 rounded-md px-3 py-2 text-sm font-medium cursor-pointer"
                    @click="orderByProduct('price')"
                    :class="{'text-indigo-500' : orderBy == 'price'}"

                >
                    Trier par prix
                </a>

                <a
                    class="text-gray-500 hover:text-gray-700 rounded-md px-3 py-2 text-sm font-medium cursor-pointer"
                    @click="orderByProduct('category')"
                    :class="{'text-indigo-500' : orderBy == 'category'}"
                >
                    Trier par catégorie
                </a>
            </nav>

            <product-list :products="products"/>
        </div>
    </div>

</template>

<script setup>

import ProductList from "@/components/Products/ProductList.vue";
import {onMounted, ref} from "vue";
import {useProducts} from "@/composables/products/useProducts.js";

const {
    products,
    getProducts,
    orderByProduct,
    orderBy
} = useProducts();



onMounted(async  () => getProducts());
</script>


