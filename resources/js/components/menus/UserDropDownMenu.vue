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
                    <v-spacer />
                    <v-list-item v-if="user">
                        {{ user.name }}
                    </v-list-item>
                    <v-list-item>
                        <v-btn color="success" block @click="logout">
                            Logout
                        </v-btn>
                    </v-list-item>
                </v-list>
            </v-form>
        </v-card>
    </v-menu>
</template>

<script lang="ts" setup>
import { ref, computed } from "vue"
import { VForm } from 'vuetify/components'
import { router } from '@inertiajs/vue3';
import { route } from "ziggy";
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();

const menu = ref<boolean>(false);
const form = ref<VForm>();
const user = computed(() => page.props?.user)

async function logout() {
    router.visit(route('logout'), { method: 'delete', });
}
</script>
