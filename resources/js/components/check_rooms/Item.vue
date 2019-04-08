<template>
    <div>
        <div class="row">
            <div class="col col-lg-4 align-middle">
                <b-form-checkbox 
                    :name="'checkbox_' + getItemCategoryId()" 
                    @change="updateSelectedItem($event)"
                    v-model="disabled"
                    :id="'checkbox_' + getItemCategoryId()"
                    type="checkbox" value=1>
                </b-form-checkbox>
            </div>

            <div class="col col-lg-4 text-right align-middle">
                <span>
                    {{ formatItemName() }}
                </span>
            </div>
            <div class="col col-lg-4 text-right align-middle">
                <b-form-input 
                    :name="'input_' + getItemCategoryId()"
                    :id="'input_' + getItemCategoryId()"
                    class="quantity" 
                    v-model="quantity"
                    type="number"
                    :disabled="disabled != 1"
                    @change="updateSelectedItems($event)" >
                </b-form-input>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Item',
        props: {
            item: Object
        },
        data() {
            return {
                disabled: 0,
                quantity: null
            }
        },
        computed: {
            
        },
        methods: {
            formatItemName() {
                return this.item.item_name +  ' (' + this.item.item_amount + ')'
            },
            updateSelectedItems(value) {
                this.quantity = value
                this.$emit('update-selected-items', this.item.item_category_id, value, 'add')
            },
            updateSelectedItem(value) {
                if(!value) {
                    this.quantity = null
                    this.$emit('update-selected-items', this.item.item_category_id, null, 'remove')
                }
            },
            getItemCategoryId()
            {
                return this.item.item_category_id
            }
        }
    }
</script>

<style>
.category-item-list {
        padding: 5px;
        height: 50px;
    }

    .quantity {
        width: 20%;
        display: inline-block;
    }
 
</style>
