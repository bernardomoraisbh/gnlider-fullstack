<template>
    <v-app-bar app color="primary" dark>
        <v-toolbar-title>GN LIDER</v-toolbar-title>
        <v-spacer />
        <v-text-field solo-inverted flat hide-details placeholder="Aperte K e busque aqui" v-if="user"
            prepend-inner-icon="mdi-magnify" class="mx-4" />
        <v-spacer />
        <ThemeButton />
        <UserDropDownMenu v-if="user" />
        <LoginDropDownMenu v-else />
        <v-btn icon v-if="user">
            <v-icon>mdi-cart</v-icon>
        </v-btn>
    </v-app-bar>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import UserDropDownMenu from '../menus/UserDropDownMenu.vue';
import LoginDropDownMenu from '../menus/LoginDropDownMenu.vue';
import { usePage } from '@inertiajs/vue3';
import ThemeButton from '../buttons/ThemeButton.vue';

const page = usePage();
const user = computed(() => page.props?.user)
</script>

<style scoped></style>
