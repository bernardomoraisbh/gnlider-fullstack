<template>
    <div>
        {{ listing.street }} {{ listing.street_nr }}, {{ listing.city }},
        for {{ listing.price }}
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    listing: Object,
});
</script>
