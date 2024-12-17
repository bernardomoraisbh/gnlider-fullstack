<template>
    <v-app>
        <!-- Header -->
        <AdminHeader v-model:drawer="drawer" />
        <!-- Main Content -->
        <!-- Navigation Drawer (Sidebar) -->
        <SideBar v-model:drawer="drawer" />
        <v-main>

            <!-- Page Content -->
            <v-container fluid>
                <slot />
            </v-container>
        </v-main>

        <!-- Footer -->
        <AdminFooter />
    </v-app>
</template>

<script setup>
import AdminFooter from '@/components/layout/admin/AdminFooter.vue';
import AdminHeader from '@/components/layout/admin/AdminHeader.vue';
import SideBar from '@/components/layout/admin/SideBar.vue';

import { ref } from 'vue';

// Sidebar state
const drawer = ref(true);

</script>

<style scoped>
</style>
