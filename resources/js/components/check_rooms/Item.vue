<template>
    <div class="row">
        <div class="col-lg-3 col-sm-5 mt-2">
            <div>{{ itemName }}</div>
            <div>{{ itemPrice }}</div>
        </div>
        <div class="col-lg-9 col-sm-7 m-0">
            <span class="mr-1">
                <a href="#" class="btn btn-danger btn-circle btn-sm" @click="minusQty()">
                    <font-awesome-icon class="justify-center" :icon="minus"/>
                </a>
            </span>
            <span>
                <b-form-input 
                    :name="'input_' + getItemCategoryId()"
                    class="quantity" 
                    v-model="quantity"
                    type="text"
                    @change="updateItem()"
                >
                </b-form-input>
            </span>    
            <span class="ml-1">
                <a href="#" class="btn btn-success btn-circle btn-sm" @click="addQty()">
                    <font-awesome-icon class="justify-center" :icon="plus"/>
                </a>
            </span> 
        </div>
    </div>
</template>

<script>
    import { faPlus, faMinus } from '@fortawesome/free-solid-svg-icons'
    export default {
        name: 'Item',
        props: {
            item: Object
        },
        data() {
            return {
                disabled: 0,
                quantity: 0,
                minus: faMinus,
                plus: faPlus,
            }
        },
        computed: {
            itemName() {
                return this.item.item_name
            },
            itemPrice() {
                return '$' + this.item.item_amount.toFixed(2)
            },
        },
        methods: {
            addQty() {
                this.quantity++
                this.updateItem()
            },
            minusQty() {
                if (this.quantity) {
                    this.quantity--
                    this.updateItem()
                }
            },
            updateItem() {
                this.$emit('update-item', this.item.item_category_id, this.quantity)
            }, 
            getItemCategoryId() {
                return this.item.item_category_id
            }
        }
    }
</script>

<style scoped>
    .category-item-list {
        padding: 5px;
        height: 50px;
    }

    .quantity {
        width: 40px;
        display: inline-block;
    }
    
    .btn-circle {
        width: 20px;
        height: 20px;
        font-size: 10px;
    }
</style>
