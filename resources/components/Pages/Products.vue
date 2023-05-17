<template>
    <navigation> </navigation>
    <div class="container container-fluid">
        <div class="row">
            <div class="bg-primary mt-3 text-ceter">
                <h3 class="pt-2 pb-2">{{ products.category }}</h3>
            </div>
            <div class="col-xl-4 col-md-6 d-flex col-12 pt-3" v-for="product in products.data">
                <ProductBox :product="product"> </ProductBox>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios';
import navigation from '../Pages/Landing.vue';
import ProductBox from '../Pages/ProductBox.vue';


export default {
    name: 'AllProducts',
    data() {
        return {
            'name': this.$route.params.slug,
            'products': []
        }
    },
    components: {
        navigation, ProductBox
    },
    async mounted() {
        let baseurl = window.location.origin;
        let res = await axios.get(baseurl + '/api/products/category/' + this.name);
        this.products = res.data.data;
    }
}
</script>
