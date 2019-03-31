<template>
<div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
        <slot name="card-body-content"></slot>
    </div>
</div>
</template>

<script>
    export default {
        name: 'DashboardCard',
        props: {
            border: {
                type: Array
            },
            dashboardIcon: {
                type: String
            }
        },
        mounted() {
        }
    }
</script>
