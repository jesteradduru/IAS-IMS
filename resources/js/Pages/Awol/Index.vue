<template>
  <AppLayout title="AWOL">
    <template #page-title>AWOL</template>
    <div class="overflow-x-auto mt-4 text-sm">
      <div class="flex items-center justify-between mb-4">
        <!-- <Filters /> -->
        <Link class="btn-success" :href="route('awol.create')">Add Record</Link>
      </div>
      <table class="min-w-full border border-indigo-200">
        <thead class="bg-gray-200  border-gray-400">
          <tr>
            <th class="border">INSPECTING OFFICE/UNIT</th>
            <th class="border">NR</th>
            <th class="border">FULL NAME</th>
            <th class="border">DATE</th>
            <th class="border">AWOL ORDER NUMBER</th>
            <th class="border">UNIT/POLICE STATION</th>
            <th class="border">EFFECTIVITY DATE</th>
            <th class="border">STATUS</th>
            <th class="border">ACTION TAKEN</th>
            <th class="border">REMARKS</th>
            <th class="border" />
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item) in props.awols.data" :key="item.id">
            <td class="px-4 py-2 border">{{ item.inspecting_office.name }}</td>
            <td class="px-4 py-2 border">{{ item.id }}</td>
            <td class="px-4 py-2 border">{{ item.fullname }}</td>
            <td class="px-4 py-2 border">{{ item.date }}</td>
            <td class="px-4 py-2 border">{{ item.order_number }}</td>
            <td class="px-4 py-2 border">{{ item.unit.name }}</td>
            <td class="px-4 py-2 border">{{ item.effectivity_date }}</td>
            <td class="px-4 py-2 border">
              {{ 
                item.order_number
              }}
            </td>
            <td class="px-4 py-2 border">
              <span v-if="item.awol_status_history.length"> {{ item.awol_status_history[0].awol_process.description }}</span>
            </td>
            <td class="px-4 py-2 border">
              <span v-if="item.awol_action_history.length"> {{ item.awol_action_history[0].description }}</span>
            </td>
            <td class="px-4 py-2 border">
              <div class="flex gap-2">
                <Link :href="route('awol.show', { awol: item.id })" class="btn-success">View</Link>
                <Link v-if="!item.awol_status_history[0].awol_process.final" :href="route('awol.edit', { awol: item.id })" class="btn-normal">Edit</Link>
                <Link :href="route('awol.destroy', { awol: item.id })" method="delete" as="button" class="btn-danger">Delete</Link>
              </div>
            </td>
          </tr> 
        </tbody>
      </table>
      <div v-if="!props.awols.data.length" class="text-gray-500 text-center">No records to display</div>
      <Pagination v-if="props.awols.data.length" :links="props.awols.links" />
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  awols: Object,
})

</script>