<template>
    <v-sheet
        class="pa-4 text-center mx-auto"
        elevation="12"
        max-width="600"
        rounded="lg"
        width="100%"
        >
        <div class="text-left">
            <h1 class="text-h4 font-weight-black mb-2">Login</h1>
        </div>
        <div class="d-flex align-center justify-space-between text-body-1 text-sm-h6 font-weight-regular mb-8">
            {{ labels.noAccount }}
            <Link href="/user-account/create">{{ labels.signUp }}</Link>
        </div>
        <v-form ref="form">
            <v-text-field v-model="formData.email" :error-messages="formData.errors.email" :counter="10" :rules="emailRules" :label="labels.email" required />

            <v-text-field v-model="formData.password" :error-messages="formData.errors.password" :counter="10" type="password" :rules="passwordRules" :label="labels.password" required/>

            <div class="text-right">
                <Link href="/listing/create">{{ labels.forgotPassword }}</Link>
            </div>

            <!-- <v-checkbox v-model="formData.checkbox" :rules="checkboxRules" :label="labels.checkbox" required /> -->

            <div class="d-flex flex-column">
                <v-btn class="mt-4" color="success" block @click="validate">
                    {{ labels.submit }}
                </v-btn>
            </div>
        </v-form>
    </v-sheet>
</template>

<script lang="ts" setup>
import { ref } from 'vue';
import { VForm } from 'vuetify/components'
import { Link, useForm } from "@inertiajs/vue3"
import { route } from "ziggy";
import MainLayout from '@/Layouts/MainLayout.vue';

defineOptions({ layout: MainLayout })

const form = ref<VForm>();
const labels = { name: "Nome", email: "Email", password: "Senha", checkbox: "Do you agree?", validate: "Validar", reset: "Resetar", validEmail: "O email deve ser válido",
    submit: "Entrar", forgotPassword: "Esqueci a senha", signUp: "Cadastre-se", noAccount: "Não possui uma conta?", emailRequired: "O email é obrigatório", passwordRequired: "A senha é obrigatória"
};
const labelsUs = { name: "Name", email: "Email", password: "Password", checkbox: "Do you agree?", validate: "Validate",
    reset: "Rest Form", submit: "Submit", forgotPassword: "Forgot password?", signUp: "Sign Up", noAccount: "Don't have an account yet?",
    emailRequired: "Email is required", passwordRequired: "Password is required", validEmail: "Email must be a valid email address"
};

const formData = useForm({
    email:  null,
    password:  null,
    checkbox:  null,
})

const emailRules = [
    v => !!v || labels.emailRequired,
];
const passwordRules = [
    v => !!v || labels.passwordRequired,
];
const checkboxRules = [v => !!v || 'You must agree to continue!'];

async function validate() {
    form.value.resetValidation()
    const { valid } = await form.value.validate()
    if (!valid) {
        return;
    }
    formData.post(route("login.store"));
};
function reset() {
    form.value.reset()
};
</script>

<style></style>
