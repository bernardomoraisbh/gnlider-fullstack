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
                        <v-text-field v-model="email" :rules="emailRules" label="E-mail" required />
                    </v-list-item>
                    <v-list-item>
                        <v-text-field v-model="password" :rules="[v => !!v || 'A senha é obrigatória']" label="Senha"
                            required />
                    </v-list-item>
                    <v-spacer />
                    <v-list-item>
                        <v-btn color="success" block @click="submit">
                            Entrar
                        </v-btn>
                    </v-list-item>
                </v-list>
            </v-form>
        </v-card>
    </v-menu>
</template>

<script lang="ts" setup>
import { ref } from "vue"
import { VForm } from 'vuetify/components'

const menu = ref<boolean>(false);
const form = ref<VForm>();
const email = ref<string>("");
const password = ref<string>("");
const emailRules = [(v: string) => !!v || 'O email é obrigatório', (v: string) => /.+@.+\..+/.test(v) || 'O email deve ser um email válido.',];

async function submit() {
    const { valid } = await form.value.validate()
    if (valid) console.error('Form is valid')
}
</script>

<style></style>
