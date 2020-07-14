<template>
    <div>

        <section v-if="alert.status">
            <div class="alert my-3" :class="alert.type" role="alert">
                {{alert.text}}
            </div>
        </section>

    </div>
</template>

<script>
export default {
    props: {
        alert:{
            type: Object,
            required: true
        }
    }
}
</script>
