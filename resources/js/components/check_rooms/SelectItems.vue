<template>
    <div>
        <b-card no-body>
            <b-tabs card>
                <b-tab title="Minibar" active>
                    <b-card-text>Tab Contents 1</b-card-text>
                </b-tab>
                <b-tab title="Top Tray">
                    <b-card-text>Tab Contents 2</b-card-text>
                </b-tab>
            </b-tabs>
        </b-card>
    </div>
</template>

<script>

    export default {
        name: 'SelectItems',
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
