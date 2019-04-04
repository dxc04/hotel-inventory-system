<template>
    <div>
        <b-form-input v-model="guest" placeholder="Enter guest name" @blur="inputGuestName"></b-form-input>
        <b-form-select v-model="status" :options="statusOptions" @change="selectStatus" class="mt-3"></b-form-select>
    </div>
</template>

<script>

    export default {
        name: 'AddGuestInfo',
        data() {
            return {
                guest: '',
                status: null,
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
