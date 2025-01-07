<template>
    <v-navigation-drawer v-model="drawer" permanent :rail="rail" @click="rail = false">
        <v-list>
            <v-list-item prepend-avatar="https://randomuser.me/api/portraits/men/85.jpg" :title="user.name"
            :subtitle="user.email" nav>
                <template v-slot:append>
                    <v-btn icon="mdi-chevron-left" variant="text" @click.stop="rail = !rail"></v-btn>
                </template>
            </v-list-item>

            <v-divider></v-divider>

            <v-list-item v-for="item in menuItems" :key="item.title" :title="item.title" :prepend-icon="item.icon" link
                @click="navigateTo(item.route)"></v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { route } from "ziggy";

// Sidebar state
const drawer = defineModel('drawer', { default: true, required: true, type: Boolean });

const rail = ref(true);

// User Data
const user = {
    name: 'John Doe',
    email: 'john.doe@example.com',
};

// Sidebar menu items
const menuItems = [
    { title: 'Usuários', icon: 'mdi-account-search', route: 'admin.user.index' },
    { title: 'Marcas', icon: 'mdi-view-dashboard', route: 'admin.brand.index' },
    { title: 'Países', icon: 'mdi-account-group', route: 'admin.country.index' },
    { title: 'Produtos', icon: 'mdi-cog', route: 'admin.product.index' },
    { title: 'Sexo', icon: 'mdi-cog', route: 'admin.sex.index' },
];

// Navigation Handlers
const navigateTo = (routeName) => {
    console.log(Ziggy.routes);
    router.visit(route(routeName));
};
</script>
