<template>
    <v-form>
        <v-row align="start" justify="space-between" class="mb-4">
            <v-spacer></v-spacer>
            <!-- Create Button -->
            <v-col cols="auto" align-self="end">
                <v-btn color="primary" @click="createProductAction"
                    prepend-icon="mdi-plus" :text="text.createButton" block />
            </v-col>
        </v-row>
    </v-form>

    <v-row align="start" justify="space-between" class="mb-4">
        <v-col cols="12">
            <v-card>
                <v-card-item>
                    {{ text.productDetails }}
                </v-card-item>
                <v-card-text id="product-data-form">
                    <v-form>
                        <v-row justify="space-between">
                            <v-col cols="12" md="10">
                                <v-text-field v-model="formData.name"
                                    :error-messages="formData.errors.name"
                                    :label="text.name" required />
                            </v-col>
                        </v-row>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</template>

<script lang="ts" setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, useForm } from "@inertiajs/vue3"
import { route } from "ziggy";

defineOptions({ layout: AdminLayout })

type Product = {
    id: number;
    name: string;
    firstChar: string;
};

const text = {
    header: 'Marcas:',
    createButton: 'CADASTRAR',
    submit: "Cadastrar",
    name: "Nome",
    firstChar: "Primeira Letra",
    nameRequired: "O nome é obrigatório",
    productDetails: "Dados do Produto"
}

function createProduct(): Product {
    return {
        id: 0,
        name: '',
        firstChar: '',
    };
}

const formData = useForm({
    ...createProduct(),
})

// Methods
const createProductAction = () => {
    formData.post(route('admin.product.store'));
};
</script>

<style>
</style>
