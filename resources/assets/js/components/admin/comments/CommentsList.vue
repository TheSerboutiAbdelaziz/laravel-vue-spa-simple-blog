<template>
    <div class="admin-comments">
        <div class="uk-section uk-section-small">
            
            <!-- START LOADER COMPONENT -->
            <loader v-if="commentsLoader" :loaderClasses="'uk-section-large'" />
            <!-- END LOADER COMPONENT -->

            <div v-else class="uk-container">
                <h3 class="uk-heading-divider uk-text-left uk-padding-small">
                    Comments section
                </h3>
                
                <!-- START FLASH COMPONENT -->
                <Flash v-if="flashMessage.message"  :flashMessage="flashMessage" @closeFlash="closeFlash($event)"  />
                <!-- START FLASH COMPONENT -->

                <div class="admin-list-table">
                    <table v-if="comments && comments.length !== 0" class="uk-table uk-table-striped uk-table-responsive">
                        <thead class="uk-background-secondary">
                            <tr class="uk-text-left">
                                <td>Author</td>
                                <td>Comment</td>
                                <td>Created at</td>
                                <td>Options</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="uk-text-left"  v-for="(cmt, i) in comments" :key="i">
                                <td> 
                                    {{ cmt.author.name }} 
                                </td>
                                <td class="uk-text-truncate uk-text-left">
                                    {{ cmt.content }}
                                </td>
                                <td>
                                    {{ cmt.timestamps.published_at.date }}
                                </td>
                                <td>
                                    <div class="uk-button-group">
                                        <router-link    :to="{ name: 'story', params: { id: cmt.story_id }}" 
                                                        class="uk-text-center uk-button uk-button-primary">
                                           <span uk-icon="arrow-right"></span>
                                        </router-link>
                                        <button     @click.stop="deleteComment(cmt.id)" 
                                                    class=" uk-text-center uk-button uk-button-secondary">
                                            <span uk-icon="trash"></span>
                                        </button>
                                    </div>                               
                                </td>                               
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="uk-alert-primary" uk-alert>
                        <p> No Comments! </p>
                    </div>                
                </div>  
            </div>        
        </div>    
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "CommentsList",
        data(){
            return {
                flashMessage:{
                    message:'',
                    classes: '',
                }            
            }
        },
        created() {
            this.$store.dispatch('getAllComments')
        },
        methods:{
            deleteComment(commentId){
                this.flashMessage.message = '';
                this.$store.dispatch('deleteComment', { id: commentId })
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
        computed: mapGetters(['comments', 'commentsLoader'])
     }
</script>
