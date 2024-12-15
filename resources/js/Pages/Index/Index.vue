<template>
    Hello World
    {{ hello }}
    <Link href="/show">Show Page</Link>
    <div>
        Message: {{ message }}
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    message: String
})

const hello = ref('a')
</script>
