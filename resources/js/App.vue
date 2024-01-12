<template>
    <notifications />
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

<style>
.vue-notification {
  margin-top: 20px;
}
</style>
