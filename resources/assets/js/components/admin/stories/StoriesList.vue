<template>
    <div class="admin-stories">
        <div class="uk-section uk-section-small">
            
            <!-- START LOADER COMPONENT -->
            <loader v-if="storiesLoader" :loaderClasses="'uk-section-large'" />
            <!-- END LOADER COMPONENT -->

            <div v-else class="uk-container">
                <div class="uk-heading-divider">
                    <h3 class="uk-text-left">
                        Stories section
                        <router-link :to="{ name: 'admin-addStory'}" 
                                     class="uk-button uk-button-primary uk-float-right">
                            Create story
                        </router-link>        
                    </h3>                    
                </div>

                <!-- START FLASH COMPONENT -->
                <Flash v-if="flashMessage.message"  :flashMessage="flashMessage" @closeFlash="closeFlash($event)"  />
                <!-- START FLASH COMPONENT -->

                <div class="admin-list-table">
                    <table v-if="stories && stories.length !== 0" class="uk-table uk-table-striped uk-table-responsive">
                        <thead class="uk-background-secondary">
                            <tr class="uk-text-left">
                                <td>Author</td>
                                <td>Title</td>
                                <td>Comments</td>
                                <td>Created at</td>
                                <td>Options</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="uk-text-left" v-for="(story, i) in stories" :key="i">
                                <td> 
                                    {{ story.author.name }} 
                                </td>
                                <td class="uk-text-truncate uk-text-left">
                                    {{ story.title }}
                                </td>
                                <td class="uk-text-center" >
                                    {{ story.comments.length }}
                                </td>
                                <td>
                                    {{ story.timestamps.published_at.date }}
                                </td>
                                <td>
                                    <div class="uk-button-group">
                                        <router-link :to="{ name: 'story', params: { id: story.id }}" 
                                                     class="uk-text-center uk-button uk-button-primary">
                                        <span uk-icon="arrow-right"></span>
                                        </router-link>
                                        <router-link :to="{ name: 'admin-editStory', params: { id: story.id }}" 
                                                     class="uk-text-center uk-button uk-button-secondary">
                                            <span uk-icon="file-edit"></span>
                                        </router-link>
                                        <button     @click="deleteStory(story.id)"  
                                                class="uk-text-center uk-button uk-button-default">
                                            <span uk-icon="trash"></span>
                                        </button>
                                    </div>                               
                                </td>                               
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="uk-alert-primary uk-margin-top" uk-alert>
                        <p> No Stories! </p>
                    </div>                          
                </div>  
            </div>        
        </div>        
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "StoriesList",
        data(){
            return {
                flashMessage:{
                    message:'',
                    classes: '',
                }
            }
        },
        created() {
            this.$store.dispatch('getAllStories')
        },
        methods:{
            deleteStory(storyId){
                this.flashMessage.message = '';
                this.$store.dispatch('deleteStory', {id : storyId })
                    .then(res => {
                        this.flashMessage = { message: res, classes: 'uk-alert-success'};
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            closeFlash(flash){
                this.flashMessage.message = flash;
            }
        },
        computed: mapGetters(['stories', 'storiesLoader'])
    }
</script>
