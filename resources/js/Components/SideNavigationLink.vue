<template>
    <Link  :href="route(link)" class="p-2 text-sm rounded-md bg-indigo-500 text-gray-50 shadow-md hover:bg-indigo-600 cursor-pointer" :class="{active: active}">
        <slot />
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    link: String,
    active: Boolean
})
</script>