import {createRouter, createWebHashHistory} from "vue-router";
import loginPage from '../components/Pages/Login.vue';
import registerPage from '../components/Pages/Register.vue';
import homePage from '../components/Pages/Home.vue';
import profilePage from '../components/Pages/Profile.vue';
import productPage from '../components/Pages/Products.vue';
import SearchBar from '../components/Pages/Search.vue';
import cartPage from '../components/Pages/Cart.vue';
import checkOut from "../components/Pages/CheckOut.vue";


const routes = [
    {
        name: 'home',
        component: homePage,
        path: "/"
    },
    {
        name: 'login',
        component: loginPage,
        path: "/login"
    },
    {
        name: 'register',
        component: registerPage,
        path: "/register"
    },
    {
        name: 'profile',
        component: profilePage,
        path: "/profile"
    },
    {
        name: 'products',
        component: productPage,
        path: '/products/:slug'
    },
    {
        name: 'search',
        component: SearchBar,
        path: '/search'
    },
    {
        name: 'cart',
        component: cartPage,
        path: '/cart'
    },
    {
        name: 'checkout',
        component: checkOut,
        path: '/checkout'
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router;
