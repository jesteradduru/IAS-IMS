<template>
    <AppLayout title="ProActive">
        <template #page-title>ProActive</template>
        <a class="btn-primary" :href="route('proactive.create')">Add</a>

        <div class="overflow-x-auto mt-4 text-sm">
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
                <tr>
                    <td class="px-4 py-2 border">Data 1</td>
                    <td class="px-4 py-2 border">Data 2</td>
                    <td class="px-4 py-2 border">Data 3</td>
                    <td class="px-4 py-2 border">Data 1</td>
                    <td class="px-4 py-2 border">Data 2</td>
                    <td class="px-4 py-2 border">Data 3</td>
                    <td class="px-4 py-2 border">Data 1</td>
                    <td class="px-4 py-2 border">Data 2</td>
                    <td class="px-4 py-2 border">Data 3</td>
                    <td class="px-4 py-2 border">
                        <div class="flex gap-2">
                            <button class="btn-normal">Edit</button>
                            <button class="btn-normal">Delete</button>
                        </div>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>

    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

</script>