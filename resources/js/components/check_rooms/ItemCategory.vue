<template>
    <div>
        <div class="category-item-list" v-for="(item, index) in category.items" :key="index">
            <item @update-item="updateItem" :item="item"></item>
        </div>
    </div>
</template>

<script>
    import Item from '../check_rooms/Item.vue'

    export default {
        name: 'ItemCategory',
        props: {
            category: Array
        },
        mounted() {
        },
        components: {
            Item
        },
        methods: {
            updateItem(item_category_id, qty) {
                this.$emit('update-item', item_category_id, qty)
            },          
        }
    }
</script>

