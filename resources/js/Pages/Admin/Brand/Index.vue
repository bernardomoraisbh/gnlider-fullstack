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
                <v-btn color="primary" @click="createBrand" prepend-icon="mdi-plus" :text="text.createButton" block />
            </v-col>
        </v-row>
    </v-form>

    <!-- Data Table -->
    <v-data-table :headers="headers" :items="filteredItems" :items-per-page="5"
        :footer-props="{ showFirstLastPage: true }" class="elevation-1" :no-data-text="text.noDataText">
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>{{ text.header }}</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
        </template>

        <!-- Actions Column -->
        <template v-slot:[`item.actions`]="{ item }">
            <v-btn icon="mdi-pencil" color="primary" variant="plain" @click="editBrand(item)" />
            <v-btn icon="mdi-delete" color="error" variant="plain" @click="deleteBrand(item)" />
        </template>
    </v-data-table>
</template>
<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import { route } from "ziggy";

defineProps({
    message: String
})

defineOptions({ layout: AdminLayout })

const text = {
    header: 'Marcas:',
    createButton: 'CADASTRAR',
    searchPlaceholder: 'Pesquisar',
    noDataText: 'Nenhum item localizado, tente um filtro diferente.',
}

// Sample data
const items = ref([{ id: 1, name: 'Item 1', description: 'Descricao Item 1' },]);

// Search query
const searchQuery = ref('');

// Table headers
const headers = [
    { title: 'ID', key: 'id' },
    { title: 'Name', key: 'name' },
    { title: 'Description', key: 'description' },
    { title: 'Actions', key: 'actions', sortable: false },
];

// Computed: Filtered items based on search query
const filteredItems = computed(() => {
    if (!searchQuery.value) return items.value;
    return items.value.filter((item) =>
        Object.values(item)
            .join(' ')
            .toLowerCase()
            .includes(searchQuery.value.toLowerCase())
    );
});

// Methods
const createBrand = () => {
    router.visit(route(`admin.brand.create`, { user: brand.id }));
};

const editBrand = (brand) => {
    router.visit(route(`admin.brand.edit`, { user: brand.id }));
};

const deleteBrand = (brand) => {
    console.log('Delete Brand:', brand);
};
</script>
