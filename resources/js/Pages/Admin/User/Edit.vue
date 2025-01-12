<template>
    <v-form>
        <v-row align="start" justify="space-between" class="mb-4">
            <v-spacer></v-spacer>
            <!-- Create Button -->
            <v-col cols="auto" align-self="end">
                <v-btn color="primary" @click="saveUser" prepend-icon="mdi-plus" :text="text.saveButton" block />
            </v-col>
        </v-row>
    </v-form>

    <v-row align="start" justify="space-between" class="mb-4">
        <v-col cols="12">
            <v-card>
                <v-card-item>
                    Usuários
                </v-card-item>
                <v-card-text id="profile-pic" class="d-flex">
                    <v-avatar color="surface-variant" class="me-6" size="100" rounded="lg">
                        <v-img src="https://cdn.vuetifyjs.com/images/profiles/marcus.jpg" cover></v-img>
                    </v-avatar>
                    <v-form class="d-flex flex-column justify-center gap-5">
                        <div class="d-flex flex-wrap gap-2">
                            <v-btn color="primary" elevated>
                                {{ text.uploadNewPhotoButton }}
                            </v-btn>
                            <v-btn color="warning" variant="outlined" class="ml-2">
                                {{ text.resetButton }}
                            </v-btn>
                        </div>
                        <p class="text-body-1 mb-0 mt-2"> {{ text.profileFileUploadText }} </p>
                    </v-form>
                </v-card-text>
                <v-divider />
                <v-card-text id="user-data-form">
                    <v-form>
                        <v-row justify="space-between">
                            <v-col cols="12">
                                <v-text-field v-maska:cpf.unmasked="'###.###.###-##'"
                                    :error-messages="formData.errors.cpf" disabled :label="text.cpf"
                                    required persistent-placeholder placeholder="###.###.###-##" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field v-model="formData.name" :error-messages="formData.errors.name"
                                disabled :label="text.name" required />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field v-model="formData.surName" :error-messages="formData.errors.surName"
                                    :label="text.surName" required disabled/>
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-date-input v-model="formData.birthDate"
                                    :error-messages="formData.errors.birthDate" :label="text.birthDate" required
                                    persistent-placeholder prepend-icon="" prepend-inner-icon="mdi-calendar"
                                    placeholder="dd/mm/yyyy" disabled/>
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-select v-model="formData.sex" :label="text.sex"
                                    :items="['Feminino', 'Masculino', 'Outros']" disabled/>
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-select v-model="formData.speciality" :label="text.speciality"
                                    :items="['Especialidade 1', 'Especialidade 2', 'Outros']" disabled/>
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field v-maska:cellphone.unmasked="'(##) # ####-####'"
                                    :label="text.cellphone" persistent-placeholder
                                    placeholder="(##) # ####-####" disabled/>
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field v-model="formData.regionalCouncilNumber"
                                    :error-messages="formData.errors.regionalCouncilNumber"
                                    :label="text.regionalCouncilNumber" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-select v-model="formData.regionalCouncilState"
                                    :label="text.regionalCouncilState" :items="['AC', 'MG']" />
                            </v-col>
                            <v-col cols="12">
                                <v-text-field v-model="formData.email" :error-messages="formData.errors.email"
                                    type="email" :label="text.email" required
                                    prepend-inner-icon="mdi-email-outline" disabled/>
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-checkbox v-model="formData.enableUserLogin" :label="text.enableUserLogin"/>
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-checkbox v-model="formData.administrator" :label="text.isAdministrator"/>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-col>
        <v-col cols="12">
            <v-form>
                <v-card>
                    <v-card-item>
                        Alterar Senha
                    </v-card-item>
                    <v-card-text id="user-data-form">
                    <v-form>
                        <v-row justify="space-between">
                            <v-col cols="12" md="6">
                                    <v-text-field v-model="formData.password" :error-messages="formData.errors.password"
                                        type="password" :rules="passwordRules" :label="text.currentPassword" required
                                        prepend-inner-icon="mdi-lock-outline" disabled />
                            </v-col>
                        </v-row>
                        <v-row justify="space-between">
                            <v-col cols="12" md="6">
                                <v-text-field v-model="formData.password" :error-messages="formData.errors.password"
                                    type="password" :rules="passwordRules" :label="text.newPassword" required
                                    prepend-inner-icon="mdi-lock-outline" disabled />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field v-model="formData.passwordConfirmation"
                                    :error-messages="formData.errors.passwordConfirmation" type="password"
                                    :rules="passwordRules" :label="text.passwordConfirmation" required
                                    prepend-inner-icon="mdi-lock-outline" disabled/>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-card-text>
                </v-card>
            </v-form>
        </v-col>
    </v-row>
</template>

<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ref, computed } from 'vue';
import { VCardItem } from 'vuetify/lib/components/index.mjs';
import { Link, useForm } from "@inertiajs/vue3"

type User = {
    id: number;
    name: string;
    surName: string;
    email: string;
    birthDate: Date;
    cpf: string;
    cnpj: string;
    cellphone: string;
    regionalCouncilNumber: string;
    stateInscriptionNumber: string;
    regionalCouncilState: string;
    enableUserLogin: boolean;
    administrator: boolean;
    speciality: string;
    sex: string;
    password: string;
    passwordConfirmation: string;
};

const props = defineProps<{ user: User }>()

defineOptions({ layout: AdminLayout })

const passwordRules = [
    v => !!v || text.passwordRequired,
    v => (v && v.length >= 10) || text.passwordMinLength,
];

const text = {
    header: 'Usuário:',
    saveButton: 'SALVAR',
    searchPlaceholder: 'Pesquisar',
    noDataText: 'Nenhum item localizado, tente um filtro diferente.',
    profileFileUploadText: 'JPG, GIF ou PNG. Máximo de 800K',
    uploadNewPhotoButton: 'Upload',
    resetButton: 'Resetar',
    accountCreate: "Cadastro", cpf: "CPF", cnpj: "CNPJ", name: "Nome", email: "Email", password: "Senha", passwordConfirmation: "Confirmar Senha",
    checkbox: "Você aceita os termos?", validate: "Validar", reset: "Resetar", submit: "Cadastrar", personalAccount: "Pessoa Física", companyAccount: "Pessoa Jurídica",
    nameRequired: "O nome é obrigatório", emailRequired: "O email é obrigatório", passwordRequired: "A senha é obrigatória", nameMinLength: "O nome deve conter pelo menos 4 caracteres",
    validEmail: "O email deve ser válido", passwordMinLength: "A senha deve conter pelo menos 10 caracteres", requiredCpf: "O CPF é obrigatório", cnpjRequired: "O CNPJ é obrigatório", invalidCnpj: "O CNPJ não é válido",
    invalidCpf: "CPF inválido", surName: "Sobrenome", companyName: "Razão Social", birthDate: "Data de nascimento", sex: 'Sexo', agreeToContinue: "Você deve concordar para prosseguir!",
    alreadyHasAccount: "Já possui uma conta?", signIn: "Clique aqui para entrar", speciality: "Especialidade", cellphone: "Telefone Celular", regionalCouncilNumber: "Número Conselho Regional",
    regionalCouncilState: "UF Registro CR", stateInscriptionNumber: "Inscrição Estadual",
    currentPassword: "Senha Atual", newPassword: "Nova Senha",
    isAdministrator: "Usuário Administrador?", enableUserLogin: "Habilitar login do usuário?"
}
const textUs = {
    header: 'Usuário:',
    saveButton: 'SALVAR',
    searchPlaceholder: 'Pesquisar',
    noDataText: 'Nenhum item localizado, tente um filtro diferente.',
    profileFileUploadText: 'Allowed JPG, GIF or PNG. Max size of 800K',
    uploadNewPhotoButton: 'Upload new photo',
    resetButton: 'Resetar',
    currentPassword: "Current Password", newPassword: "New Password"
}

const formData = useForm({
    ...props.user
})

const cpf = ref<string>(props.user.cpf);

// Methods
const saveUser = () => {
    console.log('User Saved');
};
</script>
