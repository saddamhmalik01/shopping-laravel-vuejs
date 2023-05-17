<template>
    <navigation> </navigation>
    <section class="vh-200" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Profile</p>

                                    <form class="mx-1 mx-md-4">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">First Name :</label>
                                                <label style="margin-left: 10px;" class="form-label"
                                                    for="form3Example3c">{{ user.first_name }}</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Last Name :</label>
                                                <label style="margin-left: 10px;" class="form-label"
                                                    for="form3Example3c">{{ user.last_name }}</label>

                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Email Name :</label>
                                                <label style="margin-left: 10px;" class="form-label"
                                                    for="form3Example3c">{{ user.email }}</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Member since : </label>
                                                <label style="margin-left: 10px;" class="form-label"
                                                    for="form3Example3c">{{ user.created_at }}</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Addresses: </label>
                                                <div class="callout" v-for="address in addresses" :key="address.id">
                                                    Address : {{ address.address}}<br />
                                                    City : {{ address.city }} <br />
                                                    Country : {{ address.country }} <br />
                                                    Phone : {{ address.phone_number }} <br />
                                                    Pin Code : {{ address.pincode }} <br />
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                        class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import navigation from '../Pages/Landing.vue';
export default {
    name: 'profile',
    components: {
        navigation
    },
    data() {
        return {
            'user': {
                'first_name': '',
                'last_name': '',
                'email': '',
                'created_at': ''
            },
            'addresses': []
        }
    },
    beforeMount() {
        let user = localStorage.getItem('user');
        if (!user) {
            this.$router.push('login')
        }
    },
    mounted() {
        this.loadData()
        this.loadAddress()
    },
    methods: {
        async loadData() {
            let baseurl = window.location.origin;
            let res = await axios.get(baseurl + '/api/user')
            if (res.status == 200) {
                this.user = res.data
            }
        },
        async loadAddress() {
            let baseurl = window.location.origin;
            let res = await axios.get(baseurl + '/api/address')
            console.log(res.data)
            if (res.status == 200) {
                this.addresses = res.data.data
                console.log(this.address)
            }
        }
    }
}
</script>
<style scoped>
.callout {
    border: 1px solid;
    padding: 20px;
    /* --bs-border-radius: aqua; */
    border-radius: 20px;
    border-width: 3px;
    margin-top: 5px;
}
.card {
    width:fit-content;
}
</style>
