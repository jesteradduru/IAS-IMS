<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  links: Array,
})
</script>

<template>
  <div class="flex my-8">
    <div v-for="(link, index) in links" :key="index">
      <Link preserve-scroll :href="link.url ? link.url : '#'" :class="link.active ? 'bg-indigo-800 text-gray-100 px-3 py-1 rounded-md' : 'px-3 py-1 rounded-md hover:text-indigo-300 '" as="button" v-html="link.label" />
    </div>
  </div>
</template>