<template>
    <div class="stories-page">
        <!-- START LOADER COMPONENT -->
        <loader v-if="webStoriesLoader" :loaderClasses="'uk-section-large'" />
        <!-- END LOADER COMPONENT -->        
            <div v-else class="uk-section uk-section-small">
                <div class="uk-container">
                    <div class="uk-clearfix uk-margin-large-bottom uk-heading-divider">
                        <div class="uk-float-left">
                            <h2 class="uk-text-left">
                                Stories sections
                            </h2> 
                        </div>
                    </div>
                    <div uk-grid>
                        
                        <div class="uk-width-1-3@m" v-for="story in webStories" :key="story.id" >
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
            <div class="uk-section">

                <!-- START PAGINATION COMPONENT -->
                    <Pagination :perPage="pagination.per_page" 
                                :total="pagination.total" 
                                :currentPage="pagination.current_page" 
                                :lastPage="pagination.last_page" />
                <!-- END PAGINATION COMPONENT -->

            </div>                  
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import Card from '../../shared/cards/Card'
    import Pagination from '../../shared/Pagination'

    export default {
        name: "Stories",
        components:{
            Card,
            Pagination
        },
        created(){
            this.$store.dispatch('getAllWebStories', { p: 1 })
        },
        computed: mapGetters(['webStories', 'pagination', 'webStoriesLoader'])
    }
</script>