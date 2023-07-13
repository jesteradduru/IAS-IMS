<template>
    <AppLayout title="Proactive | Create">
        <div class="box mx-4">
            <div class="text-2xl mb-2">ProActive | Create</div>
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

                    <div class="col-span-2">
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
                    <div class="col-span-3">
                        <InputLabel>Type</InputLabel>
                        <div class="flex gap-4 mt-2">
                            <div class="flex gap-1 items-center">
                                <input name="type" type="radio" id="spot" value="spot"
                                    v-model="form.type" checked />
                                <label for="spot">SPOT</label>
                            </div>
                            <div class="flex gap-1 items-center">
                                <input name="type" type="radio" id="proactive" value="proactive"
                                    v-model="form.type" />
                                <label for="proactive">PROACTIVE</label>
                            </div>
                            <div class="flex gap-1 items-center">
                                <input name="type" type="radio" id="special" value="special"
                                    v-model="form.type" />
                                <label for="special">SPECIAL</label>
                            </div>
                        </div>
                    </div>
                    <div v-if="form.type === 'special'" class="col-span-3">
                        <InputLabel>Choose Category</InputLabel>
                        <div class="flex gap-4 mt-2">
                            <div class="flex gap-1 items-center">
                                <input name="category" type="radio" id="local" value="local"
                                    v-model="form.special_category" checked />
                                <label for="local">LOCAL EVENTS</label>
                            </div>
                            <div class="flex gap-1 items-center">
                                <input name="category" type="radio" id="national" value="national"
                                    v-model="form.special_category" />
                                <label for="national">NATIONAL EVENTS</label>
                            </div>
                        </div>
                    </div>
                    <div class="border-b col-span-6 border-gray-400"></div>
                    <div class="col-span-6 text-xl">Address</div>
                    <Address :form="form" />
                    <div class="border-b col-span-6 border-gray-400"></div>
                    <div class="col-span-1">
                        <label class="label">AP</label>
                        <input v-model.number="form.ap" type="number" class="input-text" />
                        <div v-if="form.errors.ap" class="input-error">{{ form.errors.ap }}</div>
                    </div>
                    <div class="col-span-1">
                        <label class="label">AA</label>
                        <input v-model.number="form.aa" type="number" class="input-text" />
                        <div v-if="form.errors.aa" class="input-error">{{ form.errors.aa }}</div>
                    </div>
                    <div class="col-span-1">
                        <label class="label">UA</label>
                        <input v-model.number="form.ua" type="number" class="input-text" />
                        <div v-if="form.errors.ua" class="input-error">{{ form.errors.ua }}</div>
                    </div>


                    <div class="col-span-6 flex gap-2">
                        <a class="btn-normal" :href="route('proactive.index')" type="submit">Back</a>
                        <button class="btn-primary" type="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Address from '@/Components/Address.vue';

const props = defineProps({
    inspecting_offices: Object,
    units: Object,
})

const form = useForm({
    inspecting_office_id: null,
    date_time: '',
    unit_id: null,
    street: null,
    barangay: null,
    municipality: null,
    province: null,
    region: null,
    ap: null,
    aa: null,
    ua: null,
    type: 'spot',
    special_category: 'local'
});

const create = () => form.post(route('proactive.store'));

const onChangeDateTime = (e) => {
    form.date_time = e.target.value
}

</script>