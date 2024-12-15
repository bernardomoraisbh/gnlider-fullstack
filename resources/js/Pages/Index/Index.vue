<template>
    Hello World
    {{ hello }}
</template>
<script setup>
import {ref} from 'vue';
const hello = ref('a')
</script>
