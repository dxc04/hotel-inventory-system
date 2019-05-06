<template>
    <div>
        <b-form-input v-model="guestName" placeholder="Enter guest name"></b-form-input>
        <b-form-select v-model="guestStatus" :options="statusOptions" class="mt-3"></b-form-select>
    </div>
</template>

<script>

    export default {
        name: 'AddGuestInfo',
        props: {
            guest: String,
            status: String
        },
        data() {
            return {
                statusOptions: [
                    { value: null, text: 'Select status' },
                    { value: 'Stayover', text: 'Stayover' },
                    { value: 'Due Out', text: 'Due Out'}
                ]
            }
        },
        mounted() {

        },
        computed: {
            guestName: {
                get: function() {
                     return this.guest          
                },
                set: function(value) {
                    this.inputGuestName(value)
                }
            },
            guestStatus: {
                get: function() {
                     return this.status         
                },
                set: function(value) {
                    this.selectStatus(value)
                }
            }
        },
        methods: {
            inputGuestName(value) {
                this.$emit('input-guest-name', value)
            },
            selectStatus(value) {
                this.$emit('select-status', value)
            },
        }
    }
</script>
