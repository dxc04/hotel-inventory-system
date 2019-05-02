<template>
    <button type="button" :class="buttonClass" @click="selectRoom()">{{ room.room_name }}</button>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

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
            ...mapGetters({
                actionPosted: 'getActionPosted'
            }),
            buttonClass() {
                return {
                    'btn btn-secondary btn-lg': true,
                    'room-selected': this.getRoomSelected
                }
            },
            getRoomSelected() {
                return this.roomSelected && !this.actionPosted
            }
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
