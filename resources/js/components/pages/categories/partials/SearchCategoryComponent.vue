<template>
    <div>
        <form
            class="form form-inline input-group mb-3"
            @submit.prevent="search"
        >
            <input type="text" v-model="filter" class="form-control" placeholder="Search..." />
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" @click="handleSearch">
                    Search
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data () {
        return {
            filter: ''
        }
    },
    methods: {
        search() {
            this.$emit('searchCategory', this.filter);
        },
    },
};
</script>

<style scoped></style>
