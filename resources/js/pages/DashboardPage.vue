<template>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

          <!-- Content Row -->
        <div class="row">
            <!-- Rooms Rechecked Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <quick-card theme="info" title="Rooms Checked" :info="roomsCheckedPercentage" :progress="roomsCheckedPercentage" dashboard-icon="fa-clipboard-list"></quick-card>
            </div>

            <!-- Rooms Restocked Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <quick-card theme="primary" title="Rooms Restocked" :info="roomsRestocked" dashboard-icon="fa-box"></quick-card>
            </div>

            <!-- Rooms with Sales Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <quick-card theme="success" title="Rooms with Sales" :info="roomsWithSales" dashboard-icon="fa-file-invoice-dollar"></quick-card>
            </div>

            <!-- DND Rooms Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <quick-card theme="warning" title="DND Rooms" :info="dndRooms" dashboard-icon="fa-door-closed"></quick-card>
            </div>
        </div>

        <!-- Content Row -->

          <div class="row">

            <!-- Today's Logs -->
            <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Today's Logs</h6>
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
                    <h6 class="m-0 font-weight-bold text-primary">Today's Sales</h6>
                </div>                  
                <!-- Card Body -->
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <sales-chart :chartData="salesChartData"></sales-chart> 
                  </div>
                </div>
              </div>
            </div>
          </div>       

    </div>
</template>

<script>
    import QuickCard from '../components/QuickCard.vue'
    import SalesChart from '../charts/SalesChart.js'

    export default {
        name: 'DashboardPage',
        components: {
            QuickCard,
            SalesChart
        },
        props: {
            roomStatuses: {
                type: Object
            }
        },
        mounted() {
            console.log('Component mounted.')
            console.log(this.roomStatuses)
        },
        computed: {
            roomsCheckedPercentage() {
                return this.roomStatuses.room_statuses.length
                    ? Math.round((this.roomStatuses.room_statuses.length / this.roomStatuses.rooms.length) * 100)
                    : 0
            },
            roomsRestocked() {
                let restocked_status = this.roomStatuses.statuses.find(status => status.status_name === 'Restocked')
                return this.roomStatuses.room_statuses.filter(room_status => {
                    room_status.status.find(status => status == restocked_status.id)
                }).length
            },
            roomsWithSales() {
                return Object.keys(this.purchasesByRooms).length

            },
            dndRooms() {
                let dnd_statuses = this.roomStatuses.statuses.reduce((acc, status) => {
                    if (status.status_name === 'DND Due-Out' || status.status_name === 'DND Stayover') {
                        acc.push(status.id)
                    }
                    return acc
                }, [])
                
                return this.roomStatuses.room_statuses.filter(room_status => {
                    let with_dnd = room_status.status.find(status => {
                        let id = parseInt(status)
                        return dnd_statuses.includes(id)
                    })
                    return with_dnd
                }).length
            },
            purchasesByRooms() {
                let purchases = this.roomStatuses.purchases.reduce(function (acc, obj) {
                    var key = obj['room_id'];
                    if (!acc[key]) {
                        acc[key] = [];
                    }
                    acc[key].push(obj);
                    return acc;
                }, {})
                return purchases;
            },
            purchasesByItems() {
                let items = this.roomStatuses.items.reduce(function (acc, obj) {
                    var key = obj['id']
                    acc[key] = obj
                    return acc
                }, {})

                let purchases = this.roomStatuses.purchases.reduce(function (purchase_items, obj) {
                    let item = items[obj['item_id']]
                    let item_amount = obj['quantity'] * item.amount
                    if (name in purchase_items) {
                        purchase_items[item.item_name] = purchase_items[item.item_name] + item_amount
                    }
                    else {
                        purchase_items[item.item_name] = item_amount
                    }
                    return purchase_items
                }, {})

                return purchases
            },
            salesChartData() {
                let chart_data = {
                    labels: Object.keys(this.purchasesByItems),
                    datasets: [{
                        data: Object.values(this.purchasesByItems),
                        backgroundColor: function () { 
                            return '#' + (Math.random().toString(16) + '0000000').slice(2, 8); 
                        }
                    }]
                }
                return chart_data
            }
        }
    }
</script>
