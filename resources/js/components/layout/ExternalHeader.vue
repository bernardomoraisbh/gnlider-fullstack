<template>
    <v-app-bar app color="primary" dark>
        <v-toolbar-title>GN LIDER</v-toolbar-title>
        <v-spacer />
        <v-text-field solo-inverted flat hide-details placeholder="Aperte K e busque aqui"
            prepend-inner-icon="mdi-magnify" class="mx-4" />
        <v-spacer />
        <LoginDropDownMenu />
        <v-btn icon>
            <v-icon>mdi-cart</v-icon>
        </v-btn>
    </v-app-bar>
</template>

<script setup lang="ts">
import LoginDropDownMenu from '../menus/LoginDropDownMenu.vue';

</script>

<style scoped></style>
