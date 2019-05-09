<template>
    <b-card no-body>
        <b-tabs card>
            <b-tab  v-for="(category, index) in categories" :key="index">
                <template slot="title">
                    <strong>{{ category.category_name }}</strong>
                    <span class="ml-2 badge badge-primary badge-pill">{{ selectedCount(category.category_id) }}</span>
                </template>
                <b-card-text><item-category :hasSelectedRoom="hasSelectedRoom" :category="category" @update-item="updateItem"></item-category></b-card-text>
            </b-tab>
        </b-tabs>
    </b-card>
</template>

<script>
    import ItemCategory from '../check_rooms/ItemCategory.vue'
    import { mapGetters } from 'vuex'

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
            ...mapGetters({
                roomsData: 'getRoomsData',
            }),
            selectedItemCategories() {
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
            },
            itemCategories() {
                let ics_data = this.roomsData.item_categories
                let ics = ics_data.reduce((acc, ics) => {
                    acc[ics.id] = ics
                    return acc
                }, {})

                return ics
            },
        },
        methods: {
            updateItem(item_category_id, qty) {
                let index = this.selectedItemCategories.findIndex(ic => ic.item_category_id == item_category_id)
                this.selectedItemCategories[index].quantity = qty
                let item_cat_data = this.selectedItemCategories.filter(ic => ic.quantity)
                this.$emit('set-room-item-categories', item_cat_data)
            }, 
            selectedCount(category_id) {
                return this.selectedItemCategories.filter(ic => {
                    let icat = this.itemCategories[ic.item_category_id]
                    return icat.category_id == category_id && ic.quantity
                }).length
            }
        }
    }
</script>
