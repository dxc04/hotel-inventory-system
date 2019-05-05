<template>
    <div v-if="getSales.length">
        <div><h4 class="m-0 font-weight-bold">Sales</h4></div>
        <div class="row sales-header">
            <div class="col-sm-3">
                <h6 class="m-0 font-weight-bold">Location</h6>
            </div>
            <div class="col-sm-3">
                <h6 class="m-0 font-weight-bold">Item</h6>
            </div>
            <div class="col-sm-3">
                <h6 class="m-0 font-weight-bold">Price</h6>
            </div>
            <div class="col-sm-3">
                <h6 class="m-0 font-weight-bold">Quantity</h6>
            </div>
        </div>
        <div class="row" v-for="room_sale in getRoomSales">
            <div class="col-sm-3">{{ room_sale.category.category_name }}</div>
            <div class="col-sm-3">{{ room_sale.item.item_name}}</div>
            <div class="col-sm-3">{{ itemPrice(room_sale.item.amount) }}</div>
            <div class="col-sm-3">{{ room_sale.quantity }}</div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: 'Transactions',
        props: {
            room_id: { 
                type: Number,
                required: true
            }
        },
        computed: {
            ...mapGetters({
                roomsData: 'getRoomsData'
            }),
            getRoomStatuses() {
                return []         
            },
            getRoomSales() {
                let sale_details = []
                const sales = this.getSales

                for(let i in sales) {
                    let sale_detail = []
                    let item_category = this.roomsData.item_categories.find(i_category => i_category.id == sales[i].item_category_id)

                    sale_detail['category'] = this.roomsData.categories.find(category => category.id == item_category.category_id)
                    sale_detail['item'] = this.roomsData.items.find(item => item.id == item_category.item_id)
                    sale_detail['quantity'] = sales[i].quantity
                
                    sale_details.push(sale_detail)
                }

                return sale_details
            },
            getSales()
            {
                return this.roomsData.sales.filter(sale => sale.room_id == this.room_id)
            }
        },
        methods: {
            itemPrice(price) {
                return '$' + price.toFixed(2)
            }
        }
    }
</script>

<style scoped>
    .row {
        margin-top: 30px;
    }
</style>
