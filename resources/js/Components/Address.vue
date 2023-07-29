<template>
    <div class="col-span-3">
        <label class="label">Street</label>
        <input v-model="form.street" type="text" class="input-text" />
        <div v-if="form.errors.street" class="input-error">{{ form.errors.street }}</div>
    </div>
    <div class="col-span-3">
        <label class="label">Region</label>
        <select class="input-select" name="" v-model="form.region" id="" @change="onChangeRegion">
            <option value=""></option>
            <option v-for="region in regions" :value="region.region_code">{{ region.region_name }}</option>
        </select>
        <div v-if="form.errors.province" class="input-error">{{ form.errors.province }}</div>
    </div>

    <div class="col-span-3">
        <label class="label">Province</label>
        <select class="input-select" :disabled="!selectedRegion" name="" v-model="form.province" id="" @change="onChangeProvince">
            <option v-for="province in filterProvinces" :value="province.province_code">{{ province.province_name }}</option>
        </select>
        <div v-if="form.errors.province" class="input-error">{{ form.errors.province }}</div>
    </div>
    <div class="col-span-3">
        <label class="label">Municipality</label>
        <select class="input-select" :disabled="!selectedProvince" name="" v-model="form.municipality" id="" @change="onChangeMunicipality">
            <option v-for="city in filterMunicipality" :value="city.city_code">{{ city.city_name }}</option>
        </select>
        <div v-if="form.errors.municipality" class="input-error">{{ form.errors.municipality }}</div>
    </div>
    <div class="col-span-3">
        <label class="label">Barangay</label>
        <select class="input-select" :disabled="!selectedMunicipality" name="" v-model="form.barangay" id="">
            <option v-for="brgy in filterBarangay" :value="brgy.brgy_code">{{ brgy.brgy_name }}</option>
        </select>
        <div v-if="form.errors.barangay" class="input-error">{{ form.errors.barangay }}</div>
    </div>
</template>

<script setup>
const props = defineProps({
    form: Object
})

import barangay from '@/Helpers/Address/barangay.json';
import regions from '@/Helpers/Address/region.json';
import provinces from '@/Helpers/Address/province.json';
import city from '@/Helpers/Address/city.json';
import { computed, onMounted, ref, watch } from 'vue';

const selectedRegion = ref(0)
const selectedProvince = ref(0)
const selectedMunicipality = ref(0)
const selectedBarangay = ref(0)



const filterProvinces = computed(() => {
    return provinces.filter(pr => pr.region_code === props.form.region)
})
const filterMunicipality = computed(() => {
    return city.filter(c => c.province_code === props.form.province )
})
const filterBarangay = computed(() => {
    return barangay.filter(b => b.city_code === props.form.municipality)
})


watch(selectedRegion, () => {
    filterProvinces.value =  provinces.filter(pr => pr.region_code === selectedRegion.value)
});
watch(selectedProvince, () => {
    filterMunicipality.value =  city.filter(c => c.province_code === selectedProvince.value )
});
watch(selectedMunicipality, () => {
    filterBarangay.value =  barangay.filter(b => b.city_code === selectedMunicipality.value)
});

const onChangeRegion = (e) => {
    selectedRegion.value = e.target.value
} 
const onChangeProvince = (e) => {
    selectedProvince.value = e.target.value
} 
const onChangeMunicipality = (e) => {
    selectedMunicipality.value = e.target.value
} 
</script>