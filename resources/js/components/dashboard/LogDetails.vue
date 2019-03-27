<template>
    <div class="row log-details">
        <div class="col col-lg-8 h5 mb-0 font-weight-bold">
        <span class="badge" :class="statusClass">
            {{ DailyLog.room_status.status_name }}
        </span>
        </div>
        <div class="col col-lg-4 text-right">
        <span>
            Room
            {{ DailyLog.room.room_name }}
        </span>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'LogDetails',
        props: {
            DailyLog: {
                type: Array
            }
        },
        data() {
            return {
                statusClasses: {
                    dnd_stayover: 'badge-warning',
                    dnd_due_out: 'badge-danger',
                    restocked: 'badge-success',
                    no_sale: 'badge-secondary',
                    cleaning_in_progress: 'badge-dark',
                    cleaned: 'badge-primary',
                    checked_in: 'badge-secondary'
                }
            }
        },
        computed: {
            statusClass() {
                 return this.statusClasses[this.DailyLog.room_status.status_key]
            }
        }
    }
</script>
<style>
    .log-details {
        padding: 10px;
    }
</style>
