<template>
    <div>
        <b-card no-body>
            <b-tabs card>
                <b-tab  v-for="(category, index) in categories" :title="category.category_name" :key="index" active>
                    <b-card-text><item-category :category="category" @update-selected-items="updateSelectedItems"></item-category></b-card-text>
                </b-tab>
            </b-tabs>
        </b-card>
    </div>
</template>

<script>
    import ItemCategory from '../check_rooms/ItemCategory.vue'
    export default {
        name: 'SelectItems',
        props: {
            categories: Object
        },
        data() {
            return {
                selected: []
            }
        },
        components: {
            ItemCategory
        },
        mounted() {

        },
        computed: {
        },
        methods: {
            inputGuestName() {
                this.$emit('input-guest-name', this.guest)
            },
            selectStatus() {
                this.$emit('select-status', this.status)
            },
            updateSelectedItems(index, value, action) {
                if (action == 'add') {
                    this.selected[index] = {item_category_id: index, quantity: value}
                } else {
                    this.$delete(this.selected, index)
                }
            }
        }
    }
</script>
