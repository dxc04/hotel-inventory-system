<template>
    <div>
        <div class="category-item-list" v-for="(item, index) in category.items" :key="index">
            <item @update-item="updateItem" :item="item" :hasSelectedRoom="hasSelectedRoom"></item>
        </div>
    </div>
</template>

<script>
    import Item from '../check_rooms/Item.vue'

    export default {
        name: 'ItemCategory',
        props: {
            category: Array,
            hasSelectedRoom: Boolean,
        },
        mounted() {
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

