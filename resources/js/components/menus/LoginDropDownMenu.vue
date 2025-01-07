<template>
    <v-menu v-model="menu" :close-on-content-click="false" location="bottom">
        <template #activator="{ props }">
            <v-btn icon v-bind="props">
                <v-icon left>
                    mdi-account
                </v-icon>
            </v-btn>
        </template>
        <v-card min-width="300">
            <v-divider />
            <v-form ref="form">
                <v-list>
                    <v-list-item>
                        <v-text-field v-model="formData.email" :error-messages="formData.errors.email"
                            :rules="emailRules" label="E-mail" required />
                    </v-list-item>
                    <v-list-item>
                        <v-text-field v-model="formData.password" :error-messages="formData.errors.password"
                            :rules="passwordRules" label="Senha" required />
                    </v-list-item>
                    <v-spacer />
                    <v-list-item>
                        <v-btn color="success" block @click="submit">
                            Entrar
                        </v-btn>
                    </v-list-item>
                    <v-list-item>
                        <div class="text-center">
                            {{ labels.noAccount }}
                        </div>
                    </v-list-item>
                    <v-list-item>
                        <div class="text-center">
                            <Link href="/user-account/create">{{ labels.signUp }}</Link>
                        </div>
                    </v-list-item>
                </v-list>
            </v-form>
        </v-card>
    </v-menu>
</template>

<script lang="ts" setup>
import { ref } from "vue"
import { VForm } from 'vuetify/components'
import { Link, useForm } from "@inertiajs/vue3"
import { route } from "ziggy";

const formData = useForm({
    name: null,
    email: null,
    password: null,
    checkbox: null,
})

const labels = { name: "Nome", email: "Email", password: "Senha", validate: "Validar", signUp: "Cadastre-se", noAccount: "ou não possui uma conta?" };

const menu = ref<boolean>(false);
const form = ref<VForm>();
const emailRules = [(v: string) => !!v || 'O email é obrigatório', (v: string) => /.+@.+\..+/.test(v) || 'O email deve ser um email válido.',];
const passwordRules = [
    v => !!v || 'Name is required',
    v => (v && v.length >= 4) || 'Password must be 4 characters or more',
];

async function submit() {
    const { valid } = await form.value.validate()
    if (!valid) {
        console.error('Form is invalid')
        return;
    }
    formData.post(route("login.store"));
}
</script>

<style></style>
