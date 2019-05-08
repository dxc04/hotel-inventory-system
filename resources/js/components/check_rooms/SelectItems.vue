<template>
    <b-card no-body>
        <b-tabs card>
            <b-tab  v-for="(category, index) in categories" :title="category.category_name" :key="index" active>
                <b-card-text><item-category :hasSelectedRoom="hasSelectedRoom" :category="category" @update-item="updateItem"></item-category></b-card-text>
            </b-tab>
        </b-tabs>
    </b-card>
</template>

<script>
    import ItemCategory from '../check_rooms/ItemCategory.vue'
    export default {
        name: 'SelectItems',
        props: {
            categories: Object,
            hasSelectedRoom: Boolean
        },
        components: {
            ItemCategory
        },
        mounted() {

        },
        computed: {
            itemCategories() {
                let item_categories = []
                for (let i in this.categories) {
                    for (let index in this.categories[i].items) {
                        let item = this.categories[i].items[index]
                        item_categories.push({
                            item_category_id: item.item_category_id,
                            quantity: item.quantity
                        })
                    }
                }

                return item_categories
            }
        },
        methods: {
            updateItem(item_category_id, qty) {
                let index = this.itemCategories.findIndex(ic => ic.item_category_id == item_category_id)
                this.itemCategories[index].quantity = qty
                let item_cat_data = this.itemCategories.filter(ic => ic.quantity)
                this.$emit('set-room-item-categories', item_cat_data)
            }, 
        }
    }
</script>
