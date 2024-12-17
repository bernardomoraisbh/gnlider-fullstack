<template>
    <v-app-bar app dark>
        <!-- Sidebar Toggle Button -->
        <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

        <!-- Title -->
        <v-toolbar-title>Área administrativa</v-toolbar-title>

        <v-spacer></v-spacer>

        <!-- Dark Mode Toggle -->
        <v-btn icon @click="toggleDarkMode">
            <v-icon>{{ theme.global.name.value === 'dark' ? 'mdi-weather-sunny' : 'mdi-weather-night' }}</v-icon>
        </v-btn>

        <!-- User Menu -->
        <v-menu>
            <template v-slot:activator="{ props }">
                <v-btn icon v-bind="props">
                    <v-avatar size="36">
                        <img src="https://randomuser.me/api/portraits/men/85.jpg" alt="User" />
                    </v-avatar>
                </v-btn>
            </template>
            <v-list>
                <v-list-item title="Profile" @click="goToProfile"></v-list-item>
                <v-list-item title="Logout" @click="logout"></v-list-item>
            </v-list>
        </v-menu>
    </v-app-bar>
</template>

<script setup>
import { useTheme } from 'vuetify';

const drawer = defineModel('drawer', { default: true, required: true, type: Boolean });

// Vuetify theme handling
const theme = useTheme();

const toggleDarkMode = () => {
    theme.global.name.value = theme.global.name.value === 'light' ? 'dark' : 'light';
};

const goToProfile = () => {
    console.log('Navigate to Profile');
};

const logout = () => {
    console.log('Logging out...');
};
</script>
