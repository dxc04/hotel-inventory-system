<template>
    <b-card no-body>
        <b-tabs card>
            <b-tab  v-for="(category, index) in categories" :title="category.category_name" :key="index" active>
                <b-card-text><item-category :category="category" @update-item="updateItem"></item-category></b-card-text>
            </b-tab>
        </b-tabs>
    </b-card>
</template>

<script>
    import ItemCategory from '../check_rooms/ItemCategory.vue'
    export default {
        name: 'SelectItems',
        props: {
            categories: Object
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
                        item_categories[item.item_category_id] = 0
                    }
                }

                return item_categories
            }
        },
        methods: {
            updateSelectedItems(item_category_id, qty) {
                this.item_categories[item_category_id] = qty
            },
            updateItem(item_category_id, qty) {
                this.itemCategories[item_category_id] = qty
                this.$emit('set-item-categories', this.itemCategories)
            }, 
        }
    }
</script>
