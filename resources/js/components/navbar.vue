<template>
    <div class="component-navbar links">
        <ul class="nav d-flex justify-content-center">
            <li class="nav-item">
                <router-link :to="{name: 'home'}">Home</router-link>
            </li>
            <li class="nav-item">
            	<router-link :to="{name: 'page.2'}">Page 2</router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{name: 'page.3'}">Page 3</router-link>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {

    }
</script>

<style scoped>
    .component-navbar li{
        margin-left: 10px;
        margin-right: 10px;
    }
    .component-navbar a {
        font-size: 1.2rem;
        text-transform: uppercase;
        font-weight: bold;
    }
</style>
