<template>
    <AppLayout title="Tamang Bihis Infractions | Create">
        <div class="box mx-4">
            <div class="text-2xl mb-2">Tamang Bihis Infractions | Create</div>
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
                        <input v-model.number="form.date_time" type="datetime-local" class="input-text"
                            @change="onChangeDateTime" />
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
                        <label class="label">Infraction</label>
                        <div class="mb-2">
                            <div v-for="violation in form.infractions" class="ms-2 flex gap-4 text-gray-600">
                                <div>{{ violation.violation }} <span v-if="violation.other_infraction">| {{ violation.other_infraction }}</span></div>
                                <button @click="deleteInfraction" :data-id="violation.id" type="button"
                                    class="text-red-500 hover:font-bold">x</button>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <div>
                                <select name="" class="input-select" id="" v-model="form.infraction_id"
                                    @change="onInfractionChange">
                                    <option value=""></option>
                                    <option v-for="violation in violations" :value="violation.id">{{ violation.name }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <textarea v-if="showOtherInfraction" name="" id="" cols="30" rows="3"
                                    v-model.number="form.other_infraction" class="input-text" />
                            </div>
                            <div>
                                <button class="btn-normal text-sm" type="button" @click="addInfraction">Add
                                    Infraction</button>
                            </div>
                        </div>
                        <div v-if="form.errors.infractions" class="input-error">{{ form.errors.infractions }}</div>
                    </div>
                    <div class="col-span-6">
                        <label class="label">Status/Updates on Action Taken</label>
                        <textarea name="" id="" cols="30" rows="3" v-model.number="form.status" class="input-text" />
                        <div v-if="form.errors.status" class="input-error">{{ form.errors.status }}</div>
                    </div>

                    <div class="col-span-6 flex gap-2">
                        <Link class="btn-normal" :href="route('tamang_bihis.index')" type="button">Back</Link>
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
import { computed, ref, watch } from 'vue';

const props = defineProps({
    inspecting_offices: Object,
    units: Object,
    violations: Array
})

const form = useForm({
    inspecting_office_id: null,
    infraction_id: null,
    infractions: [],
    date_time: null,
    fullname: null,
    unit_id: null,
    status: null,
    other_infraction: null
});

const showOtherInfraction = ref(false)

watch(() => form.infraction_id, () => {
    if(form.infraction_id){
        const infraction = props.violations.filter(violation => violation.id === form.infraction_id)
    
        showOtherInfraction.value = infraction[0].name.toLowerCase().includes('others');
    }
})


const addInfraction = () => {
    const infraction = props.violations.filter(violation => violation.id === form.infraction_id)

    const exist = form.infractions.filter(violation => violation.id === form.infraction_id);

    if (exist.length > 0) {
        alert('Already added!')
    } else {
        form.infractions.push({ id: form.infraction_id, violation: infraction[0].name, other_infraction: form.other_infraction })
        form.other_infraction = null
        form.infraction_id = null
        showOtherInfraction.value = false
    }

    

}

const deleteInfraction = (e) => {
    const id = e.target.getAttribute('data-id');
    const updatedInfraction = form.infractions.filter(violation => violation.id != id);
    form.infractions = updatedInfraction;
}


const create = () => form.post(route('tamang_bihis.store'), {
    onSuccess: () => {
        form.inspecting_office_id = null
        form.date_time = null
        form.fullname = null
        form.unit_id = null
        form.status = null
        form.infractions = []
        form.other_infraction = null
    }
});

const onChangeDateTime = (e) => {
    form.date_time = e.target.value
}

</script>