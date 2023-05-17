<template>
    <div class="card text-center" style="width: 18rem">
        <div class="card-body">
            <h5 class="card-title">{{ category.name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">
                <a
                    v-on:click="router(category.name)"
                    class="card-link stretched-link"
                    >{{ category.name }}</a
                >
            </h6>
        </div>
    </div>
</template>

<script>
import router from "../../vue_routes/routes";

export default {
    name: "CategoryBox",
    props: ["category"],
    methods: {
        router(name) {
            this.$router.push("/products/category=" + name);
        },
    },
};
</script>

<style scoped>
.card {
    width: 200px;
    height: 100px;
}
</style>
