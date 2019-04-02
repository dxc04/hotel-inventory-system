<template>
    <div>
        <div class="row mb-2 ml-1"><h4>Which floor?</h4></div>
        <div class="row mb-4 align-content-center align-items-center center">
            <div class="col-auto" v-for="floor in floors">
                <floor-box :floor="floor" @select-floor="selectFloor"></floor-box>
            </div>
        </div>
        <span v-if="selectedFloor">
            <div class="row mb-2 ml-1"><h4>Select a room...</h4></div>
            <div class="row align-content-center align-items-center center">
                <div class="col-auto" v-for="room in roomsBySelectedFloor">
                    <room-box :room="room" @select-room="selectRoom"></room-box>
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
                type: Array,
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
            console.log('Select Rooms', this.rooms, this.floors, this.roomsByFloor)
        },
        computed: {
            roomsBySelectedFloor() {
                return this.rooms.filter(room => room.floor_id == this.selectedFloor.id)
            }
        },
        methods: {
            selectFloor(floor) {
                this.selectedFloor = floor
            },
            selectRoom(room) {
                this.selectedRoom = room
                this.$emit('select-room', room)
            }
        }
    }
</script>
