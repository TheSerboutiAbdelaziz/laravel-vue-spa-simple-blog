<template>
    <div class="story-page">
        <div class="uk-section uk-section-small">

            <!-- START LOADER COMPONENT -->
            <loader v-if="webStoriesLoader"  :loaderClasses="'uk-section-large'" />
            <!-- END LOADER COMPONENT -->

            <div v-else class="uk-container">                    
                <div class="uk-width-xxlarge uk-margin-auto uk-padding-small">
                
                    <article v-if="webStory" class="uk-article uk-text-center" >

                        <h1 class="uk-article-title">
                            <a class="uk-link-reset">
                                {{ webStory.title }}
                            </a>
                        </h1>

                        <p class="uk-article-meta">
                            Written by <a href="#"> {{ webStory.author.name }} </a> on {{ webStory.timestamps.published_at.date }}
                        </p>

                        <p class="uk-text-justify">
                            {{ webStory.content }}
                        </p>
                        <div class="uk-grid-small uk-child-width-auto" uk-grid>
                            <div>
                                <p class="uk-text-muted">
                                    <i uk-icon="social"></i> 
                                    Share
                                </p>
                            </div>
                            <div>
                                <p class="uk-text-muted">
                                    <i uk-icon="comment"></i> 
                                    {{ webStory.comments_length }}
                                </p>
                            </div> 
                            <div>
                                <p class="uk-text-muted">
                                    <i uk-icon="tag"></i> 
                                    {{ webStory.category }}
                                </p>
                            </div>
                        </div>
                    </article>
                    <div class="comment-section">
                        <div class="uk-section">
                            <article  class="uk-comment uk-comment-primary" v-for="cmt in webStory.comments" :key="cmt.id">
                                <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
                                    <div class="uk-width-auto">
                                        <img    :src="'/images/avatars/'+ cmt.author.avatar" 
                                                class="uk-comment-avatar uk-border-circle" 
                                                width="30" height="30" alt="">
                                    </div>
                                    <div class="uk-width-expand">
                                        <h4 class="uk-comment-title uk-margin-remove">
                                            <a class="uk-link-reset" href="#">
                                                {{ cmt.author.name }}
                                            </a>
                                        </h4>
                                        <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                                            <li><a href="#"></a></li>
                                        </ul>
                                    </div>
                                </header>
                                <div class="uk-comment-body">
                                    <p> {{ cmt.content }} </p>
                                </div>
                            </article>

                            <!-- START COMMENTS COMPONENT -->
                            <AddComment  />
                            <!-- END COMMENTS COMPONENT -->                            
                        
                        </div>
                    </div>
                </div>                
            </div>        
        </div>     
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import  AddComment  from './AddComment'
    
    export default {
        name: "Story",
        components:{
            AddComment,
        },
        created() {
            this.$store.dispatch('getSingleWebStory', { id: this.$route.params.id })
        },
        computed: mapGetters(['webStory', 'webStoriesLoader'])
    }
</script>