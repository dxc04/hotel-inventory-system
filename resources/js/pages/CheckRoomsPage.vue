<template>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Check Rooms</h1>
    </div>

    <div class="row">
        <div class="flex-column col-sm-12 col-lg-6 mb-4 border-top-info">
            <b-card header="Manage Rooms" header-class="text-primary">

            <div class="row ml-3">
                <div class="col-md-3">
                    <div class="mb-2">
                        <p class="small text-uppercase text-info mb-0"><span class="border-left-success pl-2">Unit</span></p>
                        <p class="text-lg pl-0 ml-0 pt-0">
                            <span v-if="selectedFloor">F{{ selectedFloor.floor_name }}</span>&nbsp;
                            <span v-if="selectedRoom"> - {{ selectedRoom.room_name }}</span>&nbsp;
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-2">
                        <p class="small text-uppercase text-info mb-0"><span class="border-left-success pl-2">Guest</span></p>
                        <p class="text-lg pl-0 ml-0 pt-0"><span v-if="guestName">{{ guestName }}</span>&nbsp;</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-2">
                        <p class="small text-uppercase text-info mb-0"><span class="border-left-success pl-2">Status</span></p>
                        <p class="text-lg pl-0 ml-0 pt-0"><span v-if="status">{{ status }}&nbsp;</span></p>
                    </div>
                </div>
            </div>

                <div class="row justify-content-center border-top ml-2 mr-2 pt-4">
                    <div class="col-md-4 text-center justify-center mb-3">
                        <a href="#" 
                            v-bind:class="getBtnCss('post-sale')"
                            @click="sale">
                            <font-awesome-icon class="justify-center" :icon="fileInvoiceDollar"/>
                        </a>
                        <div class="mt-2">Post Sale</div>
                    </div>
                    <div class="col-md-4 text-center justify-center mb-3">
                        <a href="#"
                            v-bind:class="getBtnCss('no-sale')"
                            @click="noSale">
                            <font-awesome-icon :icon="minusSquare"/>
                        </a>
                        <div class="mt-2">No Sale</div>
                    </div>
                    <div class="col-md-4 text-center justify-center mb-3">
                        <a href="#"
                            v-bind:class="getBtnCss('dnd-due-out')"
                            @click="DNDDueOut">
                            <font-awesome-icon :icon="doorClosed"/>
                        </a>                    
                        <div class="mt-2">DND Due Out</div>
                    </div>
                    <div class="col-md-4 text-center justify-center mb-3">
                        <a href="#"
                            v-bind:class="getBtnCss('dnd-stayover')"
                            @click="DNDStayover">
                            <font-awesome-icon :icon="doorClosed"/>
                        </a> 
                        <div class="mt-2">DND Stayover</div>
                    </div>
                    <div class="col-md-4 text-center justify-center mb-3">
                        <a href="#"
                            v-bind:class="getBtnCss('item-reject')"
                            @click="itemReject">
                            <font-awesome-icon :icon="timesCircle"/>
                        </a>                     
                        <div class="mt-2">Item Reject</div>
                    </div>
                    <div class="col-md-4 text-center justify-center mb-3">
                        <a href="#"
                            v-bind:class="getBtnCss('extra-sale')"
                            @click="extraSale">
                            <font-awesome-icon :icon="dollarSign"/>
                        </a>  
                        <div class="mt-2">Extra Sale</div>
                    </div>
                </div>

                <div role="tablist">
                    <b-card no-body class="mb-1">
                        <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-button block href="#" v-b-toggle.accordion-1 variant="default">Select a Room</b-button>
                        </b-card-header>
                        <b-collapse id="accordion-1" visible accordion="my-accordion" role="tabpanel">
                            <b-card-body>
                                <select-room :rooms="rooms" :floors="floors" @select-room="setSelectedRoom" @select-floor="setSelectedFloor"></select-room>
                            </b-card-body>
                        </b-collapse>
                    </b-card>

                    <b-card no-body class="mb-1">
                        <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-button block href="#" v-b-toggle.accordion-2 variant="default"><span class="text-left">Add Guest Info</span></b-button>
                        </b-card-header>
                        <b-collapse id="accordion-2" accordion="my-accordion" role="tabpanel">
                            <b-card-body>
                                <add-guest-info :guest="this.guestName" :status="this.status" @input-guest-name="inputGuestName"
                                    @select-status="selectStatus">
                                </add-guest-info>
                            </b-card-body>
                        </b-collapse>
                    </b-card>
                </div>
                <div role="tablist">
                    <b-card no-body class="mb-1">
                        <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-button block href="#" v-b-toggle.accordion-3 variant="default">Select Items</b-button></b-button>
                        </b-card-header>
                        <b-collapse id="accordion-3" visible accordion="my-accordion1" role="tabpanel">
                            <b-card-body class="m-0 p-0">
                                <select-items 
                                    :hasSelectedRoom="hasSelectedRoom" :categories="roomCategories()"
                                    @set-room-item-categories="setRoomItemCategories">
                                </select-items>
                            </b-card-body>
                        </b-collapse>
                    </b-card>
                </div>
            </b-card>
        </div>
        <div class="flex-column col-sm-12 col-lg-6">
            <b-card header="Restock Rooms" header-class="text-primary">
                <div v-if="roomRestockCategories()">
                    <div class="row">
                        <div class="ml-5 mr-5 mb-3 col-auto text-center justify-center">
                            <a href="#"
                                v-bind:class="getBtnCss('restock')"
                                @click="restock">
                                <font-awesome-icon :icon="clipboardCheck"/>
                            </a>  
                            <div class="mt-2">Restock</div>
                        </div>
                    </div>
                    <restock-items 
                        :categories="roomRestockCategories()"
                        @set-room-restock-item-categories="setRoomRestockItemCategories">
                    </restock-items>
                </div>
                <div v-else class="text-center justify-center no-restock">
                    <font-awesome-icon size="3x" :icon="box"/> <h3>Nothing to Restock</h3>
                </div> 
            </b-card>
        </div>
    </div>
    <vue-snotify></vue-snotify>
</div>
</template>

<script>

    import SelectRoom from '../components/check_rooms/SelectRoom.vue'
    import AddGuestInfo from '../components/check_rooms/AddGuestInfo.vue'
    import SelectItems from '../components/check_rooms/SelectItems.vue'
    import RestockItems from '../components/check_rooms/RestockItems.vue'
    import { faFileInvoiceDollar, faMinusSquare, faDoorClosed, faTimesCircle,
        faCommentDollar, faDollarSign, faClipboardCheck, faBox } from '@fortawesome/free-solid-svg-icons'
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: 'CheckRoomsPage',
        components: { 
            SelectRoom,
            AddGuestInfo,
            SelectItems,
            RestockItems
        },
        mounted() {
        },
        data() {
            return {
                notifyOptions: {
                    timeout: 3000,
                    showProgressBar: false,
                    closeOnClick: false,
                    position: 'rightTop',
                },
                fileInvoiceDollar: faFileInvoiceDollar,
                minusSquare: faMinusSquare,
                doorClosed: faDoorClosed,
                timesCircle: faTimesCircle,
                dollarSign: faDollarSign,
                clipboardCheck: faClipboardCheck,
                box: faBox,
                selectedFloor: null,
                selectedRoom: null,
                guestName: null,
                status: null,
                roomItemCategories: [],
                roomRestockItemCategories: [],

            }
        },
        computed: {
            ...mapGetters({
                roomsData: 'getRoomsData',
            }),
            floors() {
                return this.roomsData.floors
            },
            hasSelectedRoom() {
                return Boolean(this.selectedRoom)
            },
            canProcessItem() {
                return Boolean(this.selectedRoom && this.roomItemCategories.length)
            },
            canPostStatus() {
                return Boolean(this.selectedRoom )
            },
            guestInfo() {
                return { guest_name: this.guestName, status: this.status }
            },
            rooms() {
                let rooms_data = this.roomsData.rooms
                let rooms = rooms_data.reduce((acc, room) => {
                    acc[room.id] = room
                    return acc
                }, {})

                return rooms
            },
            items() {
                let items_data = this.roomsData.items
                let items = items_data.reduce((acc, item) => {
                    acc[item.id] = item
                    return acc
                }, {})

                return items                
            },
            categories() {
                let cats_data = this.roomsData.categories
                let cats = cats_data.reduce((acc, cat) => {
                    acc[cat.id] = cat
                    return acc
                }, {})

                return cats
            },
            itemCategories() {
                let ics_data = this.roomsData.item_categories
                let ics = ics_data.reduce((acc, ics) => {
                    acc[ics.id] = ics
                    return acc
                }, {})

                return ics
            },
            roomStocks() {
                let room_stocks_data = this.roomsData.room_stocks
                let room_stocks = room_stocks_data.reduce((acc, stock) => {
                    let room_id = stock.room_id
                    let ic_id = stock.item_category_id
                    if (!acc[room_id]) {
                        acc[room_id] = {}
                    }

                    acc[room_id][ic_id] = stock.stock_quantity
                    return acc
                }, {})

                return room_stocks
            },
            roomStocksLimit() {
                let room_stocks_data = this.roomsData.room_stocks_limit
                let room_stocks_limit = room_stocks_data.reduce((acc, stock) => {
                    let room_id = stock.room_id
                    let ic_id = stock.item_category_id
                    if (!acc[room_id]) {
                        acc[room_id] = {}
                    }

                    acc[room_id][ic_id] = stock.stock_max
                    return acc
                }, {})

                return room_stocks_limit
            },
        },
        methods: {
            ...mapActions([
                'postASale',
                'postNoSale',
                'postDNDDueOut',
                'postDNDStayover',
                'postAnItemReject',
                'postAnExtraSale',
                'postARestock',
                'postActionPosted',
                'loadRoomData'
            ]),
            setSelectedFloor(floor) {
                this.selectedFloor = floor
            },
            setSelectedRoom(room) {
                this.postActionPosted(false)
                this.selectedRoom = room
            },
            inputGuestName(guest_name) {
                this.guestName = guest_name
            },
            selectStatus(status) {
                this.status = status
            },
            setRoomItemCategories(item_categories) {
                this.roomItemCategories = item_categories
            },
            setRoomRestockItemCategories({room_id, item_category_id, quantity}) {
                let selected_id = this.roomRestockItemCategories.findIndex(ic => {
                    return ic.room_id == room_id && ic.item_category_id == item_category_id
                })
                if (selected_id >= 0) {
                    this.roomRestockItemCategories[selected_id]['quantity'] = quantity
                } else {
                    this.roomRestockItemCategories.push({room_id, item_category_id, quantity}) 
                }
            },
            roomCategories() {
                let items = this.items
                let all_item_categories = this.itemCategories
                let sic = this.roomItemCategories.reduce(function (acc, obj) {
                    var key = obj['item_category_id']
                    acc[key] = obj
                    return acc
                }, {})

                let stocks = this.selectedRoom ? this.roomStocks[this.selectedRoom.id] : []
                let item_categories = this.roomsData.categories.reduce(function (category, obj) {
                    let cat = []
                    cat['category_id'] = obj.id
                    cat['category_name'] = obj.category_name
                    cat['items'] = []
                    
                    for (let i in all_item_categories) {
                        let item_category = all_item_categories[i]
                        if (item_category.category_id == obj.id) {
                            let item = items[item_category.item_id]
                            let qty = sic[item_category.id] ? sic[item_category.id].quantity : 0
                            cat['items'].push({
                                item_id: item.id, item_amount: item.amount, item_name: item.item_name,
                                item_category_id: item_category.id, quantity: qty, 
                                stock_count: stocks[item_category.id] ? stocks[item_category.id] : 0
                            })
                        }
                    }
                    category[obj.id] = cat

                    return category
                }, {})

                return item_categories
            },
            roomRestockCategories() {
                let rooms = this.rooms
                let limits = this.roomStocksLimit
                let room_stocks = this.roomStocks
                let categories = this.categories
                let item_categories = this.itemCategories
                let items = this.items

                let sic = this.roomRestockItemCategories.reduce(function (acc, obj) {
                    var key = obj['item_category_id']
                    acc[key] = obj
                    return acc
                }, {})
                
                let item_cats = this.roomsData.room_stocks.reduce((acc, rs) => {
                    let category_id = item_categories[rs.item_category_id].category_id
                    let room = rooms[rs.room_id]
                    if (!acc[category_id]) {
                        acc[category_id] = {
                            category_name: categories[category_id].category_name
                        }
                    }

                    if (rs.stock_quantity < limits[rs.room_id][rs.item_category_id]) {
                        let restock_count = limits[rs.room_id][rs.item_category_id] - rs.stock_quantity
                        if (!acc[category_id]['rooms']) {
                            acc[category_id]['rooms'] = {}
                        }
                        if (!acc[category_id]['rooms'][rs.room_id]) {
                            acc[category_id]['rooms'][rs.room_id] = {room: room, items: []}
                        }
                        let item = items[item_categories[rs.item_category_id].item_id]
                        let idx = this.roomRestockItemCategories.findIndex(rsi => {
                            return rsi.item_category_id == rs.item_category_id && rsi.room_id == rs.room_id
                        })
                        let updated = this.roomRestockItemCategories[idx]
                        let qty = updated ? updated.quantity : 0
                        acc[category_id]['rooms'][rs.room_id]['items'].push({
                            item_id: item.id, item_amount: item.amount, item_name: item.item_name,
                            item_category_id: rs.item_category_id, quantity: qty, restock_count
                        })
                     
                    }

                    return acc
                }, {})

                return item_cats
            },
            reset() {
                this.selectedFloor = null
                this.selectedRoom = null
                this.guestName = null
                this.status = null
                this.roomItemCategories = []
                this.roomRestockItemsCategories = []
                this.wasReset = true
                this.postActionPosted(true)
            },
            sale() {
                if (this.canProcessItem) {
                    let sale_data = {
                        room_id: this.selectedRoom.id,
                        item_categories: this.roomItemCategories
                    }

                    let room_name = this.selectedRoom.room_name
                    this.$snotify.async('Processing request...', 'Request Sent', () => new Promise((resolve, reject) => {
                        this.postASale(sale_data)
                            .then(res => {
                                this.$snotify.success('Sale posted to room ' + room_name + '!', 'Success!', this.notifyOptions)
                            })
                            .catch(err => {
                                reject({
                                    title: 'Error!',
                                    body: 'Something went wrong.',
                                    config: this.notifyOptions
                                })
                            })
                            .finally(() => {
                                this.reset()
                            })
                    }), this.notifyOptions);
                }
                else {
                    this.postProcessItemWarning()
                }
            },
            noSale() {
                if (this.canPostStatus) {
                    let room_name = this.selectedRoom.room_name
                    this.$snotify.async('Processing request...', 'Request Sent', () => new Promise((resolve, reject) => {                    
                        this.postNoSale(this.selectedRoom)
                            .then(res => {
                                this.$snotify.success('No Sale posted to room ' + room_name + '!', 'Success!', this.notifyOptions)                                
                            })
                            .finally(() => {
                                this.reset()
                            })             
                    }), this.notifyOptions)
                } else {
                    this.postStatusWarning()
                }
            },
            DNDDueOut() {
                if (this.canPostStatus) {
                    let room_name = this.selectedRoom.room_name
                    this.$snotify.async('Processing request...', 'Request Sent', () => new Promise((resolve, reject) => {                    
                        this.postDNDDueOut(this.selectedRoom)
                            .then(res => {
                                this.$snotify.success('DND Due Out posted to room ' + room_name + '!', this.notifyOptions)                                
                            })                            
                            .finally(() => {
                                this.reset()
                            })       
                    }), this.notifyOptions)                    
                } else {
                    this.postStatusWarning()
                }
            },
            DNDStayover() {
                if (this.canPostStatus) {
                    let room_name = this.selectedRoom.room_name
                    this.$snotify.async('Processing request...', 'Request Sent', () => new Promise((resolve, reject) => { 
                        this.postDNDStayover(this.selectedRoom)
                            .then(res => {
                                this.$snotify.success('DND Stayover posted to room ' + room_name + '!', this.notifyOptions)                               
                            })
                            .finally(() => {
                                this.reset()
                            })
                    }), this.notifyOptions)
                } else {
                    this.postStatusWarning()
                }
            },
            itemReject() {
                if (this.canProcessItem) {
                    let data = {
                        room_id: this.selectedRoom.id,
                        item_categories: this.roomItemCategories
                    }
                    let room_name = this.selectedRoom.room_name
                    this.$snotify.async('Processing request...', 'Request Sent', () => new Promise((resolve, reject) => {                     
                        this.postAnItemReject(data)
                            .then(res => {
                                this.$snotify.success('Item reject posted to room ' + room_name + '!', this.notifyOptions)
                            })
                            .finally(() => {
                                this.reset()
                            })
                    }), this.notifyOptions)                    
                }
                else {
                    this.postProcessItemWarning()
                }
            },
            extraSale() {
                if (this.canProcessItem) {
                    let data = {
                        room_id: this.selectedRoom.id,
                        item_categories: this.roomItemCategories
                    }
                    let room_name = this.selectedRoom.room_name
                    this.$snotify.async('Processing request...', 'Request Sent', () => new Promise((resolve, reject) => {                     
                        this.postAnExtraSale(data)
                            .then(res => {
                                this.$snotify.success('An extra sale has posted to room ' + room_name + '!', this.notifyOptions)
                            })
                            .finally(() => {
                                this.reset()
                            })
                    }), this.notifyOptions)                     

                }
                else {
                    this.postProcessItemWarning()
                }
            },
            restock() {
                if (this.roomRestockItemCategories.length) {
                    this.$snotify.async('Processing request...', 'Request Sent', () => new Promise((resolve, reject) => {                     
                        this.postARestock(this.roomRestockItemCategories)
                            .then(res => {
                                this.$snotify.success('A restock has posted!', this.notifyOptions)
                            })
                            .finally(() => {
                                this.reset()
                            })
                    }), this.notifyOptions)                     
                }
                else {
                    this.postProcessItemWarning()
                }
            },
            getBtnCss(btn) {
                let btn_state = false
                if (['post-sale', 'item-reject', 'extra-sale'].includes(btn) && this.canProcessItem) {
                    btn_state = true
                } 
                else if (['no-sale', 'dnd-due-out', 'dnd-stayover'].includes(btn) && this.canPostStatus) {
                    btn_state = true    
                } else if (btn =='restock') {
                    btn_state = this.roomRestockItemCategories.length ? true :false
                }

                return {
                    'btn btn-primary btn-circle btn-lg': true,
                    'btn-active' : btn_state,
                    'btn-inactive': !btn_state
                }        
            },
            postStatusWarning() {
                this.$snotify.warning('You need to select a room and input guest information first.', this.notifyOptions)
            },
            postProcessItemWarning() {
                this.$snotify.warning('You need to select a room, add guest information, and select items first.', this.notifyOptions)
            }
        },
        async beforeRouteLeave(to, from, next) {
            await this.loadRoomData()
            next()
        },
    }
</script>

<style scoped>
    .btn-inactive {
        background-color: #c1ced8;
        border-color:  #c1ced8;
        pointer-events: none;
    }

    .btn-active {
        background-color: #1c72b9;
        border-color:  #1c72b9;
    }
    .btn-circle {
        width: 40px;
        height: 40px;
        font-size: 20px;
    }

    .no-restock {
        color: grey;
    }
</style>
