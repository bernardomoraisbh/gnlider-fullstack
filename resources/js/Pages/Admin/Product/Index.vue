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
                <v-btn color="primary" @click="createItem" prepend-icon="mdi-plus" :text="textBr.createButton" block />
            </v-col>
        </v-row>
    </v-form>

    <!-- Data Table -->
    <v-data-table-server :headers="headers" :items="products?.data" :items-length="products?.total" :items-per-page="pagination.itemsPerPage"
        :footer-props="{ showFirstLastPage: true }" class="elevation-1" :no-data-text="textBr.noDataText"
        @update:options="loadProducts" :loading="loading">
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

defineProps({
    products: Object,
    filters: Object,
})

defineOptions({
    layout: AdminLayout
})

const textBr = {
    header: 'Produtos:',
    createButton: 'CADASTRAR',
    searchPlaceholder: 'Pesquisar',
    noDataText: 'Nenhum item localizado, tente um filtro diferente.',
    columnHeaderName: "Nome",
    columnHeaderDescription: "Descrição",
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
});

// Table headers
const headers = [
    { title: 'ID', key: 'id' },
    { title: textBr.columnHeaderName, key: 'name' },
    { title: textBr.columnHeaderDescription, key: 'description' },
    { title: textBr.columnHeaderActions, key: 'actions', sortable: false },
];

const loadProducts = (options) => {
    loading.value = true;
    pagination.value.page = options.page;
    pagination.value.itemsPerPage = options.itemsPerPage;

    router.get(route('admin.product.index'),
        {
            page: pagination.value.page,
            itemsPerPage: pagination.value.itemsPerPage
        },
        {
            preserveScroll: true,
            preserveState: true,
            onSuccess: (page) => {
                props.products.value = page.props.products;
                loading.value = false;
            }
        }
    );
};

// Methods
const createItem = () => {
    router.visit(route(`admin.product.create`));
};

const editItem = (product) => {
    router.visit(route(`admin.product.edit`, { product: product.id }));
};

const deleteItem = (product) => {
    console.log('Delete Product:', product);
};

function clear() {
    filterForm.name = null;
}
</script>
