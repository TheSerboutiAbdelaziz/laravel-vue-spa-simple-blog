<template>
    <div class="navbar-section">
        <div class="uk-background-primary uk-light">
            <nav class="uk-navbar-container uk-navbar-transparent">
                <div class="uk-container">
                    <div class="uk-navbar" data-uk-navbar>
                        <div class="uk-navbar-left">
                            <router-link :to="{ name: 'home' }" class="uk-navbar-item uk-logo uk-text-uppercase" >
                                Devlog
                            </router-link>
                        </div>
                        <div class="uk-navbar-right">
                            <ul class="uk-navbar-nav">
                                <li>
                                    <router-link :to="{ name: 'home' }" >Home</router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'stories' }" >Stories</router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'contact' }" >Contact</router-link>
                                </li>   
                                <li v-if="!isAuth" >
                                    <router-link :to="{ name: 'login' }" >
                                        <i uk-icon="user"></i>
                                    </router-link>
                                </li> 
                                <li v-if="isAuth" >
                                    <router-link :to="{ name: 'dashboard' }" >Dashboard</router-link>
                                </li> 
                                <li v-if="isAuth" >
                                    <a href="#" @click.prevent="logout()">Logout</a>
                                </li>                          
                            </ul>

                        </div>
                    </div>
                </div>
            </nav>
        </div>    
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
        
    export default {
        name: 'Navbar',
        methods:{
            logout(){
                this.$store.dispatch('logout')
                    .then(() => this.$router.push('/login'))
            }
        },
        computed: mapGetters(['isAuth'])
    }
</script>
