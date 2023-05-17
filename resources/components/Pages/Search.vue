<template>
    <navigation> </navigation>
    <div class="container mt-5">
        <div class="container-fluid">
            <div>
                <fieldset>
                    <legend>&nbsp;&nbsp;Search</legend>
                    <form class="d-flex px-2 py-2">
                        <input
                            class="form-control me-2"
                            type="search"
                            @input="searchProducts()"
                            v-model="search"
                            placeholder="Search here"
                            aria-label="Search"
                        />
                    </form>
                    <div class="row d-flex mt-2 px-2 py-2">
                        <div class="col-6">
                            <label class="label">SortBy :</label>
                            <select
                                @change="searchProducts(true)"
                                class="form-select"
                                style="width: 200px"
                                aria-label="Default select example"
                                v-model="orderBy"
                            >
                                <option value="Low to High">
                                    Price --Low to High
                                </option>
                                <option value="High to Low">
                                    Price -- High to Low
                                </option>
                                <option value="Relevance" selected>
                                    Relevance
                                </option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="label">Filter By : </label>
                            <select
                                class="form-select"
                                style="width: 200px"
                                aria-label="Default select example"
                            >
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="row">
                <div
                    class="col-xl-4 col-md-6 d-flex col-12 pt-3"
                    v-for="product in products"
                >
                    <ProductBox :product="product"> </ProductBox>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import navigation from "../Pages/Landing.vue";
import ProductBox from "./ProductBox.vue";

export default {
    data() {
        return {
            products: [],
            search: "",
            orderBy: "Relevance",
            page: 1,
            lastPage: 0,
            isSearch: true,
        };
    },
    components: {
        navigation,
        ProductBox,
    },
    beforeMount() {
        this.searchProducts(true);
    },
    mounted() {
        window.addEventListener("scroll", () => {
            let scrollHeight = document.documentElement.scrollHeight;
            let scrollTop = document.documentElement.scrollTop;
            let clientHeight = document.documentElement.clientHeight;
            if (scrollTop + clientHeight < scrollHeight - 1) {
                if (this.page <= this.lastPage) {
                    this.page++;
                    this.isSearch = false;
                    this.searchProducts(false);
                }
            }
        });
    },
    methods: {
        searchProducts(isSearch) {
            let baseurl = window.location.origin;
            axios
                .post(baseurl + "/api/search?page=" + this.page, {
                    search: this.search,
                    orderby: this.orderBy,
                })
                .then((response) => {
                    if (this.isSearch) {
                        this.page = 1;
                        this.products = response.data.data.data;
                        this.lastPage = response.data.data.last_page;
                    } else {
                        this.products.push(...response.data.data.data);
                        this.lastPage = response.data.data.last_page;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style>
legend {
    background-color: gray;
    color: white;
    padding: 5px 10px;
}
fieldset {
    background-color: #eeeeee;
}

input {
    margin: 5px;
    height: 50px;
}
</style>
