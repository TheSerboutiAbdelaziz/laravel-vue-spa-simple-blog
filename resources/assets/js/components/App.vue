<template>
    <div class="wrapper">
        <Navbar />          
        <router-view></router-view>
        <Footer />   
    </div>
</template>

<script>
    import Navbar from './layouts/Navbar'
    import Footer from './layouts/Footer'

    export default {
        name: 'App',
        components: {
            Navbar,
            Footer,
        },
    }
</script>
