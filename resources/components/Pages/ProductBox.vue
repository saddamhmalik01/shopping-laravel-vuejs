<template>
    <div class="card">
        <div class="embed-responsive embed-responsive-16by9">
            <img :src="product.image_url" class="card-img-top" alt="image"/>
        </div>

        <div class="card-body text-center">
            <h6 class="card-title">{{ product.name }}</h6>
            <p class="card-text">₹{{ product.price }} Only</p>
            <button
                v-on:click="AddToCart(product.id)"
                class="btn btn-outline-primary">
                Add to Cart
            </button>
            <button
                v-on:click="BuyNow(product.id)"
                class="btn btn-outline-primary mx-1">
                Buy Now
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "ProductBox",
    props: ["product"],
    data() {
      return {
          'quantity' : 1,

      }
    },
    methods: {
        AddToCart(id) {
            let baseurl = window.location.origin;
            axios
                .post(baseurl+'/api/addtocart', {
                    product_id : id,
                    quantity : this.quantity
                })
                .then((response) => {
                    console.log(response);
                })
        },
        BuyNow(id) {
            console.log("buy now" + id);
        },
    },
};
</script>

<style>
.card-img-top {
    object-fit: cover;
    height: 200px;
    width: 150px;
}

.card {
    width: 300px;
    height: 200px;
}
</style>
