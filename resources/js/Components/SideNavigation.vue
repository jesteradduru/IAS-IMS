<template>
    <div class=" bg-gray-50 border-gray-100 h-screen p-4">
        <div class="flex flex-col gap-3 m-2 bg-gray-100 border border-gray-100 shadow-sm rounded-xl p-4">
            <div class="font-black text-center text-gray-500">LIST OF ALL INSPECTIONS CONDUCTED</div>
                <SideNavigationLink link="proactive.index">
                    ProActive
                </SideNavigationLink>
                <SideNavigationLink link="proactive.index">
                    Spot
                </SideNavigationLink>
                <SideNavigationLink link="proactive.index">
                    Special
                </SideNavigationLink>
                <SideNavigationLink link="proactive.index">
                    Absent
                </SideNavigationLink>
                <SideNavigationLink link="proactive.index">
                    AWOL
                </SideNavigationLink>
                <SideNavigationLink link="proactive.index">
                    Tamang Bihis Infraction
                </SideNavigationLink>
                <SideNavigationLink link="proactive.index">
                    Unit Infraction
                </SideNavigationLink>
                <SideNavigationLink link="proactive.index">
                    Covid-19 Health Protocol Infractions
                </SideNavigationLink>
            </div>
    </div>
</template>

<script setup>
    import SideNavigationLink from './SideNavigationLink.vue';
</script>