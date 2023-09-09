
<template>
  <AppLayout :title="`${props.page_name} | Show`">
    <div class="box mx-4">
      <div class="text-2xl mb-2">{{ props.page_name }} | Show</div>
      <br />
      <div class="flex flex-col gap-3">
        <dl>
          <dt class="text-md text-gray-500">Inspecting Office</dt>
          <dt class="text-md font-bold">{{ props.awol.inspecting_office.name }}</dt>
        </dl>
        <dl>
          <dt class="text-md text-gray-500">Name of unit</dt>
          <dt class="text-md font-bold">{{ props.awol.unit.name }}</dt>
        </dl>
        <dl>
          <dt class="text-md text-gray-500">Effectivity date</dt>
          <dt class="text-md font-bold">{{ props.awol.effectivity_date }}</dt>
        </dl>
        <dl>
          <dt class="text-md text-gray-500">AWOL Order Number</dt>
          <dt class="text-md font-bold">{{ props.awol.order_number }}</dt>
        </dl>
        <dl>
          <dt class="text-md text-gray-500">Status</dt>
          <dt class="text-md font-bold">
            <table class="min-w-full border border-indigo-200">
              <thead class="bg-gray-200  border-gray-400">
                <th>Status</th>
                <th>Effectivity Date</th>
              </thead>
              <tbody>
                <tr v-for="(item) in props.awol.awol_status_history" :key="item.id">
                  <td class="px-4 py-2 border">{{ item.awol_process.description }}</td>
                  <td class="px-4 py-2 border">{{ moment(item.effectivity_date).format('MMMM d, YYYY') }}</td>
                </tr>
              </tbody>
            </table>
          </dt>
        </dl>
        <dl>
          <dt class="text-md text-gray-500">Actions Taken</dt>
          <dt class="text-md font-bold">
            <table class="min-w-full border border-indigo-200">
              <thead class="bg-gray-200  border-gray-400">
                <th>Action Taken</th>
                <th>Date</th>
              </thead>
              <tbody>
                <tr v-for="(item) in props.awol.awol_action_history" :key="item.id">
                  <td class="px-4 py-2 border">{{ item.description }}</td>
                  <td class="px-4 py-2 border">{{ moment(item.created_at).format('MMMM d, YYYY') }}</td>
                </tr>
              </tbody>
            </table>
          </dt>
        </dl>
        <dl>
          <dt class="text-md text-gray-500">Remarks</dt>
          <dt class="text-md font-bold">{{ awol.remarks }} </dt>  
        </dl>
      </div>
      <div class="col-span-6 flex gap-2">
        <Link class="btn-normal" :href="route('awol.index')" type="button">Back</Link>
      </div>
    </div>
  </AppLayout>
</template>
  
<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import moment from 'moment'
  
const props = defineProps({
  inspecting_offices: Object,
  units: Object,
  page_name: String,
  awol_status_processes: Array,
  awol: Object,
})
  
  
const form = useForm({
  inspecting_office_id: props.awol.inspecting_office_id,
  date: props.awol.date,
  effectivity_date: props.awol.effectivity_date,
  fullname: props.awol.fullname,
  unit_id: props.awol.unit_id,
  action_taken: props.awol.awol_action_history?.length && props.awol.awol_action_history[0].description ,
  status:  props.awol.awol_status_history?.length && props.awol.awol_status_history[0].awol_process_id ,
  remarks: props.awol.remarks,
  order_number: props.awol.order_number,
})

  
const update = () => form.put(route('awol.update', {awol: props.awol.id}), {
  onSuccess: () => {
    form.reset()
  },
})
  
  
</script>