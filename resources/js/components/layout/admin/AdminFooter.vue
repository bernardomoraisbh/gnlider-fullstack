<template>
    <v-footer app>
        <v-row justify="center" no-gutters>
            <v-col class="text-center">
                <span>&copy; {{ new Date().getFullYear() }} Admin Dashboard</span>
            </v-col>
        </v-row>
    </v-footer>
</template>

<script setup>

</script>

<style scoped>
.v-footer {
    background-color: rgba(0, 0, 0, 0.1);
}
</style>
