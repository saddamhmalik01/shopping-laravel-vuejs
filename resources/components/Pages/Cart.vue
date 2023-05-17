<template>
    <navigation></navigation>
    <div class="container container-fluid">
        <div class="row">
            <div class="bg-primary mt-3 text-center">
                <h3 class="pt-2 pb-2">My Cart</h3>
            </div>
            <div class="col-xl-4 col-md-6 d-flex col-12 pt-3" v-for="product in cart.item">
                <cartBox :product="product"> </cartBox>
            </div>
            <div >
                <button v-on:click="checkout()" class="btn btn-outline-success"> {{ cart.total }} </button>
            </div>
        </div>
    </div>
</template>

<script>
import cartBox from "./CartBox.vue";
import axios from "axios";
import navigation from '../Pages/Landing.vue';

export default {
    name: 'cart',
    data() {
        return {
            'cart': []
        }
    },
    components: {
        cartBox, navigation
    },
    beforeMount() {
        let baseurl = window.location.origin;
        axios
            .get(baseurl + '/api/cart')
            .then((response) => {
                console.log(response.data.data)
                this.cart = response.data.data
            })
            .catch((error) => {
                console.log(error)
            })
    },
    methods : {
        checkout(){
            this.$router.push('/checkout')
        }
    }
}
</script>
