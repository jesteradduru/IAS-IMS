<template>
    <a v-if="route().current(link)" :href="route(link)" class="p-2 text-sm rounded-md bg-indigo-700 text-gray-50 shadow-md hover:bg-indigo-600 cursor-pointer">
        <slot />
    </a>
    <a v-else :href="route(link)" class="p-2 text-sm rounded-md bg-indigo-500 text-gray-50 shadow-md hover:bg-indigo-600 cursor-pointer">
        <slot />
    </a>
</template>

<script setup>
defineProps({
    link: String
})
</script>