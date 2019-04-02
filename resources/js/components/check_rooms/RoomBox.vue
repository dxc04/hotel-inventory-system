<template>
    <button type="button" class="btn btn-secondary btn-lg" @click="selectRoom()">{{ room.room_name }}</button>
</template>

<script>
    export default {
        name: 'RoomBox',
        props: {
            room: { 
                type: Object,
                required: true
            }
        },
        computed: {
        },
        methods: {
            selectRoom() {
                this.$emit('select-room', this.room)
            }
        }
    }
</script>
