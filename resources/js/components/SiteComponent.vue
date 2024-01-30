<template>
    <div>
        <siteHeader />

        <router-view></router-view>

        <siteFooter />
    </div>
</template>

<script>
import SiteHeaderComponent from "./pages/home/partials/SiteHeaderComponent.vue";
import SiteFooterComponent from "./pages/home/partials/SiteFooterComponent.vue";

export default {
    components: {
        siteHeader: SiteHeaderComponent,
        siteFooter: SiteFooterComponent
    },
};
</script>

<style scoped></style>
