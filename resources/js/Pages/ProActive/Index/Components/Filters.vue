<template>
    <form @submit.prevent="filter" class="flex w-1/2 gap-4 mb-2">
        <div>
            <InputLabel>Filter by type</InputLabel>
            <select name="" class="input-select" id="" v-model="filterForm.type">
                <option :value="null">ALL</option>
                <option value="spot">SPOT</option>
                <option value="proactive">PROACTIVE</option>
                <option value="special">SPECIAL</option>
            </select>
        </div>
        <div v-if="filterForm.type === 'special'">
            <InputLabel>Choose Category</InputLabel>
            <div class="flex gap-4 mt-2">
                <div class="flex gap-1 items-center">
                    <input name="category" type="radio" id="local" value="local" v-model="filterForm.special_category"
                        checked />
                    <label for="local">LOCAL EVENTS</label>
                </div>
                <div class="flex gap-1 items-center">
                    <input name="category" type="radio" id="national" value="national"
                        v-model="filterForm.special_category" />
                    <label for="national">NATIONAL EVENTS</label>
                </div>
            </div>
        </div>
        <div class="flex items-end gap-1">
            <button class="btn-primary">Filter</button>
            <button class="btn-normal" @click="clear">Reset</button>
        </div>
    </form>
</template>

<script setup>

import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';

const filterForm = useForm({
    type: null,
    special_category: null,
})

const filter = () => filterForm.get(route('inspection.index'), {
    preserveState: true,
    preserveScroll: true,
})

const clear = () => {
    filterForm.type = null;
    filterForm.special_category = null
    filter()
}
</script>