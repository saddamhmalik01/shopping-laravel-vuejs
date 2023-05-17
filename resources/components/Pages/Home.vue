<template>
    <navigation> </navigation>
    <div class="container container-fluid">
        <div class="bg-primary mt-3">
            <p>Categories</p>
        </div>
        <div class="row">
            <div class="col-xl-2 col-md-4 d-flex col-12 pt-3" style="width: auto;" v-for="catogery in categorie">
                <CategoryBox :category="catogery"> </CategoryBox>
            </div>
        </div>
        <div class="bg-primary mt-5">
            <p> Top Deals</p>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-6 d-flex col-12 pt-3" v-for="product in products">
                <ProductBox :product="product"> </ProductBox>
            </div>
        </div>
    </div>
</template>

<script>
import navigation from "../Pages/Landing.vue";
import ProductBox from "../Pages/ProductBox.vue";
import CategoryBox from "../Pages/CategoryBox.vue";

import axios from "axios";
export default {
    'name': "home",
    components: {
        navigation, ProductBox, CategoryBox
    },
    data() {
        return {
            'products': [],
            'categorie': []
        }
    },
    beforeMount() {
        this.topDeals();
        this.categories();
    },
    methods: {
        async topDeals() {
            let baseurl = window.location.origin;
            let res = await axios.get(baseurl + '/api/topdeals');
            if (res.status == 200) {
                this.products = res.data.data;
            }

        },

        async categories() {
            let baseurl = window.location.origin;
            let res = await axios.get(baseurl + '/api/categories');
            if (res.status == 200) {
                this.categorie = res.data.data;
            }

        }
    }
}
</script>
<style>

</style>
