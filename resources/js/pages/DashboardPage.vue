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
                <quick-card 
                    theme="info" title="Rooms Checked"
                    :info="roomsCheckedPercentage"
                    :progress="roomsCheckedPercentage"
                    dashboardIcon="fa-clipboard-list"
                    modalId="rooms-checked"
                >
                    <template v-slot:modal-content>
                        <quick-list theme="info" :items="roomsCheckedDetails"></quick-list>
                    </template>    
                </quick-card>
            </div>

            <!-- Rooms Restocked Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <quick-card
                    modalId="rooms-restocked"
                    theme="primary"
                    title="Rooms Restocked"
                    :info="roomsRestockedCount"
                    dashboardIcon="fa-box"
                >
                    <template v-slot:modal-content>
                        <quick-list :items="roomsRestockedDetails"></quick-list>
                    </template>
                </quick-card>
            </div>

            <!-- Rooms with Sales Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <quick-card
                    modalId="rooms-sales"
                    theme="success"
                    title="Rooms with Sales"
                    :info="roomsWithSalesCount"
                    dashboard-icon="fa-file-invoice-dollar"
                >
                    <template v-slot:modal-content>
                        <quick-list theme="success" :items="roomsWithSalesDetails"></quick-list>
                    </template>
                </quick-card>
            </div>

            <!-- DND Rooms Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <quick-card
                    modalId="dnd-rooms"
                    theme="warning"
                    title="DND Rooms"
                    :info="dndRoomsCount"
                    dashboardIcon="fa-door-closed"
                    >
                    <template v-slot:modal-content>
                        <quick-list theme="warning" :items="dndRoomsDetails"></quick-list>
                    </template>
                </quick-card>
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
                    <daily-logs :daily-logs-data="dailyLogsData"></daily-logs> 
                </div>
              </div>
            </div>

            <!-- Today's Sales -->
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
    import QuickList from '../components/QuickList.vue'
    import DailyLogs from '../components/dashboard/DailyLogs.vue'
    import SalesChart from '../charts/SalesChart.js'

    export default {
        name: 'DashboardPage',
        components: {
            QuickCard,
            QuickList,
            SalesChart,
            DailyLogs
        },
        props: {
            roomStatuses: {
                type: Object
            }
        },
        computed: {
            roomsChecked() {
                let rooms = this.roomStatuses.room_statuses.reduce(function (acc, obj) {
                    var key = obj['room_id'];
                    if (!acc[key]) {
                        acc[key] = [];
                    }
                    acc[key].push(obj);
                    return acc;
                }, {})
                return rooms
            },
            roomsRestocked() {
                let restocked_status = this.roomStatuses.statuses.find(status => status.status_name === 'Restocked')
                let rooms = this.roomStatuses.room_statuses.filter(room_status => {
                    room_status.status.find(status => status == restocked_status.id)
                })
                return rooms
            },
            dndRooms() {
                let dnd_statuses = this.roomStatuses.statuses.reduce((acc, status) => {
                    if (status.status_name === 'DND Due-Out' || status.status_name === 'DND Stayover') {
                        acc.push(status.id)
                    }
                    return acc
                }, [])
                
                let rooms = this.roomStatuses.room_statuses.filter(room_status => {
                    let with_dnd = room_status.status.find(status => {
                        let id = parseInt(status)
                        return dnd_statuses.includes(id)
                    })
                    return with_dnd
                })
                console.log('dnd', rooms)
                return rooms
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
            },
            roomsCheckedPercentage() {
                return Object.keys(this.roomsChecked).length
                    ? Math.round((Object.keys(this.roomsChecked).length / this.roomStatuses.rooms.length) * 100)
                    : 0
            },
            roomsRestockedCount() {
                return this.roomsRestocked.length
            },
            roomsWithSalesCount() {
                return Object.keys(this.purchasesByRooms).length
            },
            dndRoomsCount() {
                return this.dndRooms.length
            },
            roomsCheckedDetails() {
                let rooms = []
                for (let i in this.roomsChecked) {
                    let room = this.roomStatuses.rooms.find(room => room.id == i)
                    rooms.push({Room: room.room_name})
                }
                return rooms;
            },
            roomsRestockedDetails() {
                let rooms = []
                for (let i in this.roomsRestocked) {
                    let room = this.roomsRestocked[i]
                    rooms.push({Room: room.room_name})
                }
                return rooms;
            },
            roomsWithSalesDetails() {
                let rooms = []
                for (let i in this.purchasesByRooms) {
                    let room = this.roomStatuses.rooms.find(room => room.id == i)
                    rooms.push({Room: room.room_name})
                }
                return rooms;
            },
            dndRoomsDetails() {
                let rooms = []
                for (let i in this.dndRooms) {
                    let room = this.roomStatuses.rooms.find(room => this.dndRooms[i].room_id == room.id)
                    rooms.push({Room: room.room_name})
                }
                return rooms;
            },
            dailyLogsData() {
                let statuses = this.roomStatuses.statuses
                let rooms = this.roomStatuses.rooms
                let daily_logs = []
                let daily_logs_data = this.roomStatuses.room_statuses.reduce(function (room_status, obj) {
                    for (let i = 0; i < obj.status.length; i++) {
                        var log = []

                        log['room_status'] = statuses.find(status => status.id == obj.status[i])
                        log['room'] = rooms.find(room => room.id == obj.room_id)

                        daily_logs.push(log)
                    }
                },{})
                return daily_logs
            }
        }
    }
</script>
