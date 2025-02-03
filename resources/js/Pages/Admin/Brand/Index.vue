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
                <v-btn color="primary" @click="createBrand" prepend-icon="mdi-plus" :text="textBr.createButton" block />
            </v-col>
        </v-row>
    </v-form>

    <!-- Data Table -->
    <v-data-table-server :headers="headers" :items="brands?.data" :items-length="brands?.total" :items-per-page="pagination.itemsPerPage"
        :footer-props="{ showFirstLastPage: true }" class="elevation-1" :no-data-text="textBr.noDataText"
        @update:options="loadBrands" :loading="loading">
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>{{ textBr.header }}</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
        </template>

        <!-- Actions Column -->
        <template v-slot:[`item.actions`]="{ item }">
            <v-btn icon="mdi-pencil" color="primary" variant="plain" @click="editBrand(item)" />
            <v-btn icon="mdi-delete" color="error" variant="plain" @click="deleteBrand(item)" />
        </template>
    </v-data-table-server>
</template>
<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import { route } from "ziggy";

const props = defineProps({
    brands: Object
})

defineOptions({
    layout: AdminLayout
})

const textBr = {
    header: 'Marcas:',
    createButton: 'CADASTRAR',
    searchPlaceholder: 'Pesquisar',
    noDataText: 'Nenhum item localizado, tente um filtro diferente.',
    columnHeaderName: "Nome",
    columnHeaderActions: "Ações",
}

const loading = ref(false);
const pagination = ref({
    page: 1,
    itemsPerPage: 10
});

// Search query
const searchQuery = ref('');

// Table headers
const headers = [
    { title: 'ID', key: 'id' },
    { title: textBr.columnHeaderName, key: 'name' },
    { title: textBr.columnHeaderActions, key: 'actions', sortable: false },
];

// Computed: Filtered items based on search query
const filteredItems = computed(() => {
    console.log(props?.brands);
    if (!searchQuery.value) return props.brands?.data;
    return props.brands?.data.filter((item) =>
        Object.values(item)
            .join(' ')
            .toLowerCase()
            .includes(searchQuery.value.toLowerCase())
    );
});

const loadBrands = (options) => {
    loading.value = true;
    pagination.value.page = options.page;
    pagination.value.itemsPerPage = options.itemsPerPage;

    router.get(route('admin.brand.index'),
        {
            page: pagination.value.page,
            itemsPerPage: pagination.value.itemsPerPage
        },
        {
            preserveScroll: true,
            preserveState: true,
            onSuccess: (page) => {
                props.brands.value = page.props.brands;
                loading.value = false;
            }
        }
    );
};
// Methods
const createBrand = () => {
    router.visit(route(`admin.brand.create`));
};

const editBrand = (brand) => {
    router.visit(route(`admin.brand.edit`, { brand: brand.id }));
};

const deleteBrand = (brand) => {
    console.log('Delete Brand:', brand);
};
</script>
