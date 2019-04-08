<template>
    <div>
        <div class="category-item-list" v-for="(item, index) in category.items" :key="index">
            <item  @update-selected-items="updateSelectedItem" :item="item""></item>
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
        data() {
            return {
                disabled: 0
            }
        },
        components: {
            Item
        },
        computed: {
            
        },
        methods: {
            updateSelectedItem(index, value, action) {
                this.$emit('update-selected-items', index, value, action)
            },          
        }
    }
</script>

