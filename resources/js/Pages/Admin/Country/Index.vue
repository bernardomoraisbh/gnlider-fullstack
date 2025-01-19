<template>
    <v-form>
        <v-row align="start" justify="space-between" class="mb-4">
            <!-- Search Input -->
            <v-col cols="12" md="8">
                <v-text-field v-model="searchQuery" :label="textBr.searchPlaceholder" variant="outlined"
                    prepend-inner-icon="mdi-magnify" density="compact" clearable />
            </v-col>

            <!-- Create Button -->
            <v-col cols="auto">
                <v-btn color="primary" @click="createCountry" prepend-icon="mdi-plus" :text="textBr.createButton" block />
            </v-col>
        </v-row>
    </v-form>

    <!-- Data Table -->
    <v-data-table :headers="headers" :items="filteredItems" :items-per-page="10"
        :footer-props="{ showFirstLastPage: true }" class="elevation-1" :no-data-text="textBr.noDataText">
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>{{ textBr.header }}</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
        </template>

        <!-- Actions Column -->
        <template v-slot:[`item.actions`]="{ item }">
            <v-btn icon="mdi-pencil" color="primary" variant="plain" @click="editItem(item)" />
            <v-btn icon="mdi-delete" color="error" variant="plain" @click="deleteItem(item)" />
        </template>
    </v-data-table>
</template>
<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import { route } from "ziggy";

const props = defineProps({
    countries: Array
})

defineOptions({ layout: AdminLayout })

const textBr = {
    header: 'Países:',
    createButton: 'CADASTRAR',
    searchPlaceholder: 'Pesquisar',
    noDataText: 'Nenhum item localizado, tente um filtro diferente.',
    columnHeaderName: "Nome",
    columnHeaderAlpha2: "Alpha 2",
    columnHeaderAlpha3: "Alpha 3",
    columnHeaderActions: "Ações",
}

// Search query
const searchQuery = ref('');

// Table headers
const headers = [
    { title: 'ID', key: 'id' },
    { title: textBr.columnHeaderName, key: 'name' },
    { title: textBr.columnHeaderAlpha2, key: 'alpha2Code' },
    { title: textBr.columnHeaderAlpha3, key: 'alpha3Code' },
    { title: textBr.columnHeaderActions, key: 'actions', sortable: false },
];

// Computed: Filtered items based on search query
const filteredItems = computed(() => {
    console.log(props.countries);
    if (!searchQuery.value) return props.countries;
    return props.countries.filter((item) =>
        Object.values(item)
            .join(' ')
            .toLowerCase()
            .includes(searchQuery.value.toLowerCase())
    );
});

// Methods
const createCountry = () => {
    router.visit(route(`admin.country.create`));
};

const editItem = (country) => {
    router.visit(route(`admin.country.edit`, { country: country.id }));
};

const deleteItem = (country) => {
    console.log('Delete Brand:', country);
};
</script>
