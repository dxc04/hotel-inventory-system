<template>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Check Rooms</h1>
    </div>

    <div class="row ml-3 mb-2">
        <div class="col-2">
            <div class="mb-2">
                <p class="small text-uppercase text-info mb-0"><span class="border-left-success pl-2">Room</span></p>
                <p class="text-lg pl-0 ml-0 pt-0"><span v-if="selectedRoom">{{ selectedRoom.room_name }}</span>&nbsp;</p>
            </div>
        </div>
        <div class="col-2">
            <div class="mb-2">
                <p class="small text-uppercase text-info mb-0"><span class="border-left-success pl-2">Guest</span></p>
                <p class="text-lg pl-0 ml-0 pt-0"><span v-if="guestName">{{ guestName }}</span>&nbsp;</p>
            </div>
        </div>
        <div class="col-2">
            <div class="mb-2">
                <p class="small text-uppercase text-info mb-0"><span class="border-left-success pl-2">Status</span></p>
                <p class="text-lg pl-0 ml-0 pt-0"><span v-if="status">{{ status }}&nbsp;</span></p>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="flex-column col-sm-12 col-md-9">
            <div class="row justify-content-center">
                <div class="col-sm-4 col-md-2 text-center justify-center mb-3">
                    <a href="#" class="btn btn-primary btn-circle btn-lg" @click="postASale()">
                        <font-awesome-icon class="justify-center" :icon="fileInvoiceDollar"/>
                    </a>
                    <div class="mt-2">Post Sale</div>
                </div>
                <div class="col-sm-4 col-md-2 text-center justify-center mb-3">
                    <a href="#" class="btn btn-primary btn-circle btn-lg" @click="postNoSale()">
                        <font-awesome-icon :icon="minusSquare"/>
                    </a>
                    <div class="mt-2">No Sale</div>
                </div>
                <div class="col-sm-4 col-md-2 text-center justify-center mb-3">
                    <a href="#" class="btn btn-primary btn-circle btn-lg" @click="postDNDDueOut()">
                        <font-awesome-icon :icon="doorClosed"/>
                    </a>                    
                    <div class="mt-2">DND Due Out</div>
                </div>
                <div class="col-sm-4 col-md-2 text-center justify-center mb-3">
                    <a href="#" class="btn btn-primary btn-circle btn-lg" @click="postDNDStayover()">
                        <font-awesome-icon :icon="doorClosed"/>
                    </a> 
                    <div class="mt-2">DND Stayover</div>
                </div>
                <div class="col-sm-4 col-md-2 text-center justify-center mb-3">
                    <a href="#" class="btn btn-primary btn-circle btn-lg" @click="postAnItemReject()">
                        <font-awesome-icon :icon="timesCircle"/>
                    </a>                     
                    <div class="mt-2">Item Reject</div>
                </div>
                <div class="col-sm-4 col-md-2 text-center justify-center mb-3">
                    <a href="#" class="btn btn-primary btn-circle btn-lg" @click="postAnExtraSale()">
                        <font-awesome-icon :icon="dollarSign"/>
                    </a>  
                    <div class="mt-2">Extra Sale</div>
                </div>
            </div>
        </div>
        <div class="flex-column col-sm-12 col-md-3">
            <div class="row">
                <div class="ml-5 mr-5 col-auto text-center justify-center">
                    <a href="#" class="btn btn-primary btn-circle btn-lg" @click="postARestock()">
                        <font-awesome-icon :icon="clipboardCheck"/>
                    </a>  
                    <div class="mt-2">Restock</div>
                </div>
            </div>    
        </div>
    </div>  
    <div class="row">
        <div class="flex-column col-sm-12 col-md-9">
            <b-card>
                <div role="tablist">
                    <b-card no-body class="mb-1">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                        <b-button block href="#" v-b-toggle.accordion-1 variant="default">Select a Room</b-button>
                    </b-card-header>
                    <b-collapse id="accordion-1" visible accordion="my-accordion" role="tabpanel">
                        <b-card-body>
                            <select-room :rooms="rooms" :floors="floors" @select-room="setSelectedRoom"></select-room>
                        </b-card-body>
                    </b-collapse>
                    </b-card>

                    <b-card no-body class="mb-1">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                        <b-button block href="#" v-b-toggle.accordion-2 variant="default"><span class="text-left">Add Guest Info</span></b-button>
                    </b-card-header>
                    <b-collapse id="accordion-2" accordion="my-accordion" role="tabpanel">
                        <b-card-body>
                            <add-guest-info @input-guest-name="inputGuestName" @select-status="selectStatus"></add-guest-info>
                        </b-card-body>
                    </b-collapse>
                    </b-card>

                    <b-card no-body class="mb-1">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                        <b-button block href="#" v-b-toggle.accordion-3 variant="default">Select Items</b-button></b-button>
                    </b-card-header>
                    <b-collapse id="accordion-3" accordion="my-accordion" role="tabpanel">
                        <b-card-body>
                            <select-items :categories="categories" @set-item-categories="setItemCategories"></select-items>
                        </b-card-body>
                    </b-collapse>
                    </b-card>
                </div>
            </b-card>
        </div>
        <div class="flex-column col-sm-12 col-md-3">
            <b-card>

            </b-card>
        </div>
    </div>
</div>
</template>

<script>

    import SelectRoom from '../components/check_rooms/SelectRoom.vue'
    import AddGuestInfo from '../components/check_rooms/AddGuestInfo.vue'
    import SelectItems from '../components/check_rooms/SelectItems.vue'
    import { faFileInvoiceDollar, faMinusSquare, faDoorClosed, faTimesCircle,
        faCommentDollar, faDollarSign, faClipboardCheck } from '@fortawesome/free-solid-svg-icons'
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: 'CheckRoomsPage',
        components: {
            SelectRoom,
            AddGuestInfo,
            SelectItems
        },
        mounted() {
        },
        data() {
            return {
                text: `
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                `,
                fileInvoiceDollar: faFileInvoiceDollar,
                minusSquare: faMinusSquare,
                doorClosed: faDoorClosed,
                timesCircle: faTimesCircle,
                dollarSign: faDollarSign,
                clipboardCheck: faClipboardCheck,
                selectedRoom: null,
                guestName: null,
                status: null,
                itemCategories: {}
            }
        },
        computed: {
            ...mapGetters({
                roomsData: 'getRoomsData'
            }),
            rooms() {
                return this.roomsData.rooms
            },
            floors() {
                return this.roomsData.floors
            },
            categories() {
                let items = this.roomsData.items
                let all_item_categories = this.roomsData.item_categories
                let item_categories = this.roomsData.categories.reduce(function (category, obj) {
                    let cat = []
                    cat['category_id'] = obj.id
                    cat['category_name'] = obj.category_name
                    cat['items'] = []
                    
                    for (let i in all_item_categories) {
                        let item_category = all_item_categories[i]
                        if (item_category.category_id == obj.id) {
                            let item = items.find(item => item_category.item_id == item.id)
                            cat['items'].push({item_id: item.id, item_amount: item.amount, item_name: item.item_name, item_category_id: item_category.id})
                        }
                    }
                    category[obj.id] = cat

                    return category
                }, {})

                return item_categories
            }
        },
        methods: {
            ...mapActions([
                'postASale',
                'postNoSale',
                'postDNDDueOut',
                'postDNDStayover',
                'postAnItemReject',
                'postAnExtraSale',
                'postARestock'
            ]),
            setSelectedRoom(room) {
                this.selectedRoom = room
            },
            inputGuestName(guest_name) {
                this.guestName = guest_name
            },
            selectStatus(status) {
                this.status = status
            },
            setItemCategories(item_categories) {
                this.itemCategories = item_categories
            }
        }
    }
</script>
