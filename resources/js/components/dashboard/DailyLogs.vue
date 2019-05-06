<template>
    <div class="daily-logs">
        <log-details v-for="(log, index) in dailyLogsData" :daily-log="log" :key="index"></log-details>
    </div>
</template>

<script>
    import LogDetails from '../dashboard/LogDetails.vue'

    export default {
        name: 'DailyLogs',
        props: {
            dailyLogsData: {
                type: Array
            }
        },
        components: {
            LogDetails
        },
        mounted() {

        }
    }
</script>
