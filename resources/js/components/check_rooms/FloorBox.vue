<template>
    <button type="button" class="btn btn-info btn-lg" @click="selectFloor()">{{ floor.floor_name }}</button>
</template>

<script>
    export default {
        name: 'FloorBox',
        props: {
            floor: { 
                type: Object,
                required: true
            },
        },
        computed: {
        },
        methods: {
            selectFloor() {
                this.$emit('select-floor', this.floor)
            }
        }
    }
</script>
