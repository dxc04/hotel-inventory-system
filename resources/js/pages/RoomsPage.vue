<template>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold">Floors</h6>
            </div>
            <div class="card-body">
                <div class="row align-content-center align-items-center center">
                    <div class="col-auto pb-2" v-for="floor in floors">
                        <floor-box :floor="floor" @select-floor="selectFloor" :floorSelected="floorSelected(floor)"></floor-box>
                    </div>
                </div>
                <span v-if="selectedFloor">
                    <room-transactions :rooms="roomsBySelectedFloor"></room-transactions>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    import FloorBox from '../components/check_rooms/FloorBox.vue'
    import RoomTransactions from '../components/rooms/RoomTransactions.vue'
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: 'RoomsPage',
        components: {
            FloorBox,
            RoomTransactions
        },
        data() {
            return {
                selectedFloor: null
            }
        },
        computed: {
            ...mapGetters({
                roomsData: 'getRoomsData'
            }),
            floors() {
                return this.roomsData.floors
            },
            roomsBySelectedFloor() {
                return this.roomsData.rooms.filter(room => room.floor_id == this.selectedFloor.id)
            },
        },
        methods: {
            selectFloor(floor) {
                this.selectedFloor = floor
            },
            floorSelected(floor) {
                return this.selectedFloor ? (this.selectedFloor.id == floor.id) : false
            }                              
        }
    }
</script>
