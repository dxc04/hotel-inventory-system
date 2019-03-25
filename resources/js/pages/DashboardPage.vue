<template>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

          <!-- Content Row -->
        <div class="row">
            <!-- Rooms Restocked Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <quick-card theme="info" title="Rooms Checked" :info="roomsCheckedPercentage" :progress="roomsCheckedPercentage" dashboard-icon="fa-clipboard-list"></quick-card>
            </div>

            <!-- Rooms Restocked Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <quick-card theme="primary" title="Rooms Restocked" :info="roomsRestocked" dashboard-icon="fa-box"></quick-card>
            </div>

            <!-- Rooms with Sales Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <quick-card theme="success" title="Rooms with Sales" :info="roomsCheckedPercentage" dashboard-icon="fa-file-invoice-dollar"></quick-card>
            </div>

            <!-- DND Rooms Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <quick-card theme="warning" title="DND Rooms" :info="roomsCheckedPercentage" dashboard-icon="fa-door-closed"></quick-card>
            </div>
        </div>

        <!-- Content Row -->

          <div class="row">

            <!-- Today's Logs -->
            <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Logs for Today</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                </div>
              </div>
            </div>

            <!-- Today's Earnings -->
            <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings</h6>
                </div>                  
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Referral
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>       

    </div>
</template>

<script>
    import QuickCard from '../components/QuickCard.vue'

    export default {
        name: 'DashboardPage',
        props: {
            roomStatuses: {
                type: Object
            }
        },
        components: {
            QuickCard,
        },
        mounted() {
            console.log('Component mounted.')
            console.log(this.roomStatuses)
        },
        computed: {
            roomsCheckedPercentage() {
                return Math.round((this.roomStatuses.room_statuses.length / this.roomStatuses.rooms.length) * 100)
            },
            roomsRestocked() {
                let restocked_status = this.roomStatuses.statuses.find(status => status.status_name === 'Restocked')
                return this.roomStatuses.room_statuses.filter(room_status => {
                    room_status.status.find(status => status == restocked_status.id)
                }).length
            }
        }
    }
</script>
