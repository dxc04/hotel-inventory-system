<template>
    <div class="container">
        <dashboard-card></dashboard-card>
    </div>
</template>

<script>
    import DashboardCard from '../components/DashboardCard.vue'

    export default {
        name: 'DashboardPage',
        components: {
            DashboardCard
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
