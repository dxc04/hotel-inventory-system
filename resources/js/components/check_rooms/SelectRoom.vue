<template>
    <div>
        <div class="row mb-2 ml-1"><h4>Which floor?</h4></div>
        <div class="row mb-4 align-content-center align-items-center center">
            <div class="col-auto pb-2" v-for="floor in floors" :key="floor.id">
                <floor-box :floor="floor" @select-floor="selectFloor" :floorSelected="floorSelected(floor)"></floor-box>
            </div>
        </div>
        <span v-if="selectedFloor">
            <div class="row mb-2 ml-1"><h4>Select a room...</h4></div>
            <div class="row align-content-center align-items-center center">
                <div class="col-auto" v-for="room in roomsBySelectedFloor" :key="room.id">
                    <room-box :room="room" @select-room="selectRoom" :roomSelected="roomSelected(room)"></room-box>
                </div>
            </div>
        </span>
    </div>
</template>

<script>
    import FloorBox from './FloorBox.vue'
    import RoomBox from './RoomBox.vue'

    export default {
        name: 'SelectRoom',
        components: {
            FloorBox,
            RoomBox
        },
        props: {
            rooms: { 
                type: Object,
                required: true
            },
            floors: { 
                type: Array,
                required: true
            },
        },
        data() {
            return {
                selectedFloor: null,
                selectedRoom: null
            }
        },
        mounted() {

        },
        computed: {
            roomsBySelectedFloor() {
                return Object.values(this.rooms).filter(room => room.floor_id == this.selectedFloor.id)
            },
        },
        methods: {
            selectFloor(floor) {
                this.selectedFloor = floor
                this.$emit('select-floor', floor)
            },
            selectRoom(room) {
                this.selectedRoom = room
                this.$emit('select-room', room)
            },
            floorSelected(floor) {
                return this.selectedFloor ? (this.selectedFloor.id == floor.id) : false
            },
            roomSelected(room) {
                return this.selectedRoom ? (this.selectedRoom.id == room.id) : false
            }
        }
    }
</script>
