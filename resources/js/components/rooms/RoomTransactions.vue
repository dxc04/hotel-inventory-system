<template>
    <div class="row room-transaction-list">
        <div class="col-4">
            <div class="list-group" id="list-tab" role="tablist">
                <a v-for="room in rooms" class="list-group-item list-group-item-action" :href="getLink(room.id)" data-toggle="list" role="tab">
                    <span>{{ room.room_name }}</span>
                    <span v-if="getSalesCount(room.id)" class="badge badge-primary badge-pill">{{ getSalesCount(room.id) }}</span>
                </a>
            </div>
        </div>
        <div class="col-8">
            <div class="tab-content" id="nav-tabContent">
                <div v-for="room in rooms" :id="getRoomId(room.id)" class="tab-pane fade" role="tabpanel" aria-labelledby="list-profile-list">
                    <transactions :room_id="room.id"></transactions>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Transactions from './Transactions.vue'
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: 'RoomTransactions',
        props: {
            rooms: { 
                type: Array,
                required: true
            },
            transactions: {
                type: Array
            }
        },
        components: {
            Transactions
        },
        computed: {
            ...mapGetters({
                roomsData: 'getRoomsData'
            })
        },
        methods: {
            getLink(id) {
                return '#room_' + id
            },
            getRoomId(id) {
                return 'room_' + id
            },
            getSalesCount(id) {
                let sales = this.roomsData.sales.filter(sale => sale.room_id == id)

                return sales.length
            }
        },
        mounted() {
        }
    }
</script>

<style scoped>
    .row {
        margin-top: 30px;
    }
    .badge {
        float: right;
    }
</style>
