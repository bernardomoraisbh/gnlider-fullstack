<template>
    <v-app>
        <ExternalHeader />
        <v-main>
            <Link href="/">Main Page</Link>
            <br>
            <Link href="/show">Show Page</Link>
            <br>
            {{ timer }}
            <br>
            <slot />
        </v-main>
        <ExternalFooter />
    </v-app>
</template>

<script setup>
import ExternalFooter from '@/components/layout/ExternalFooter.vue';
import ExternalHeader from '@/components/layout/ExternalHeader.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
const timer = ref(0)
setInterval(() => timer.value++, 1000);
</script>

<style></style>
