<template>
    <b-card no-body>
        <b-tabs card>
            <b-tab  v-for="(category, index) in categories" :title="category.category_name" :key="index" active>
                <b-card-text>
                    <restock-item-category
                        :hasSelectedRoom="true"
                        :rooms="category.rooms" 
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
        mounted() {
           console.log('dixie props', this.categories) 
        },
        computed: {
            roomRestockItemCategories() {
                let room_restock_item_categories = []
                for (let i in this.categories) {
                    for (let rid in this.categories[i].rooms) {
                        for (let index in this.categories[i][rid].items) {
                            let item = this.categories[i][rid].items[index]
                            room_restock_item_categories.push({
                                room_id: rid,
                                item_category_id: item.item_category_id,
                                quantity: 0
                            })
                        }
                    }
                }
                return room_restock_item_categories
            }
        },
        methods: {
            updateItem(room_id, item_category_id, qty) {
                let index = this.roomRestockItemCategories.findIndex(ic => (ic.item_category_id == item_category_id && ic.room_id == room_id))
                this.roomRestockItemCategories[index].quantity = qty
                let item_cat_data = this.roomRestockItemCategories.filter(ic => ic.quantity)
                this.$emit('set-room-restock-item-categories', item_cat_data)
            }, 
        }
    }
</script>
