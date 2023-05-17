<template>
    <div class="card" style="width: 18rem;">
        <img :src=product.image_url class="card-img-top" alt="...">
        <div class="card-body text-center">
            <p class="card-text">{{ product.name }}</p>
            <div class="btn-group " style="height: 50px" role="group" aria-label="Basic example">
                <button type="button" v-on:click="subtract()" class="btn btn-secondary">-</button>
                <button type="button" class="btn btn-check">{{product.quantity}}</button>
                <button type="button" v-on:click="add()" class="btn btn-secondary">+</button>
            </div>
            <div class="mt-1">
                <button type="button" v-on:click="removeItem()" class="btn mx-1 btn-outline-danger">Remove</button><br>
                <label>Price : {{ product.price}}</label><br><label>Total : {{product.total}}</label>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'CartBox',
    props: ['product'],
    data() {
        return {
            'quantity' : this.product.quantity,
            'baseUrl' : window.location.origin
        }
    },
    methods : {
        subtract() {
            if(this.product.quantity > 1)
            {
                this.product.quantity--
                this.updateQuantity();
            }

        },
        add(){
            this.product.quantity ++
            this.updateQuantity();
        },
        updateQuantity(){
            axios
                .post(this.baseUrl+'/api/addtocart',{
                    product_id : this.product.id,
                    quantity : this.product.quantity
                })
                .then((response)=> {

                })
                .catch((error)=>{
                    console.log(error)
                })
        },
        removeItem(){
            axios
                .post(this.baseUrl+'/api/removefromcart',{
                    product_id : this.product.id
                })
                .then((response)=>{
                    window.location.reload()
                })
                .catch((error)=>{
                    console.log(error)
                })

        },
    }
}
</script>
