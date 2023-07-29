<template>
    <AppLayout title="Absent Personnel">
        <template #page-title>List of Absent Personnel</template>
        <div class="overflow-x-auto mt-4 text-sm">
            <div class="flex items-center justify-between mb-4">
                <!-- <Filters /> -->
                <a class="btn-success" :href="route('absent_personnel.create')">Add Record</a>
            </div>
            <table class="min-w-full border border-indigo-200">
                <thead class="bg-gray-200  border-gray-400">
                    <tr>
                        <th  class="border">INSPECTING OFFICE/UNIT</th>
                        <th  class="border">NR</th>
                        <th  class="border">FULL NAME</th>
                        <th  class="border">DATE TIME</th>
                        <th  class="border">NAME OF UNIT</th>
                        <th  class="border">ACTION TAKEN</th>
                        <th  class="border">STATUS/UPDATES ON ACTION TAKEN</th>
                        <th  class="border">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in props.data.data">
                        <td class="px-4 py-2 border">{{ item.inspecting_office.name }}</td>
                        <td class="px-4 py-2 border">{{ item.id }}</td>
                        <td class="px-4 py-2 border">{{ item.fullname}}</td>
                        <td class="px-4 py-2 border">{{ item.date_time }}</td>
                        <td class="px-4 py-2 border">{{ item.unit.name}}</td>
                        <td class="px-4 py-2 border">{{ item.action_taken }}</td>
                        <td class="px-4 py-2 border">{{ item.status }}</td>
                        <td class="px-4 py-2 border">
                            <div class="flex gap-2">
                                <a :href="route('absent_personnel.edit', { absent_personnel: item.id })" class="btn-normal">Edit</a>
                                <Link :href="route('absent_personnel.destroy', { absent_personnel: item.id })" method="delete" as="button" class="btn-danger">Delete</Link>
                            </div>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
            <Pagination :links="props.data.links" />
        </div>

    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/UI/Pagination.vue'
import { Link } from '@inertiajs/vue3';
import Filters from '@/Pages/ProActive/Index/Components/Filters.vue'

const props = defineProps({
    data: {

    }
})

</script>