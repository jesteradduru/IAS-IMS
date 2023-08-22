<template>
    <Link v-if="route().current(link)" :href="route(link)" class="p-2 text-sm rounded-md bg-indigo-700 text-gray-50 shadow-md hover:bg-indigo-600 cursor-pointer">
        <slot />
    </Link>
    <Link v-else :href="route(link)" class="p-2 text-sm rounded-md bg-indigo-500 text-gray-50 shadow-md hover:bg-indigo-600 cursor-pointer">
        <slot />
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    link: String
})
</script>