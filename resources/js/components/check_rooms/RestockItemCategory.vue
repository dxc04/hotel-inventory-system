<template>
    <div>
        <div v-for="(room, rid) in rooms" :key="rid + '_' + category.id">
            <div class="mt-3 pb-0 pl-2 border-left-success"><h4 class="mb-0 pb-0">{{ room.room.room_name }}</h4></div>

            <restock-item v-for="(item, index) in room.items" :key="index + '_' + rid" 
                @update-item="updateItem" :item="item" :room="room.room" :stocks-left="stocksLeft(item)">
            </restock-item>
        </div>
    </div>
</template>

<script>
    import RestockItem from '../check_rooms/RestockItem.vue'

    export default {
        name: 'RestockItemCategory',
        props: {
            category: Object,
            rooms: Object,
            itemStocks: Object,
        },
        components: {
            RestockItem
        },
        computed: {

        },
        methods: {
            updateItem(room_id, item_category_id, item_id, quantity) {
                this.$emit('update-item', room_id, item_category_id, item_id, quantity)
            },
            stocksLeft(item) {
                return this.itemStocks[item.item_id].qty
            }
        }
    }
</script>

