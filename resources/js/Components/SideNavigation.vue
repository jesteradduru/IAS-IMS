<template>
    <div class=" bg-gray-50 border-gray-100 h-screen p-4">
        <div class="flex flex-col gap-4 m-2 bg-gray-100 border border-gray-100 shadow-sm rounded-xl p-4">
            <div class="font-black text-center text-gray-500">LIST OF ALL INSPECTIONS CONDUCTED</div>
                <SideNavigationLink>
                    ProActive
                </SideNavigationLink>
                <SideNavigationLink>
                    Spot
                </SideNavigationLink>
                <SideNavigationLink>
                    Special
                </SideNavigationLink>
                <SideNavigationLink>
                    Absent
                </SideNavigationLink>
                <SideNavigationLink>
                    AWOL
                </SideNavigationLink>
                <SideNavigationLink>
                    Tamang Bihis Infraction
                </SideNavigationLink>
                <SideNavigationLink>
                    Unit Infraction
                </SideNavigationLink>
                <SideNavigationLink>
                    Covid-19 Health Protocol Infractions
                </SideNavigationLink>
            </div>
    </div>
</template>

<script setup>
    import SideNavigationLink from './SideNavigationLink.vue';
</script>