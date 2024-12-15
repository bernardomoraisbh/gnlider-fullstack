<template>
    <div v-for="listing in listings" :key="listing.id">
        <Link :href="`/listing/${listing.id}`">
        {{ listing.street }} {{ listing.street_nr }}, {{ listing.city }},
        {{ listing.price }}
        </Link>
    </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    listings: Array,
});

</script>
