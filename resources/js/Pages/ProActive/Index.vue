<template>
    <AppLayout title="Inspections">
        <template #page-title>Types of Inspection</template>
        <div class="overflow-x-auto mt-4 text-sm">
            <div class="flex items-center justify-between">
                <Filters />
                <a class="btn-success" :href="route('inspection.create')">Add Inspection</a>
            </div>
            <table class="min-w-full border border-indigo-200">
                <thead class="bg-gray-200  border-gray-400">
                    <tr>
                        <th rowspan="2" class="border">INSPECTING OFFICE/UNIT</th>
                        <th rowspan="2" class="border">NR</th>
                        <th rowspan="2" class="border">DATE TIME</th>
                        <th rowspan="2" class="border">NAME OF UNIT</th>
                        <th rowspan="2" class="border">ADDRESS</th>
                        <th colspan="4" class="border">ACCOUNTING OF PERSONNEL</th>
                        <th rowspan="2" class="border">Action</th>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 border">AP</th>
                        <th class="px-4 py-2 border">AA</th>
                        <th class="px-4 py-2 border">UA</th>
                        <th class="px-4 py-2 border">TS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in props.data.data">
                        <td class="px-4 py-2 border">{{ item.inspecting_office?.name }}</td>
                        <td class="px-4 py-2 border">{{ item.id }}</td>
                        <td class="px-4 py-2 border">{{ item.date_time }}</td>
                        <td class="px-4 py-2 border">{{ item.unit?.name }}</td>
                        <td class="px-4 py-2 border">{{ getAddress({
                            zone: item.street, brgy: item.barangay, city:
                                item.municipality, province: item.province, region: item.region
                        }) }}</td>
                        <td class="px-4 py-2 border">{{ item.ap }}</td>
                        <td class="px-4 py-2 border">{{ item.aa }}</td>
                        <td class="px-4 py-2 border">{{ item.ua }}</td>
                        <td class="px-4 py-2 border">{{ item.ap + item.aa + item.ua }}</td>
                        <td class="px-4 py-2 border">
                            <div class="flex gap-2">
                                <a :href="route('inspection.edit', { inspection: item.id })" class="btn-normal">Edit</a>
                                <Link :href="route('inspection.destroy', { inspection: item.id })" method="delete" as="button" class="btn-danger">Delete</Link>
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
import { Address } from '@/Helpers/Address/addresses';
import Pagination from '@/Components/UI/Pagination.vue'
import { Link } from '@inertiajs/vue3';
import Filters from '@/Pages/ProActive/Index/Components/Filters.vue'

const props = defineProps({
    data: Object
})


const getAddress = (addressData) => {
    const { zone, brgy, city, province, region } = addressData
    const address = new Address(zone, brgy, city, province, region)
    return address.getFullAddress()
}

</script>