<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SaveMart</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"><router-link style="text-decoration:none"
                                to="/search">Search</router-link></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <div class="flex" v-if="user">
                    <router-link to="profile">Profile</router-link>
                </div>
                <div class="flex" v-if="user" style="margin-left: 10px;">
                    <router-link to="/cart">My Cart</router-link>
                </div>
                <div class="flex" v-if="!user" style="margin-left: 10px;">
                    <router-link to="login">Login</router-link>
                </div>
                <div class="flex" style="margin-left: 10px;" v-if="user">
                    <button v-on:click="logout()">Logout</button>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'landing_page',
    data() {
        return {
            'user': false,
            'search': ''
        }
    },
    beforeMount() {
        let data = localStorage.getItem('user');
        if (data) {
            this.user = true;
        }
    },
    methods: {
        logout() {
            localStorage.removeItem('user');
            this.$router.push('/login')
        },
    }

}

</script>

<style>

</style>
