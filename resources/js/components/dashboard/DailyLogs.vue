<template>
    <div class="daily-logs">
        <log-details v-for="(log, index) in DailyLogsData" :daily-log="log" :key="index"></log-details>
    </div>
</template>

<script>
    import LogDetails from '../dashboard/LogDetails.vue'

    export default {
        name: 'DailyLogs',
        props: {
            DailyLogsData: {
                type: Array
            }
        },
        components: {
            LogDetails
        },
        mounted() {
            console.log(this.DailyLogsData)
        }
    }
</script>
