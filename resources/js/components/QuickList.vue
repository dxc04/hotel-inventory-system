<template>
    <div class="container">
        <div class="row pb-3" v-for="item in items">
            <div :class="borderClass">
                <div class="col-auto" v-for="name in item">
                    <span class="text-md">{{ name }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'QuickList',
        props: {
            items: { 
                type: Array,
                required: true
            },
            theme: {
                type: String
            }
        },
        computed: {
            borderClass() {
                let border_class = {
                    'pb-2' : true
                }
                let theme = this.theme ? this.theme : 'primary'
                border_class['border-left-' + theme] = true
                return border_class
            },
        }
    }
</script>
