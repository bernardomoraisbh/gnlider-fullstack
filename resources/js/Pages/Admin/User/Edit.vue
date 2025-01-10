<template>
    <v-form>
        <v-row align="start" justify="space-between" class="mb-4">
            <!-- Search Input -->
            <v-col cols="12" md="8">
                <v-text-field v-model="searchQuery" :label="text.searchPlaceholder" variant="outlined"
                    prepend-inner-icon="mdi-magnify" density="compact" clearable />
            </v-col>

            <!-- Create Button -->
            <v-col cols="auto">
                <v-btn color="primary" @click="saveUser" prepend-icon="mdi-plus" :text="text.createButton" block />
            </v-col>
        </v-row>
    </v-form>
</template>
<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ref, computed } from 'vue';

defineProps({
    message: String
})

defineOptions({ layout: AdminLayout })

const text = {
    header: 'Usuários:',
    createButton: 'CADASTRAR',
    searchPlaceholder: 'Pesquisar',
    noDataText: 'Nenhum item localizado, tente um filtro diferente.',
}

// Methods
const saveUser = () => {
    console.log('User Saved');
};
</script>
