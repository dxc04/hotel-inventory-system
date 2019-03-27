<template>
    <div :class="borderClass">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div :class="textTitleClass">{{ title }}</div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ info }}<span v-if="progress">%</span></div>
                        </div>
                        <div v-if="progress" class="col">
                            <div class="progress progress-sm mr-2 ml-2">
                            <div class="progress-bar bg-info" role="progressbar" :style="{width: progress + '%'}" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i :class="iconClass"></i>
                    <span v-if="info">
                        <div class="text-xs text-right"><a class="text-info" v-b-modal="modalId">Details</a></div>
                        <b-modal :id="modalId" :title="title" hide-footer>
                            <slot name="modal-content"></slot>
                        </b-modal>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'QuickCard',
        props: {
            title: {
                type: String
            },
            theme: {
                type: String
            },
            dashboardIcon: {
                type: String
            },
            info: {
                type: Number
            },
            progress: {
                type: Number
            },
            modalId: {
                type: String,
                required: true
            },
        },
        mounted() {
        },
        methods: {


        },
        computed: {
            iconClass() {
                let icon_class = {
                    'fas fa-3x text-gray-300' : true
                }
                icon_class[this.dashboardIcon] = true
                return icon_class
            },
            borderClass() {
                let border_class = {
                    'card shadow h-100 py-2' : true
                }
                border_class['border-left-' + this.theme] = true
                return border_class
            },
            textTitleClass() {
                let text_title_class = {
                    'text-xs font-weight-bold text-uppercase mb-1' : true
                }
                text_title_class['text-' + this.theme] = true
                return text_title_class
            }
        }
    }
</script>
