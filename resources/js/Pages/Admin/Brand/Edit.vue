<template>
    <v-form>
        <v-row align="start" justify="space-between" class="mb-4">
            <v-spacer></v-spacer>
            <!-- Create Button -->
            <v-col cols="auto" align-self="end">
                <v-btn color="primary" @click="createBrandAction" prepend-icon="mdi-plus" :text="text.saveButton" block />
            </v-col>
        </v-row>
    </v-form>

    <v-row align="start" justify="space-between" class="mb-4">
        <v-col cols="12">
            <v-card>
                <v-card-item>
                    {{ text.brandDetails }}
                </v-card-item>
                <v-card-text id="user-data-form">
                    <v-form>
                        <v-row justify="space-between">
                            <v-col cols="12" md="2">
                                <v-text-field v-model="formData.firstChar"
                                    :error-messages="formData.errors.firstChar" :label="text.firstChar" disabled/>
                            </v-col>
                            <v-col cols="12" md="10">
                                <v-text-field v-model="formData.name" :error-messages="formData.errors.name"
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

type Brand = {
    id: number;
    name: string;
    firstChar: string;
};

const props = defineProps<{ brand: Brand }>()

const text = {
    header: 'Marcas:',
    saveButton: 'SALVAR',
    submit: "Salvar",
    name: "Nome",
    firstChar: "Primeira Letra",
    nameRequired: "O nome é obrigatório",
    brandDetails: "Dados da Marca"
}

const formData = useForm({
    ...props.brand
})

// Methods
const createBrandAction = () => {
    formData.post(route('admin.brand.update'));
};
</script>

<style>
</style>
