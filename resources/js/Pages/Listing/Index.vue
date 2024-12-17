<template>
    <div v-for="listing in listings" :key="listing.id">
        <Link :href="route('listing.show', { listing: listing.id })">
        {{ listing.street }} {{ listing.street_nr }}, {{ listing.city }},
        {{ listing.price }}
        </Link>
        <div>
            <Link :href="route('listing.edit', { listing: listing.id })">Edit</Link>
        </div>
        <div>
            <Link :href="route('listing.destroy', { listing: listing.id })" method="delete" as="button">Delete</Link>
        </div>
    </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    listings: Array,
});

</script>
