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
                    <v-form ref="countryDataForm">
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
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, useForm } from "@inertiajs/vue3";
import { route } from "ziggy";
import { VForm } from 'vuetify/components'

defineOptions({ layout: AdminLayout })

const countryDataForm = ref<VForm>();

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

const textBr = {
    header: 'País:',
    createButton: 'CADASTRAR',
    submit: "Cadastrar",
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

function createCountry(): Country {
    return {
        id: 0,
        name: null,
        alpha2Code: '',
        alpha3Code: '',
        numericCode: null,
        code: '',
        flag: '',
        capital: '',
        currency: '',
        phonePrefix: '',
    };
}

const formData = useForm({
    ...createCountry(),
})

// Methods
async function createCountryAction() {
    countryDataForm.value.resetValidation();
    const { valid } = await countryDataForm.value.validate()
    console.log(valid);
    if (!valid) {
        return;
    }
    formData.post(route('admin.country.store'));
};
</script>

<style>
</style>
