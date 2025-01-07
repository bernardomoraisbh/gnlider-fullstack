<template>
    <v-sheet class="pa-4 text-center mx-auto" elevation="12" max-width="800" rounded="lg" width="100%">
        <v-container fluid>
            <div class="text-left">
                <h1 class="text-h4 font-weight-black mb-2">{{ labels.accountCreate }}</h1>
            </div>
        </v-container>
        <v-form ref="form">
            <v-tabs v-model="tab" align-tabs="center">
                <v-tab :value="0">{{ labels.personalAccount }}</v-tab>
                <v-tab :value="1">{{ labels.companyAccount }}</v-tab>
            </v-tabs>
            <v-tabs-window v-model="tab">
                <v-tabs-window-item key="0" value="0">
                    <v-container fluid class="text-left">
                        <v-row>
                            <v-col cols="12">
                                <v-text-field v-maska:cpf.unmasked="'###.###.###-##'"
                                    :error-messages="formData.errors.cpf" :rules="cpfRules" :label="labels.cpf" required
                                    persistent-placeholder placeholder="###.###.###-##" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field v-model="formData.name" :error-messages="formData.errors.name"
                                    :rules="nameRules" :label="labels.name" required />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field v-model="formData.surName" :error-messages="formData.errors.surName"
                                    :label="labels.surName" required />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-date-input v-model="formData.birthDate" :error-messages="formData.errors.birthDate"
                                    :label="labels.birthDate" required persistent-placeholder prepend-icon=""
                                    prepend-inner-icon="mdi-calendar" placeholder="dd/mm/yyyy" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-select v-model="formData.sex" :label="labels.sex"
                                    :items="['Feminino', 'Masculino', 'Outros']" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-select v-model="formData.speciality" :label="labels.speciality"
                                    :items="['Especialidade 1', 'Especialidade 2', 'Outros']" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field v-maska:cellphone.unmasked="'(##) # ####-####'" :label="labels.cellphone"
                                    persistent-placeholder placeholder="(##) # ####-####" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field v-model="formData.regionalCouncilNumber"
                                    :error-messages="formData.errors.regionalCouncilNumber"
                                    :label="labels.regionalCouncilNumber" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-select v-model="formData.regionalCouncilState" :label="labels.regionalCouncilState"
                                    :items="['AC', 'MG']" />
                            </v-col>
                            <v-col cols="12">
                                <v-text-field v-model="formData.email" :error-messages="formData.errors.email"
                                    type="email" :rules="emailRules" :label="labels.email" required
                                    prepend-inner-icon="mdi-email-outline" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field v-model="formData.password" :error-messages="formData.errors.password"
                                    type="password" :rules="passwordRules" :label="labels.password" required
                                    prepend-inner-icon="mdi-lock-outline" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field v-model="formData.password_confirmation"
                                    :error-messages="formData.errors.password_confirmation" type="password"
                                    :rules="passwordRules" :label="labels.passwordConfirmation" required
                                    prepend-inner-icon="mdi-lock-outline" />
                            </v-col>
                        </v-row>
                        <v-checkbox v-model="formData.checkbox" :rules="checkboxRules" :label="labels.checkbox"
                            required />
                        <div class="d-flex flex-column">
                            <v-btn class="mt-4" color="success" block @click="register">
                                {{ labels.submit }}
                            </v-btn>
                        </div>
                    </v-container>
                </v-tabs-window-item>
                <v-tabs-window-item key="1" value="1">
                    <v-container fluid class="text-left">
                        <v-row>
                            <v-col cols="12">
                                <v-text-field v-maska:cnpj.unmasked="'##.###.###/####-##'"
                                    :error-messages="formData.errors.cnpj" :rules="cnpjRules" :label="labels.cnpj"
                                    required persistent-placeholder placeholder="##.###.###/####-##" />
                            </v-col>

                            <v-col cols="12">
                                <v-text-field v-model="formData.companyName"
                                    :error-messages="formData.errors.companyName" :rules="nameRules"
                                    :label="labels.companyName" required />
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-select v-model="formData.speciality" :label="labels.speciality"
                                    :items="['Especialidade 1', 'Especialidade 2', 'Outros']" />
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field v-maska:cellphone.unmasked="'(##) # ####-####'" :label="labels.cellphone"
                                    persistent-placeholder placeholder="(##) # ####-####" />
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field v-model="formData.stateInscriptionNumber"
                                    :error-messages="formData.errors.stateInscriptionNumber"
                                    :label="labels.stateInscriptionNumber" required />
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-select v-model="formData.regionalCouncilState" :label="labels.regionalCouncilState"
                                    :items="['AC', 'MG']" />
                            </v-col>

                            <v-col cols="12">
                                <v-text-field v-model="formData.email" :error-messages="formData.errors.email"
                                    :rules="emailRules" :label="labels.email" required
                                    prepend-inner-icon="mdi-email-outline" />
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field v-model="formData.password" :error-messages="formData.errors.password"
                                    type="password" :rules="passwordRules" :label="labels.password" required
                                    prepend-inner-icon="mdi-lock-outline" />
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field v-model="formData.password_confirmation"
                                    :error-messages="formData.errors.password_confirmation" type="password"
                                    :rules="passwordRules" :label="labels.passwordConfirmation" required
                                    prepend-inner-icon="mdi-lock-outline" />
                            </v-col>
                        </v-row>

                        <v-checkbox v-model="formData.checkbox" :rules="checkboxRules" :label="labels.checkbox"
                            required />
                        <div class="d-flex flex-column">
                            <v-btn class="mt-4" color="success" block @click="register">
                                {{ labels.submit }}
                            </v-btn>
                        </div>
                    </v-container>
                </v-tabs-window-item>
            </v-tabs-window>
        </v-form>
        <v-container fluid>
            <div class="d-flex align-center justify-space-between text-body-1 text-sm-h6 font-weight-regular mb-8">
                {{ labels.alreadyHasAccount }}
                <Link href="/login">{{ labels.signIn }}</Link>
            </div>
        </v-container>
    </v-sheet>
</template>

<script lang="ts" setup>
import { ref } from 'vue';
import { VTab, VForm } from 'vuetify/components'
import { Link, useForm } from "@inertiajs/vue3"
import { route } from "ziggy";
import MainLayout from '@/Layouts/MainLayout.vue';

defineOptions({ layout: MainLayout })

const form = ref<VForm>();
const tab = ref<VTab>();
const cpf = ref<string>();
const cnpj = ref<string>();
const cellphone = ref<string>();

const labels = {
    accountCreate: "Cadastro", cpf: "CPF", cnpj: "CNPJ", name: "Nome", email: "Email", password: "Senha", passwordConfirmation: "Confirmar Senha",
    checkbox: "Você aceita os termos?", validate: "Validar", reset: "Resetar", submit: "Cadastrar", personalAccount: "Pessoa Física", companyAccount: "Pessoa Jurídica",
    nameRequired: "O nome é obrigatório", emailRequired: "O email é obrigatório", passwordRequired: "A senha é obrigatória", nameMinLength: "O nome deve conter pelo menos 4 caracteres",
    validEmail: "O email deve ser válido", passwordMinLength: "A senha deve conter pelo menos 10 caracteres", requiredCpf: "O CPF é obrigatório", cnpjRequired: "O CNPJ é obrigatório", invalidCnpj: "O CNPJ não é válido",
    invalidCpf: "CPF inválido", surName: "Sobrenome", companyName: "Razão Social", birthDate: "Data de nascimento", sex: 'Sexo', agreeToContinue: "Você deve concordar para prosseguir!",
    alreadyHasAccount: "Já possui uma conta?", signIn: "Clique aqui para entrar", speciality: "Especialidade", cellphone: "Telefone Celular", regionalCouncilNumber: "Número Conselho Regional",
    regionalCouncilState: "UF Registro CR", stateInscriptionNumber: "Inscrição Estadual",
};
const labelsUs = {
    accountCreate: "Account Create", cpf: "CPF", cnpj: "CNPJ", name: "Name", email: "Email", password: "Password",
    checkbox: "Do you agree?", validate: "Validate", reset: "Rest Form", submit: "Submit", personalAccount: "Personal Account", companyAccount: "Company Account",
    nameRequired: "Name is required", emailRequired: "Email is required", passwordRequired: "Password is required", nameMinLength: "Name must be 4 characters or more",
    validEmail: "Email must be a valid email address", passwordMinLength: "Password must be 4 characters or more", cnpjRequired: "CNPJ is required", invalidCnpj: "Invalid CNPJ", invalidCpf: "Invalid CPF",
    requiredCpf: "CPF is required", surName: "Surname", companyName: "Company Name", birthDate: "Birth Date", sex: 'Sexo', agreeToContinue: "You must agree to continue!",
    alreadyHasAccount: "Already has an account?", signIn: "Click here to sign in", speciality: "Speciality", cellphone: "cellphone", regionalCouncilNumber: "Regional Council Number",
    regionalCouncilState: "State of Regional Council registration", stateInscriptionNumber: "State inscription number",
};

const formData = useForm({
    cpf: null,
    cnpj: null,
    name: null,
    companyName: null,
    surName: null,
    birthDate: null,
    sex: null,
    speciality: null,
    cellphone: null,
    regionalCouncilNumber: null,
    regionalCouncilState: null,
    stateInscriptionNumber: null,
    email: null,
    password: null,
    password_confirmation: null,
    checkbox: null,
})

const nameRules = [
    v => !!v || labels.nameRequired,
    v => (v && v.length >= 4) || labels.nameMinLength,
];
const mailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
const emailRules = [
    v => !!v || labels.emailRequired,
    v => mailRegex.test(v) || labels.validEmail,
];
const passwordRules = [
    v => !!v || labels.passwordRequired,
    v => (v && v.length >= 10) || labels.passwordMinLength,
];
const checkboxRules = [v => !!v || labels.agreeToContinue];

function isValidCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');

    if (cpf.length !== 11) return false;

    if (/^(\d)\1+$/.test(cpf)) return false;

    let sum = 0;
    let remainder;

    for (let i = 1; i <= 9; i++) {
        sum += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }

    remainder = (sum * 10) % 11;

    if ((remainder === 10) || (remainder === 11)) remainder = 0;
    if (remainder !== parseInt(cpf.substring(9, 10))) return false;

    sum = 0;
    for (let i = 1; i <= 10; i++) {
        sum += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    }

    remainder = (sum * 10) % 11;

    if ((remainder === 10) || (remainder === 11)) remainder = 0;
    return remainder === parseInt(cpf.substring(10, 11));
}

const cpfRules = [
    v => !!v || labels.requiredCpf,
    v => (v && isValidCPF(v)) || labels.invalidCpf,
];

function isValidCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g, '');

    if (cnpj.length !== 14) return false;

    let length = cnpj.length - 2;
    let numbers = cnpj.substring(0, length);
    let digits = cnpj.substring(length);
    let sum = 0;
    let pos = length - 7;

    for (let i = length; i >= 1; i--) {
        sum += numbers.charAt(length - i) * pos--;
        if (pos < 2) pos = 9;
    }

    let result = sum % 11 < 2 ? 0 : 11 - sum % 11;
    if (result != digits.charAt(0)) return false;

    length += 1;
    numbers = cnpj.substring(0, length);
    sum = 0;
    pos = length - 7;

    for (let i = length; i >= 1; i--) {
        sum += numbers.charAt(length - i) * pos--;
        if (pos < 2) pos = 9;
    }

    result = sum % 11 < 2 ? 0 : 11 - sum % 11;
    return result == digits.charAt(1);
}

const cnpjRules = [
    v => !!v || labels.cnpjRequired,
    v => (v && isValidCNPJ(v)) || labels.invalidCnpj,
];

async function register() {
    form.value.resetValidation()
    const { valid } = await form.value.validate()
    if (!valid) {
        return;
    }
    formData.cpf = cpf.value;
    formData.cnpj = cnpj.value;
    formData.cellphone = cellphone.value;
    formData.post(route("user-account.store"));
};
function reset() {
    form.value.reset()
};
</script>

<style></style>
