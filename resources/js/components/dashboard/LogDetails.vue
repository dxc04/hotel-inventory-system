<template>
    <div class="row log-details">
        <div class="col col-lg-8 h5 mb-0 font-weight-bold">
            <span v-for="(status, index) in dailyLog.room_status" :key="index" :class="getStatusClass(status.status_key)">
                {{ status.status_name }}
            </span>
        </div>
        <div class="col col-lg-4 text-right">
        <span>
            {{ dailyLog.room }}
        </span>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'LogDetails',
        props: {
            dailyLog: {
                type: Object
            }
        },
        data() {
            return {
                statusClasses: {
                    dnd_stayover: 'badge badge-warning mr-1',
                    dnd_due_out: 'badge badge-danger mr-1',
                    restocked: 'badge badge-dark mr-1',
                    no_sale: 'badge badge-secondary mr-1',
                    sale: 'badge badge-success mr-1',
                    cleaned: 'badge badge-primary mr-1',
                    checked_in: 'badge badge-secondary mr-1'
                }
            }
        },
        computed: {

        },
        methods: {
            getStatusClass(status) {
                return this.statusClasses[status]
            }
        }
    }
</script>
<style>
    .log-details {
        padding: 10px;
    }
</style>
