<template>
    <v-form>
        <v-row align="start" justify="space-between" class="mb-4">
            <v-spacer></v-spacer>
            <!-- Create Button -->
            <v-col cols="auto" align-self="end">
                <v-btn color="primary" @click="createCountryAction" prepend-icon="mdi-plus" :text="textBr.createButton" block />
            </v-col>
        </v-row>
    </v-form>

    <v-row align="start" justify="space-between" class="mb-4">
        <v-col cols="12">
            <v-card>
                <v-card-item>
                    {{ textBr.countryDetails }}
                </v-card-item>
                <v-card-text id="country-data-form">
                    <v-form>
                        <v-row justify="space-between">
                            <v-col cols="12" md="2">
                                <v-text-field v-model="formData.alpha2Code"
                                    :error-messages="formData.errors.alpha2Code"
                                    :label="textBr.alpha2Code" required />
                            </v-col>
                            <v-col cols="12" md="2">
                                <v-text-field v-model="formData.alpha3Code"
                                    :error-messages="formData.errors.alpha3Code"
                                    :label="textBr.alpha3Code" required />
                            </v-col>
                            <v-col cols="12" md="8">
                                <v-text-field v-model="formData.name"
                                    :error-messages="formData.errors.name"
                                    :label="textBr.name" required />
                            </v-col>
                            <v-col cols="12" md="2">
                                <v-text-field v-model="formData.numericCode"
                                    :error-messages="formData.errors.numericCode"
                                    :label="textBr.numericCode" required />
                            </v-col>
                            <v-col cols="12" md="2">
                                <v-text-field v-model="formData.currency"
                                    :error-messages="formData.errors.currency"
                                    :label="textBr.currency" required />
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-text-field v-model="formData.phonePrefix"
                                    :error-messages="formData.errors.phonePrefix"
                                    :label="textBr.phonePrefix" required />
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-text-field v-model="formData.flag"
                                    :error-messages="formData.errors.flag"
                                    :label="textBr.flag" required />
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
import { Link, useForm } from "@inertiajs/vue3";
import { route } from "ziggy";

defineOptions({ layout: AdminLayout })

type Country = {
    id: number;
    name: string;
    alpha2Code: string;
    alpha3Code: string;
    numericCode: number;
    code: string;
    flag: string;
    capital: string;
    currency: string;
    phonePrefix: string;
};

const props = defineProps<{ country: Country }>()

const textBr = {
    header: 'País:',
    createButton: 'SALVAR',
    submit: "Salvar",
    name: "Nome",
    alpha2Code: "Código Alpha 2",
    alpha3Code: "Código Alpha 3",
    numericCode: "Código Numérico",
    flag: "Bandeira",
    currency: "Moeda",
    phonePrefix: "Préfixo do Telefone",
    firstChar: "Primeira Letra",
    nameRequired: "O nome é obrigatório",
    countryDetails: "Dados do País"
}

const formData = useForm({
    ...props.country,
})

// Methods
const createCountryAction = () => {
    formData.post(route('admin.country.update'));
};
</script>

<style>
</style>
