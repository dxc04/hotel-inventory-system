<template>
    <div>
        <b-card no-body>
            <b-tabs card>
                <b-tab  v-for="(category, index) in categories" :title="category.category_name" :key="index" active>
                    <b-card-text><item-category :category_id="category.id"></item-category></b-card-text>
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
            categories: Array
        },
        data() {
            return {
                selected: [], // Must be an array reference!
                options: [
                    { text: 'Orange', value: 'orange' },
                    { text: 'Apple', value: 'apple' },
                    { text: 'Pineapple', value: 'pineapple' },
                    { text: 'Grape', value: 'grape' }
                ]
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
        }
    }
</script>
