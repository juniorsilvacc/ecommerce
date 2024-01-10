<template>
    <preloader/>
    <router-view/>
</template>

<script>
    import preloader from './components/common/PreloaderComponent.vue';

    export default {
        components: {
            preloader
        }
    }
</script>
