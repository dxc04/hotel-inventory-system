<template>
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; {{ appName }} 2019</span>
        </div>
        </div>
    </footer>
</template>

<script>
    export default {
        name: 'Footer',
        props: {
            appName: {
                type: String,
                default: 'HSG Portal'
            },
        },
    }
</script>
