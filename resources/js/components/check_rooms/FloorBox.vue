<template>
    <button type="button" :class="buttonClass" @click="selectFloor()" >{{ floor.floor_name }}</button>
</template>

<script>
    export default {
        name: 'FloorBox',
        props: {
            floor: { 
                type: Object,
                required: true
            },
            floorSelected: {
                type: Boolean,
                required: true
            }
        },
        computed: {
            buttonClass() {
                return {
                    'btn btn-secondary btn-lg': true,
                    'floor-selected': this.floorSelected
                }
            },
        },
        methods: {
            selectFloor() {
                this.$emit('select-floor', this.floor)
            }
        }
    }
</script>

<style scoped>
    .floor-selected {
        background-color: #4caf50;
        border-color: #4caf50;
    }
</style>