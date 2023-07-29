<template>
    <AppLayout :title="`${props.page_name} | Create`">
        <div class="box mx-4">
            <div class="text-2xl mb-2">{{ props.page_name }} | Create</div>
            <form @submit.prevent="create">
                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-6">
                        <label class="label">Inspecting Office/Unit</label>
                        <select name="" class="input-select" id="" v-model="form.inspecting_office_id">
                            <option value=""></option>
                            <option v-for="office in inspecting_offices" :value="office.id">{{ office.name }}</option>
                        </select>
                        <div v-if="form.errors.inspecting_office_id" class="input-error">{{ form.errors.inspecting_office_id
                        }}</div>
                    </div>
                    <div class="col-span-6">
                        <label class="label">Rank/Full Name</label>
                        <input v-model.number="form.fullname" type="text" class="input-text" />
                        <div v-if="form.errors.fullname" class="input-error">{{ form.errors.fullname }}</div>
                    </div>
                    <div class="col-span-3">
                        <label class="label">DATE AND TIME</label>
                        <input v-model.number="form.date_time" type="datetime-local" class="input-text" @change="onChangeDateTime" />
                        <div v-if="form.errors.date_time" class="input-error">{{ form.errors.date_time }}</div>
                    </div>

                    <div class="col-span-3">
                        <label class="label">Name of Unit</label>
                        <select name="" class="input-select" id="" v-model="form.unit_id">
                            <option value=""></option>
                            <option v-for="unit in units" :value="unit.id">{{ unit.name }}</option>
                        </select>
                        <div v-if="form.errors.unit_id" class="input-error">{{ form.errors.unit_id }}</div>
                    </div>
                    <div class="col-span-6">
                        <label class="label">Action Taken</label>
                        <textarea name="" id="" cols="30" rows="3" v-model.number="form.infractions_noted" class="input-text" />
                        <div v-if="form.errors.infractions_noted" class="input-error">{{ form.errors.infractions_noted }}</div>
                    </div>
                    <div class="col-span-6">
                        <label class="label">Status/Updates on Action Taken</label>
                        <textarea name="" id="" cols="30" rows="3" v-model.number="form.status" class="input-text" />
                        <div v-if="form.errors.status" class="input-error">{{ form.errors.status }}</div>
                    </div>


                    <div class="col-span-6 flex gap-2">
                        <Link class="btn-normal" :href="route('covid_infraction.index')" type="button">Back</Link>
                        <button class="btn-primary" type="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </AppLayout>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    inspecting_offices: Object,
    units: Object,
    page_name: String
})

const form = useForm({
    inspecting_office_id: null,
    date_time: null,
    fullname: null,
    unit_id: null,
    infractions_noted: null,
    status: null,
});

const create = () => form.post(route('covid_infraction.store'), {
    onSuccess: () => {
        form.inspecting_office_id =  null
        form.date_time =  null
        form.fullname =  null
        form.unit_id =  null
        form.infractions_noted =  null
        form.status =  null
    }
});

const onChangeDateTime = (e) => {
    form.date_time = e.target.value
}

</script>