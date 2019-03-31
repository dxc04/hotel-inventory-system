<template>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Check Rooms</h1>
    </div>
    <div class="row mb-3">
        <div class="flex-column col-sm-12 col-md-8">
            <div class="row">
                <div class="ml-5 mr-5 col-auto text-center justify-center">
                    <div class="text-center"><font-awesome-icon class="justify-center" :icon="fileInvoiceDollar" size="3x"/></div>
                    <div class="mt-2">Post Sale</div>
                </div>
                <div class="mr-5 col-auto text-center justify-center">
                    <div class="text-center"><font-awesome-icon :icon="minusSquare" size="3x"/></div>
                    <div class="mt-2">No Sale</div>
                </div>
                <div class="mr-5 col-auto text-center justify-center">
                    <div class="text-center"><font-awesome-icon :icon="doorClosed" size="3x"/></div>
                    <div class="mt-2">DND Due Out</div>
                </div>
                <div class="mr-5 col-auto text-center justify-center">
                    <div class="text-center"><font-awesome-icon :icon="doorClosed" size="3x"/></div>
                    <div class="mt-2">DND Stayover</div>
                </div>
                <div class="mr-5 col-auto text-center justify-center">
                    <div class="text-center"><font-awesome-icon :icon="timesCircle" size="3x"/></div>
                    <div class="mt-2">Item Reject</div>
                </div>
                <div class="mr-5 col-auto text-center justify-center">
                    <div class="text-center"><font-awesome-icon :icon="dollarSign" size="3x"/></div>
                    <div class="mt-2">Extra Sale</div>
                </div>
            </div>
        </div>
        <div class="flex-column col-sm-12 col-md-4">
            <div class="row">
                <div class="ml-5 mr-5 col-auto text-center justify-center">
                    <div class="text-center"><font-awesome-icon class="justify-center" :icon="clipboardCheck" size="3x"/></div>
                    <div class="mt-2">Restock</div>
                </div>
            </div>    
        </div>
    </div>  
    <div class="row">
        <div class="flex-column col-sm-12 col-md-8">
            <b-card>
                <div role="tablist">
                    <b-card no-body class="mb-1">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                        <b-button block href="#" v-b-toggle.accordion-1 variant="default">Select a Room</b-button>
                    </b-card-header>
                    <b-collapse id="accordion-1" visible accordion="my-accordion" role="tabpanel">
                        <b-card-body>
                        <b-card-text>{{ text }}</b-card-text>
                        </b-card-body>
                    </b-collapse>
                    </b-card>

                    <b-card no-body class="mb-1">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                        <b-button block href="#" v-b-toggle.accordion-2 variant="default"><span class="text-left">Add Guest Info</span></b-button>
                    </b-card-header>
                    <b-collapse id="accordion-2" accordion="my-accordion" role="tabpanel">
                        <b-card-body>
                        <b-card-text>{{ text }}</b-card-text>
                        </b-card-body>
                    </b-collapse>
                    </b-card>

                    <b-card no-body class="mb-1">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                        <b-button block href="#" v-b-toggle.accordion-3 variant="default">Select Items</b-button></b-button>
                    </b-card-header>
                    <b-collapse id="accordion-3" accordion="my-accordion" role="tabpanel">
                        <b-card-body>
                        <b-card-text>{{ text }}</b-card-text>
                        </b-card-body>
                    </b-collapse>
                    </b-card>
                </div>
            </b-card>
        </div>
        <div class="flex-column col-sm-12 col-md-4">
            <b-card>

            </b-card>
        </div>
    </div>
</div>
</template>

<script>
    import { faFileInvoiceDollar, faMinusSquare, faDoorClosed, faTimesCircle, faCommentDollar, faDollarSign, faClipboardCheck } from '@fortawesome/free-solid-svg-icons'

    export default {
        name: 'CheckRoomsPage',
        mounted() {
        },
        data() {
            return {
                text: `
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                synth nesciunt you probably haven't heard of them accusamus labore VHS.
                `,
                fileInvoiceDollar: faFileInvoiceDollar,
                minusSquare: faMinusSquare,
                doorClosed: faDoorClosed,
                timesCircle: faTimesCircle,
                dollarSign: faDollarSign,
                clipboardCheck: faClipboardCheck
            }
        }
    }
</script>