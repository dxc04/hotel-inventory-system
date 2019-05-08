<template>
    <div>
        <div v-for="(room, rid) in rooms" :key="rid">
            <div class="mt-2 pb-0"><h4 class="mb-0 pb-0">{{ room.room.room_name }}</h4></div>
            <div class="category-item-list" v-for="(item, index) in room.items" :key="index">
                <item @update-item="updateItem" :item="item" :hasSelectedRoom="hasSelectedRoom" :isForRestock="isForRestock"></item>
            </div>
        </div>
    </div>
</template>

<script>
    import Item from '../check_rooms/Item.vue'

    export default {
        name: 'RestockItemCategory',
        props: {
            rooms: Object,
            hasSelectedRoom: Boolean
        },
        data() {
            return {
                isForRestock: true
            }
        },
        mounted() {
            console.log(rooms)
        },
        components: {
            Item
        },
        computed: {
        },
        methods: {
            updateItem(item_category_id, qty) {
                this.$emit('update-item', item_category_id, qty)
            },    
        }
    }
</script>

