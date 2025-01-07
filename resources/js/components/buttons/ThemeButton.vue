<template>
    <v-btn icon @click="toggleDarkMode">
        <v-icon>{{ isDark ? 'mdi-weather-sunny' : 'mdi-weather-night' }}</v-icon>
    </v-btn>
</template>

<script lang="ts" setup>
import { useTheme } from 'vuetify'
import { computed } from 'vue';
const vTheme = useTheme()
const isDark = computed(() => vTheme.global.name.value === 'dark')
function toggleDarkMode() {
    vTheme.global.name.value = vTheme.global.name.value === 'light' ? 'dark' : 'light';
}
</script>
