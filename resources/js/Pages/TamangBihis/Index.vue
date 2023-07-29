<template>
    <AppLayout title="Tamang Bihis Infractions">
        <template #page-title>Tamang Bihis Infractions</template>
        <div class="overflow-x-auto mt-4 text-sm">
            <div class="flex items-center justify-between mb-4">
                <!-- <Filters /> -->
                <a class="btn-success" :href="route('tamang_bihis.create')">Add Record</a>
            </div>
            <table class="min-w-full border border-indigo-200">
                <thead class="bg-gray-200  border-gray-400">
                    <tr>
                        <th  class="border">INSPECTING OFFICE/UNIT</th>
                        <th  class="border">NR</th>
                        <th  class="border">FULL NAME</th>
                        <th  class="border">DATE TIME</th>
                        <th  class="border">NAME OF UNIT</th>
                        <th  class="border">INFRACTIONS NOTED</th>
                        <th  class="border">STATUS/UPDATES ON ACTION TAKEN</th>
                        <th  class="border">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr v-for="(item, index) in props.tamang_bihis.data">
                        <td class="px-4 py-2 border">{{ item.inspecting_office.name }}</td>
                        <td class="px-4 py-2 border">{{ item.id }}</td>
                        <td class="px-4 py-2 border">{{ item.fullname}}</td>
                        <td class="px-4 py-2 border">{{ item.date_time }}</td>
                        <td class="px-4 py-2 border">{{ item.unit.name}}</td>
                        <td class="px-4 py-2 border">{{ 
                            item.infraction.map(infr => {
                               return infr.violation.name.toLowerCase().includes('others') ? `Others (${infr.other_infraction})` : infr.violation.name
                            }).join(' , ')
                        }}</td>
                        <td class="px-4 py-2 border">{{ item.status }}</td>
                        <td class="px-4 py-2 border">
                            <div class="flex gap-2">
                                <a :href="route('tamang_bihis.edit', { tamang_bihis: item.id })" class="btn-normal">Edit</a>
                                <Link :href="route('tamang_bihis.destroy', { tamang_bihis: item.id })" method="delete" as="button" class="btn-danger">Delete</Link>
                            </div>
                        </td>
                    </tr> 
                </tbody>
            </table>
            <div v-if="!props.tamang_bihis.data.length" class="text-gray-500 text-center">No records to display</div>
            <Pagination v-if="props.tamang_bihis.data.length" :links="props.tamang_bihis.links" />
        </div>

    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/UI/Pagination.vue'
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    tamang_bihis: Object
})

</script>