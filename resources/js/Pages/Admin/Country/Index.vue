<template>
    <v-form>
        <v-row align="start" justify="space-between" class="mb-4">
            <!-- Search Input -->
            <v-col cols="12" md="8">
                <v-text-field v-model="filterForm.name" :label="textBr.searchPlaceholder" variant="outlined"
                    prepend-inner-icon="mdi-magnify" density="compact" clearable />
            </v-col>

            <!-- Create Button -->
            <v-col cols="auto">
                <v-btn color="primary" @click="createCountry" prepend-icon="mdi-plus" :text="textBr.createButton" block />
            </v-col>
        </v-row>
    </v-form>

    <!-- Data Table -->
    <v-data-table-server :headers="headers" :items="countries?.data" :items-length="countries?.total" :items-per-page="pagination.itemsPerPage"
        :footer-props="{ showFirstLastPage: true }" class="elevation-1" :no-data-text="textBr.noDataText"
        @update:options="loadCountries" :loading="loading">
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
    </v-data-table-server>
</template>
<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ref, computed } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import { route } from "ziggy";

const props = defineProps({
    countries: Object,
    filters: Object,
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

const loading = ref(false);
const pagination = ref({
    page: 1,
    itemsPerPage: 10
});


// Search query
const filterForm = useForm({
    name: props.filters.name ?? null,
    code: props.filters.code ?? null,
});

// Table headers
const headers = [
    { title: 'ID', key: 'id' },
    { title: textBr.columnHeaderName, key: 'name' },
    { title: textBr.columnHeaderAlpha2, key: 'alpha2Code' },
    { title: textBr.columnHeaderAlpha3, key: 'alpha3Code' },
    { title: textBr.columnHeaderActions, key: 'actions', sortable: false },
];

const loadCountries = (options) => {
    loading.value = true;
    pagination.value.page = options.page;
    pagination.value.itemsPerPage = options.itemsPerPage;

    router.get(route('admin.country.index'),
        {
            page: pagination.value.page,
            itemsPerPage: pagination.value.itemsPerPage
        },
        {
            preserveScroll: true,
            preserveState: true,
            onSuccess: (page) => {
                props.countries.value = page.props.countries;
                loading.value = false;
            }
        }
    );
};

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

function clear() {
    filterForm.name = null;
    filterForm.code = null;
}
</script>
