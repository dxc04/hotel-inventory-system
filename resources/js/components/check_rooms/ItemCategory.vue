<template>
    <div class="row category-item-list">
        <div class="col col-lg-8">
            <span>
                {{ category_id }}
            </span>
        </div>
        <div class="col col-lg-2 text-right">
            <span>
                
            </span>
        </div>
        <div class="col col-lg-2 text-right">
            <span>
                
            </span>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'ItemCategory',
        props: {
            category_id: Number
        },
        computed: {
            
        }
    }
</script>
