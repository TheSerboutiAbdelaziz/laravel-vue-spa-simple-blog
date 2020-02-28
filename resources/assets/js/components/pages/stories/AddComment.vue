<template>
    <div>
        <article v-if="isAuth" class="uk-comment uk-comment-primary">

        <!-- START FLASH COMPONENT -->
        <Flash v-if="flashMessage.message"  :flashMessage="flashMessage" @closeFlash="closeFlash($event)"  /> 
        <!-- START FLASH COMPONENT -->

            <div class="uk-comment-body">
                    
                    <!-- START VEE-VALIDATE VALIDATION OBSERVER COMPONENT -->
                    <ValidationObserver ref="form" v-slot="{ passes }">

                        <form @submit.prevent="passes(createNewComment)" >

                                <div class="uk-margin">
                                    <!-- START VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->
                                    <ValidationProvider vid="content" name="content" v-slot="{ classes, errors }">
                                        <textarea   v-model="form.content" 
                                                    name="content"
                                                    class="uk-textarea" 
                                                    :class="classes">
                                        </textarea>     
                                        <span class="uk-text-danger"> {{ errors[0] }} </span>     
                                    </ValidationProvider>
                                    <!-- END VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->
                                </div>

                                <div class="uk-margin">
                                    <div class="uk-form-controls">
                                        <button :disabled="loading"
                                                type="submit" 
                                                class="uk-button uk-button-primary">
                                            Add comment
                                        </button>
                                    </div>
                                </div>    

                        </form>  
                    </ValidationObserver>
                    <!-- END VEE-VALIDATE VALIDATION OBSERVER COMPONENT -->    

            </div>
        </article>
        <div v-else>
            <router-link :to="{ name: 'login' }" >
                Please, login to comment!
            </router-link>    
        </div>         
    </div>    
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: 'AddComment',
        data(){
            return {
                form: {
                    content: '',
                    story_id: this.$route.params.id
                },
                flashMessage:{
                    message: '',
                    classes: '',
                },
                loading: false,
            }
        },
        methods:{
            createNewComment(){
                this.flashMessage.message = '';
                this.loading = true;
                this.$store.dispatch('createNewComment', this.form)
                    .then(() => {
                        this.flashMessage = { message: res, classes: 'uk-alert-success'};
                        this.loading = false;
                    })
                    .catch(err => {
                            this.$refs.form.setErrors(err.response.data.errors);
                            this.loading = false;
                    })
            },
            closeFlash(flash){
                this.flashMessage.message = flash;
            }
        },
        computed: mapGetters(['isAuth'])

    }
</script>
