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
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');
@import url('https://pro.fontawesome.com/releases/v5.10.0/css/all.css');

.vue-notification {
  margin-top: 20px;
}

.acctions {
    display: flex;
}

.primary-btn-acction {
    margin-right: 10px;
}

.btn-custom {
    height: 38px; /* Ajuste a altura conforme necessário */
}
</style>
