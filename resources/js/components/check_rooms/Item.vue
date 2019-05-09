<template>
    <div class="row">
        <div class="col-lg-3 col-sm-5 mt-2">
            <div>{{ itemName }} 
                <sup v-if="hasItemToRestock" class="text-info">{{ item.stock_count }}</sup> 
                <sup v-if="hasNoStock" class="text-info">(sold out)</sup>
            </div>
            <div>{{ itemPrice }}</div>
        </div>
        <div class="col-lg-9 col-sm-7 m-0">
            <span class="mr-1">
                <button :class="minusClass" @click="minusQty()">
                    <font-awesome-icon class="justify-center" :icon="minus"/>
                </button>
            </span>
            <span>
                <b-form-input 
                    :name="'input_' + getItemCategoryId()"
                    class="quantity" 
                    v-model="itemQty"
                    type="text"
                    @change="updateItem()"
                    readonly
                >
                </b-form-input>
            </span>    
            <span class="ml-1">
                <button :class="addClass" @click="addQty()">
                    <font-awesome-icon class="justify-center" :icon="plus"/>
                </button>
            </span>
        </div>
    </div>
</template>

<script>
    import { faPlus, faMinus } from '@fortawesome/free-solid-svg-icons'

    export default {
        name: 'Item',
        props: {
            item: Object,
            hasSelectedRoom: Boolean,
        },
        data() {
            return {
                disabled: 0,
                minus: faMinus,
                plus: faPlus,
            }
        },
        computed: {
            addClass() {
                let add_class = {
                    'btn btn-success btn-circle btn-sm' : true
                }
                if (this.hasNoStock || !this.canAdd) {
                    add_class['btn-disable'] = true
                }

                return add_class
            },
            minusClass() {
                let minus_class = {
                    'btn btn-danger btn-circle btn-sm' : true
                }
                if (this.hasNoStock || !this.itemQty) {
                    minus_class['btn-disable'] = true
                }

                return minus_class
            },
            isMaxedOut() {
                return this.hasSelectedRoom && !this.hasNoStock && !this.canAdd
            },
            itemName() {
                return this.item.item_name
            },
            itemPrice() {
                return '$' + this.item.item_amount.toFixed(2)
            },
            itemQty: {
                get: function() {
                     return this.item.quantity           
                },
                set: function(value) {
                    this.updateItem(value)
                }
            },
            canAdd() {
                return this.itemQty < this.item.stock_count
            },
            hasNoStock() {
                return this.hasSelectedRoom && !this.item.stock_count
            },
            hasItemToRestock() {
                return this.hasSelectedRoom && this.item.stock_count
            }
        },
        methods: {
            addQty() {
                if (this.canAdd) {
                    this.itemQty = this.itemQty + 1
                }
            },
            minusQty() {
                if (this.itemQty) {
                    this.itemQty = this.itemQty - 1
                }
            },
            updateItem(value) {
                this.$emit('update-item', this.item.item_category_id, value)
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

    .btn-disable {
        opacity: 0.5;
    }
</style>
