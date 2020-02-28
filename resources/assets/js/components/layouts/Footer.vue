<template>
    <div class="footer-section">
        <div class="uk-section uk-section-xsmall uk-section-secondary">
            <div class="uk-container">
                <div class="uk-grid uk-child-width-1-2@m uk-padding-large uk-padding-remove-horizontal" data-uk-grid>
                    <div class="uk-text-left uk-padding-large uk-padding-remove-vertical">
                        <h4 class="uk-text-uppercase">DevLog</h4>
                        <p class="uk-text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br>Blanditiis animi, sit ipsam.</p>
                    </div>
                    <div uk-grid>
                        <div class="uk-width-1-3@m">
                            <h4 class="uk-text-uppercase">Support</h4>
                            <ul class="uk-list  uk-list-large uk-text-muted">
                                <li>Home</li>
                                <li>Stories</li>
                                <li>Contact</li>
                            </ul>
                        </div>
                        <div class="uk-width-1-3@m">
                            <h4 class="uk-text-uppercase">Support</h4>
                            <ul class="uk-list  uk-list-large uk-text-muted">
                                <li>Home</li>
                                <li>Stories</li>
                                <li>Contact</li>
                            </ul>
                        </div>
                        <div class="uk-width-1-3@m">
                            <h4 class="uk-text-uppercase">Other</h4>
                            <ul class="uk-list  uk-list-large uk-text-muted">
                                <li>Account</li>
                                <li>Affiliate programs</li>
                                <li>Newsletter</li>
                            </ul>
                        </div>                         
                    </div>                 
                </div>
                <div class="uk-grid uk-text-center uk-text-left@s uk-flex-middle" data-uk-grid>
                    <div class="uk-text-small uk-text-muted uk-width-1-3@s">
                        Created & Designed with <i class="uk-icon uk-text-small" data-uk-icon="heart"></i> by
                        <a target="_blank" href="#">The Serbouti Abdelaziz</a>
                    </div>
                    <div class="uk-text-center uk-width-1-3@s">
                    </div>
                    <div class="uk-text-small uk-text-muted uk-text-center uk-text-right@s uk-width-1-3@s">
                        <a  target="_blank" 
                            href="#"
                            class="uk-icon-button uk-margin-small-right" 
                            data-uk-icon="twitter"></a>   
                        <a  target="_blank" 
                            href="#"
                            class="uk-icon-button uk-margin-small-right" 
                            data-uk-icon="linkedin"></a>   
                        <a  target="#" 
                            href="https://twitter.com"
                            class="uk-icon-button uk-margin-small-right" 
                            data-uk-icon="github"></a>           
                    </div>
                </div>
            </div>
        </div>      
    </div>  
</template>

<script>
    import router from 'vue-router'
    
    export default {
        name: 'Footer',
    }
</script>
