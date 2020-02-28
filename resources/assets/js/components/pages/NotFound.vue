<template>
    <div class="not-found-page">
        <div class="uk-section uk-section-large">
            <div class="uk-container">
                <div class="uk-text-center" uk-grid>
                    <div class="uk-width-1-1@m">
                        <h2 class="uk-heading-medium uk-text-muted">404</h2>
                        <p class="uk-text-uppercase">The page you're looking for was not found </p>
                        <router-link :to="{ name: 'home'}" 
                                     class="uk-button-primary uk-button uk-text-uppercase">
                            Take me home
                        </router-link>
                    </div>
                </div>
            </div>        
        </div>    
    </div>
</template>

<script>
    export default {
        name: 'NotFound',
    }
</script>
