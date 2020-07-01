<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User - Component - user-index</div>

                    <div class="card-body">
                        {{initMsj}} : {{moduleName}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    },
    data() {
        return {
            moduleName : "User",
            initMsj : "Componente del Modulo"
        }
    }
}
</script>
