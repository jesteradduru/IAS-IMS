<template>
  <AppLayout :title="`${props.page_name} | Create`">
    <div class="box mx-4">
      <div class="text-2xl mb-2">{{ props.page_name }} | Create</div>
      <form @submit.prevent="create">
        <div class="grid grid-cols-6 gap-4">
          <div class="col-span-6">
            <label class="label">Inspecting Office/Unit</label>
            <select id="" v-model="form.inspecting_office_id" name="" class="input-select">
              <option value="" />
              <option v-for="office in inspecting_offices" :key="office.id" :value="office.id">{{ office.name }}</option>
            </select>
            <div v-if="form.errors.inspecting_office_id" class="input-error">
              {{ form.errors.inspecting_office_id
              }}
            </div>
          </div>
          <div class="col-span-6">
            <label class="label">Rank/Full Name</label>
            <input v-model.number="form.fullname" type="text" class="input-text" />
            <div v-if="form.errors.fullname" class="input-error">{{ form.errors.fullname }}</div>
          </div>
          <div class="col-span-3">
            <label class="label">DATE</label>
            <input v-model="form.date" type="date" class="input-text" />
            <div v-if="form.errors.date" class="input-error">{{ form.errors.date }}</div>
          </div>
          <div class="col-span-3">
            <label class="label">Name of Unit</label>
            <select id="" v-model="form.unit_id" name="" class="input-select">
              <option value="" />
              <option v-for="unit in units" :key="unit.id" :value="unit.id">{{ unit.name }}</option>
            </select>
            <div v-if="form.errors.unit_id" class="input-error">{{ form.errors.unit_id }}</div>
          </div>
          <div class="col-span-3">
            <label class="label">EFFECTIVITY DATE</label>
            <input v-model="form.effectivity_date" type="date" class="input-text" />
            <div v-if="form.errors.effectivity_date" class="input-error">{{ form.errors.effectivity_date }}</div>
          </div>
          <div class="col-span-3">
            <label class="label">ORDER NUMBER</label>
            <input v-model="form.order_number" type="text" class="input-text" />
            <div v-if="form.errors.order_number" class="input-error">{{ form.errors.order_number }}</div>
          </div>

          <div class="col-span-6">
            <label class="label">STATUS</label>
            <div class="grid grid-cols-2">
              <div v-for="(status) in props.awol_status_processes" :key="status.id" class="col-span-1 flex gap-2">
                <input :id="'status' + status.id" v-model="form.status" type="radio" name="awol_status" :value="status.id" />
                <label :for="'status' + status.id">{{ status.description }}</label>
              </div>
            </div>
            <div v-if="form.errors.status" class="input-error">{{ form.errors.status }}</div>
          </div>

          <div class="col-span-6">
            <label class="label">ACTION TAKEN</label>
            <textarea id="" v-model.number="form.action_taken" name="" cols="30" rows="3" class="input-text" />
            <div v-if="form.errors.action_taken" class="input-error">{{ form.errors.action_taken }}</div>
          </div>

          <div class="col-span-6">
            <label class="label">REMARKS</label>
            <textarea id="" v-model.number="form.remarks" name="" cols="30" rows="3" class="input-text" />
            <div v-if="form.errors.remarks" class="input-error">{{ form.errors.remarks }}</div>
          </div>


          <div class="col-span-6 flex gap-2">
            <Link class="btn-normal" :href="route('awol.index')" type="button">Back</Link>
            <button class="btn-primary" type="submit">Create</button>
          </div>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
  inspecting_offices: Object,
  units: Object,
  page_name: String,
  awol_status_processes: Array,
})


const form = useForm({
  inspecting_office_id: null,
  date: null,
  effectivity_date: null,
  fullname: null,
  unit_id: null,
  action_taken: null,
  status: null,
  remarks: null,
  order_number: null,
})

const create = () => form.post(route('awol.store'), {
  onSuccess: () => {
    form.reset()
  },
})


</script>