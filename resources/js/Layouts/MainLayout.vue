<template>
    <v-app>
        a
        <ExternalHeader />
        <v-main>
            <!-- <Link href="/listing/create">New List</Link> -->
            <div v-if="flashSuccess" class="">
                {{ flashSuccess }}
            </div>
            <slot />
        </v-main>
        <ExternalFooter />
    </v-app>
</template>

<script setup>
import ExternalFooter from '@/components/layout/ExternalFooter.vue';
import ExternalHeader from '@/components/layout/ExternalHeader.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const page = usePage();

const flashSuccess = computed(() => page.props?.flash?.success);
const user = computed(() => page.props?.user)
</script>

<style scoped>
.success {
    background-color: green;
    color: white;
}
</style>
