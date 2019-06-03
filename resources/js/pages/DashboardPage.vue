<template>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
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
                    <daily-logs :dailyLogsData="dailyLogsData"></daily-logs> 
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

        <!-- Content Row -->

        <div class="row">

            <!-- Purchases -->
            <div class="col-xl-8 col-md-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Item Purchases</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <b-table striped hover 
                        :items="itemPurchases" 
                        :current-page="itemPurchasesData.currentPage"
                        :per-page="itemPurchasesData.perPage">

                        <template slot="actions" slot-scope="row">
                            <b-button v-if="!row.item.actions.was_stocked"
                                pill
                                variant="success"
                                size="sm"
                                @click="addToStock(row.item.actions)"
                                >
                                Stock
                            </b-button>
                        </template>
                    </b-table>
                    <b-row>
                        <b-col md="6" class="my-1">
                            <b-pagination
                                v-model="itemPurchasesData.currentPage"
                                :total-rows="itemPurchasesData.totalRows"
                                :per-page="itemPurchasesData.perPage"  
                                class="my-0"
                            ></b-pagination>
                        </b-col>
                    </b-row>
                </div>
              </div>
            </div>

            <!-- Item Stocks -->
            <div class="col-xl-4 col-md-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Item Stocks</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <b-table striped hover 
                        :items="itemStocks" 
                        :current-page="itemStocksData.currentPage"
                        :per-page="itemStocksData.perPage">
                    </b-table>
                    <b-row>
                        <b-col md="6" class="my-1">
                            <b-pagination
                                v-model="itemStocksData.currentPage"
                                :total-rows="itemStocksData.totalRows"
                                :per-page="itemStocksData.perPage"  
                            class="my-0"
                            ></b-pagination>
                        </b-col>
                    </b-row>
                </div>
              </div>
            </div>            

        </div>   
        <vue-snotify></vue-snotify>
    </div>
</template>

<script>
    import QuickCard from '../components/QuickCard.vue'
    import QuickList from '../components/QuickList.vue'
    import DailyLogs from '../components/dashboard/DailyLogs.vue'
    import SalesChart from '../charts/SalesChart.js'
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: 'DashboardPage',
        components: {
            QuickCard,
            QuickList,
            SalesChart,
            DailyLogs
        },
        data() {
            return {
                notifyOptions: {
                    timeout: 3000,
                    showProgressBar: false,
                    closeOnClick: false,
                    position: 'rightTop',
                },
                itemPurchasesData : {
                    currentPage: 1,
                    perPage: 10,
                    totalRows: 1,
                },
                itemStocksData : {
                    currentPage: 1,
                    perPage: 10,
                    totalRows: 1,
                },                
            }
        },
        computed: {
            ...mapGetters({
                roomsData: 'getRoomsData'
            }),
            itemPurchases() {
                return this.roomsData.purchases.map(purchase => {
                    let was_stocked = purchase.status == 'Stocked'
                    let item = this.items[purchase.item_id]
                    let row = {
                        supplier: this.suppliers[purchase.supplier_id].supplier_name,
                        item: item.item_name,
                        quantity: purchase['quantity'],
                        status: purchase['status'],
                        ordered_last: purchase['created_at'],
                        actions: {
                            purchase_id: purchase.id, 
                            was_stocked,
                            item_id: item.id,
                            quantity: purchase['quantity']
                        }
                    }
                    return row
                })
            },
            itemStocks() {
                return this.roomsData.item_stocks.map(is => {
                    let row = {
                        item: this.items[is.item_id].item_name,
                        stock_quantity: is.stock_quantity
                    }
                    return row
                })                
            },
            items() {
                let items = this.roomsData.items.reduce(function (acc, obj) {
                    var key = obj['id']
                    acc[key] = obj
                    return acc
                }, {})

                return items
            },
            suppliers() {
                let suppliers = this.roomsData.suppliers.reduce(function (acc, obj) {
                    var key = obj['id']
                    acc[key] = obj
                    return acc
                }, {})

                return suppliers
            },
            roomsChecked() {
                let rooms = this.roomsData.room_statuses.reduce(function (acc, obj) {
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
                let restocked_status = this.roomsData.statuses.find(status => status.status_name === 'Restocked')
                let rooms = this.roomsData.room_statuses.filter(room_status => {
                    return room_status.status.find(status => status == restocked_status.id)
                })
                return rooms
            },
            dndRooms() {
                let dnd_statuses = this.roomsData.statuses.reduce((acc, status) => {
                    if (status.status_name === 'DND Due-Out' || status.status_name === 'DND Stayover') {
                        acc.push(status.id)
                    }
                    return acc
                }, [])
                
                let rooms = this.roomsData.room_statuses.filter(room_status => {
                    let with_dnd = room_status.status.find(status => {
                        let id = parseInt(status)
                        return dnd_statuses.includes(id)
                    })
                    return with_dnd
                })
                return rooms
            },
            salesByRooms() {
                let sales = this.roomsData.sales.reduce(function (acc, obj) {
                    var key = obj['room_id'];
                    if (!acc[key]) {
                        acc[key] = [];
                    }
                    acc[key].push(obj);
                    return acc;
                }, {})
                return sales;
            },
            salesByItems() {
                let ics = this.roomsData.item_categories.reduce(function (acc, obj) {
                    var key = obj['id']
                    acc[key] = obj
                    return acc
                }, {})
                let items = this.items
                let sales = this.roomsData.sales.reduce(function (sale_items, obj) {
                    let item_id = ics[obj['item_category_id']]['item_id']
                    let item = items[item_id]
                    let item_amount = obj['quantity'] * item.amount
                    if (name in sale_items) {
                        sale_items[item.item_name] = sale_items[item.item_name] + item_amount
                    }
                    else {
                        sale_items[item.item_name] = item_amount
                    }
                    return sale_items
                }, {})

                return sales
            },
            salesChartData() {
                let chart_data = {
                    labels: Object.keys(this.salesByItems),
                    datasets: [{
                        data: Object.values(this.salesByItems),
                        backgroundColor: function () { 
                            return '#' + (Math.random().toString(16) + '0000000').slice(2, 8); 
                        }
                    }]
                }
                return chart_data
            },
            roomsCheckedPercentage() {
                return Object.keys(this.roomsChecked).length
                    ? Math.round((Object.keys(this.roomsChecked).length / this.roomsData.rooms.length) * 100)
                    : 0
            },
            roomsRestockedCount() {
                return this.roomsRestocked.length
            },
            roomsWithSalesCount() {
                return Object.keys(this.salesByRooms).length
            },
            dndRoomsCount() {
                return this.dndRooms.length
            },
            roomsCheckedDetails() {
                let rooms = []
                for (let i in this.roomsChecked) {
                    let room = this.roomsData.rooms.find(room => room.id == i)
                    rooms.push({Room: room.room_name})
                }
                return rooms;
            },
            roomsRestockedDetails() {
                let rooms = []
                for (let i in this.roomsRestocked) {
                    let room = this.roomsData.rooms.find(room => this.roomsRestocked[i].room_id == room.id)
                    rooms.push({Room: room.room_name})
                }
                return rooms;
            },
            roomsWithSalesDetails() {
                let rooms = []
                for (let i in this.salesByRooms) {
                    let room = this.roomsData.rooms.find(room => room.id == i)
                    rooms.push({Room: room.room_name})
                }
                return rooms;
            },
            dndRoomsDetails() {
                let rooms = []
                for (let i in this.dndRooms) {
                    let room = this.roomsData.rooms.find(room => this.dndRooms[i].room_id == room.id)
                    rooms.push({Room: room.room_name})
                }
                return rooms;
            },
            dailyLogsData() {
                let statuses = this.roomsData.statuses
                let rooms = this.roomsData.rooms
       
                let daily_logs_data = this.roomsData.room_statuses.reduce(function (room_status, obj) {
                    let daily_logs = {room: rooms.find(room => room.id == obj.room_id).room_name, room_status: []}

                    for (let id in obj.status) {
                        if (obj.status[id]) {
                            let status = statuses.find(status => status.id == obj.status[id])
                            daily_logs.room_status.push({status_key: status.status_key, status_name: status.status_name})
                        }
                    }
                    room_status.push(daily_logs)
                    return room_status
                }, [])

                return daily_logs_data
            },
        },
        methods: {
            ...mapActions({
                loadRoomStatus: 'loadRoomStatus',
                addItemStock: 'addItemStock'
            }),
            addToStock(data) {
                this.$snotify.async('Processing request...', 'Request Sent', () => new Promise((resolve, reject) => {                     
                    this.addItemStock(data)
                        .then(res => {
                            this.$snotify.success('Purchased item was successfully stocked!', this.notifyOptions)
                        })
                        .finally(() => {
                            this.reset()
                        })
                }), this.notifyOptions)   
            }
        },
        beforeRouteEnter(to, from, next) {
            next(vm => vm.loadRoomStatus())
        },
    }
</script>
