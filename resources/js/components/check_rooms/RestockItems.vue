<template>
    <b-card no-body>
        <b-tabs card>
            <b-tab  v-for="(category, index) in categories" :title="category.category_name" :key="index">
                <b-card-text>
                    <restock-item-category
                        :rooms="category.rooms"
                        :category="category"
                        @update-item="updateItem">
                    </restock-item-category>
                </b-card-text>
            </b-tab>
        </b-tabs>
    </b-card>
</template>

<script>
    import RestockItemCategory from '../check_rooms/RestockItemCategory.vue'
    export default {
        name: 'RestockItems',
        props: {
            categories: Object
        },
        components: {
            RestockItemCategory
        },
        methods: {
            updateItem(room_id, item_category_id, quantity) {
                this.$emit('set-room-restock-item-categories', {room_id, item_category_id, quantity})
            }, 
        }
    }
</script>
