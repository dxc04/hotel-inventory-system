<template>
<div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="row">
                    <div class="col-4 mr-0 text-center align-items-center">
                        <div class="h5 mr-0 mb-0 pr-0 font-weight-bold text-gray-800" style="font-size: 50px;">8</div>
                    </div>
                <div class="col-5 ml-0">
                    <div class="text-l ml-0 pl-0 font-weight-bold text-primary mb-1">
                        <h3><slot name="title"></slot></h3></div>
                </div>
            </div>
        </div>
            <div class="col-auto">
                <i class="fas fa-4x text-gray-300" :class="dashboardIcon"></i>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    // todo: add props card color, icon, and content
    export default {
        props: {
            dashboardIcon: {
                type: String
            }
        },
        name: 'DashboardCard',
        mounted() {
            console.log(this.testing)
        }
    }
</script>
