<template>
    <v-form>
        <v-row align="start" justify="space-between" class="mb-4">
            <!-- Search Input -->
            <v-col cols="12">
                <v-text-field v-model="searchQuery" :label="textBr.searchPlaceholder" variant="outlined"
                    prepend-inner-icon="mdi-magnify" density="compact" clearable />
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
            <v-btn icon="mdi-pencil" color="primary" variant="plain" @click="editUser(item)" />
            <v-btn icon="mdi-delete" color="error" variant="plain" @click="deleteUser(item)" />
        </template>
    </v-data-table>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import { route } from "ziggy";

const props = defineProps({
    users: Array
})

defineOptions({ layout: AdminLayout })

const textBr = {
    header: 'Usuários:',
    createButton: 'CADASTRAR',
    searchPlaceholder: 'Pesquisar',
    noDataText: 'Nenhum item localizado, tente um filtro diferente.',
    columnHeaderName: "Nome",
    columnHeaderCpfCnpj: "CPF/CNPJ",
    columnHeaderEmail: "Email",
    columnHeaderEnabledUser: "Usuário Habilitado",
    columnHeaderAdmin: "Administrador",
    columnHeaderActions: "Ações",
}

// Sample data
const items = ref([{ id: 1, name: 'Item 1', description: 'Descricao Item 1' },]);

// Search query
const searchQuery = ref('');

// Table headers
const headers = [
    { title: 'ID', key: 'id' },
    { title: textBr.columnHeaderName, key: 'name', value: item => `${item.name} ${item.surName}` },
    { title: textBr.columnHeaderCpfCnpj, key: 'cpf', value: item => `${item.cpf ?? item.cnpj}`, sortable: false },
    { title: textBr.columnHeaderEmail, key: 'email', sortable: false },
    { title: textBr.columnHeaderEnabledUser, key: 'enableUserLogin' },
    { title: textBr.columnHeaderAdmin, key: 'administrator' },
    { title: textBr.columnHeaderActions, key: 'actions', sortable: false },
];

// Computed: Filtered items based on search query
const filteredItems = computed(() => {
    console.log(props.users);
    if (!searchQuery.value) return props.users;
    return props.users.filter((item) =>
        Object.values(item)
            .join(' ')
            .toLowerCase()
            .includes(searchQuery.value.toLowerCase())
    );
});

const editUser = (user) => {
    router.visit(route(`admin.user.edit`, { user: user.id }));
};

const deleteUser = (item) => {
    console.log('Delete User:', item);
};
</script>
