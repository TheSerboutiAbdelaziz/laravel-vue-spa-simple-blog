<template>
    <div class="home-page">
        <!-- START LOADER COMPONENT -->
        <loader v-if="webStoriesLoader" :loaderClasses="'uk-section-xlarge'" />
        <!-- END LOADER COMPONENT --> 

        <div v-else>        
            <div class="uk-section uk-padding-remove header">  
                <div class="uk-inline">
                    <img src="../../../images/utils/header-img.jpg" alt="">
                    <div class="uk-overlay-primary uk-position-cover"></div>
                    <div class="uk-text-center uk-overlay uk-position-center uk-light" uk-grid>
                        <div class="uk-width-1-1@m">
                            <h3 class="uk-heading-medium uk-text-muted uk-text-uppercase">DevLOg</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br>Repudiandae adipisci excepturi in, animi ullam.</p>
                            <router-link :to="{name: 'stories'}" class="uk-button uk-button-primary uk-text-uppercase">
                                Welcome To Reading
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-section uk-section-small">
                    <div class="uk-container">
                        <h2 class="uk-heading-bullet 
                                   uk-text-uppercase 
                                   uk-padding-small 
                                   uk-padding-remove-horizontal 
                                   uk-padding-remove-top">
                            Latest stories
                        </h2>
                        <div uk-grid>    

                            <div class="uk-width-1-3@m" v-for="story in latestStories" :key="story.id" >
                            <!-- START CARD COMPONENT -->
                                <Card   :image="story.img"
                                        :author="story.author"
                                        :date="story.timestamps.published_at.date"
                                        :title="story.title"
                                        :content="story.content"
                                        :id="story.id"  />
                            <!-- END CARD COMPONENT -->
                            </div>  
                            
                        </div>
                    </div>
            </div>  
            <div class="uk-container uk-margin-large">
                <h2 class="uk-heading-bullet 
                           uk-text-uppercase 
                           uk-padding-small 
                           uk-padding-remove-horizontal 
                           uk-padding-remove-top">
                    what's next
                </h2>

                <!-- START LEFT NEXT CARD COMPONENT -->
                    <NextCard   :nextImagePosition="'uk-card-media-left'"
                                :nextImage="'/images/header-img.jpg'"             
                                :nextTitle="'Media Left'"
                                :nextRouteName="'stories'"
                                :nextBtnName="'GET STARTED'"  />
                <!-- END LEFT NEXT CARD COMPONENT -->

                <!-- START RIGHT NEXT CARD COMPONENT -->
                    <NextCard   :nextImagePosition="'uk-card-media-right'"
                                :nextImage="'/images/header-img.jpg'"
                                :nextTitle="'Media Right'"
                                :nextRouteName="'register'"
                                :nextBtnName="'Register for SHARE NOW'"  />
                <!-- END RIGHT NEXT CARD COMPONENT -->

            </div>                  
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import Card from '../shared/cards/Card'
    import NextCard from '../shared/cards/NextCard'

    export default {
        name: "Stories",
        components:{
            Card,
            NextCard
        },
        created(){
            this.$store.dispatch('getAllWebStories', {p: 1})
        },
        computed: mapGetters(['latestStories', 'webStoriesLoader'])
    }
</script>
