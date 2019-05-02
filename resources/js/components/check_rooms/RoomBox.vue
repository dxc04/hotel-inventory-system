<template>
    <button type="button" :class="buttonClass" @click="selectRoom()">{{ room.room_name }}</button>
</template>

<script>
    export default {
        name: 'RoomBox',
        props: {
            room: { 
                type: Object,
                required: true
            },
            roomSelected: {
                type: Boolean,
                required: true
            }
        },
        computed: {
            buttonClass() {
                return {
                    'btn btn-secondary btn-lg p-2': true,
                    'room-selected': this.roomSelected
                }
            },
        },
        methods: {
            selectRoom() {
                this.$emit('select-room', this.room)
            }
        }
    }
</script>


<style scoped>
    .room-selected {
        background-color: #4caf50;
        border-color: #4caf50;
    }
</style>