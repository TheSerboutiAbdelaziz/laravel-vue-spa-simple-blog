<template>
    <div class="admin-edit-story">
        <div class="uk-section uk-section-small uk-overflow-auto">
            <div class="uk-container">
                <h3 class="uk-heading-divider uk-text-left uk-padding-small">
                    Edit Story 
                </h3>
                <!-- START LOADER COMPONENT -->
                <loader v-if="storiesLoader" :loaderClasses="'uk-section-large'" />
                <!-- END LOADER COMPONENT -->

                <div v-else>
                    <!-- START FLASH COMPONENT -->
                    <Flash v-if="flashMessage.message"  :flashMessage="flashMessage" @closeFlash="closeFlash($event)"  />
                    <!-- START FLASH COMPONENT -->

                    <div v-if="story" class="uk-card uk-card-body">
                            <!-- START VEE-VALIDATE VALIDATION OBSERVER COMPONENT -->
                            <ValidationObserver ref="form" v-slot="{ passes }">

                                <form   @submit.prevent="passes(updateStory)" 
                                        class="uk-grid-small" 
                                        enctype="multipart/form-data" uk-grid>
                                    
                                    <div class="uk-width-2-3@s">                                    
                                        <div class="uk-margin">
                                            <div class="uk-form-control">

                                                <!-- START VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->
                                                <ValidationProvider vid="content" name="content" v-slot="{ classes, errors }">
                                                    <textarea   v-model="story.content"
                                                                name="form.content"
                                                                id="content"
                                                                class="uk-textarea" 
                                                                :class="classes">
                                                    </textarea>                                                
                                                    <span class="uk-text-danger"> {{ errors[0] }} </span>     
                                                </ValidationProvider>
                                                <!-- END VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->

                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-width-1-3@s">

                                        <div>
                                            <div class="uk-margin">
                                                <div class="uk-form-control">

                                                    <!-- START VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->
                                                    <ValidationProvider vid="title" name="title" v-slot="{ classes, errors }">
                                                        <input  v-model="story.title" 
                                                                type="text" 
                                                                name="title"
                                                                id="title"
                                                                placeholder="Add title" 
                                                                class="uk-input uk-display-block" 
                                                                :class="classes">   
                                                       
                                                        <span class="uk-text-danger"> {{ errors[0] }} </span>     
                                                    </ValidationProvider>
                                                    <!-- END VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->

                                                </div>
                                            </div>  
                                        </div>

                                        <div>
                                            <div class="uk-margin">
                                                <div class="uk-form-control">

                                                    <!-- START VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->
                                                    <ValidationProvider vid="category_name" name="category_name" v-slot="{ classes, errors }">
                                                            <input  v-model="story.category" 
                                                                    type="text" 
                                                                    name="form.category_name"
                                                                    id="category_name"
                                                                    placeholder="Add category" 
                                                                    class="uk-input uk-display-block" 
                                                                    :class="classes">   

                                                        <span class="uk-text-danger"> {{ errors[0] }} </span>     
                                                    </ValidationProvider>
                                                    <!-- END VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->

                                                </div>
                                            </div>  
                                        </div>

                                        <div>
                                            <div class="uk-margin">
                                                <div class="uk-form-control">

                                                    <!-- START VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->
                                                    <ValidationProvider vid="image" name="image" v-slot="{ classes, validate, errors }">
                                                        <div class="js-upload uk-display-block" uk-form-custom>
                                                            <input  
                                                                type="file" 
                                                                name="form.image"
                                                                @change="handleFileChange($event)"
                                                                class="uk-input"
                                                                :class="classes">   
                                                            <button class="uk-button uk-button-default uk-display-block" 
                                                                    type="button" 
                                                                    tabindex="-1">
                                                                Update image
                                                            </button>
                                                            <span class="uk-text-danger"> {{ errors[0] }} </span>  
                                                        </div>   
                                                    </ValidationProvider>
                                                    <!-- END VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->

                                                </div>
                                            </div>  
                                        </div>
                                        
                                        <div class="uk-witdh-1-1@s">
                                            <div class="uk-margin">
                                                <div class="uk-form-controls">
                                                    <button     :disabled="loading"
                                                                type="submit" 
                                                                class="uk-button uk-button-primary  uk-width-expand">
                                                        Update story
                                                    </button>
                                                </div>
                                            </div>
                                        </div>   

                                    </div>

                                </form>  
                            </ValidationObserver>
                            <!-- END VEE-VALIDATE VALIDATION OBSERVER COMPONENT -->   

                    </div>
                </div>
            </div>        
        </div>        
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: 'EditStory',
        data(){
            return {
                form: {
                    image: '',
                    method: 'patch'
                },
                flashMessage:{
                    message:'',
                    classes: '',
                },
                loading: false
            }
        },
        created(){
            this.$store.dispatch('getSingleStory', { id: this.$route.params.id })
        },
        methods:{
            handleFileChange(e) {
                return  this.form.image = e.target.files[0];
            },
            updateStory(){
                this.flashMessage.message = '';
                this.loading = true;
                let formData = new FormData();

                formData.append('content', document.getElementById('content').value);
                formData.append('title', document.getElementById('title').value);
                formData.append('category_name', document.getElementById('category_name').value);
                formData.append('image', this.form.image);
                formData.append('_method', this.form.method);

                this.$store.dispatch('updateStory', {id: this.$route.params.id, data: formData})
                    .then(res => {
                        this.flashMessage = { message: res, classes: 'uk-alert-success'};
                        this.loading = false;
                    })
                    .catch(err => {
                        return  this.$refs.form.setErrors(err),
                                this.loading = false;
                    })
            },
            closeFlash(flash){
                this.flashMessage.message = flash;
            }

        },
        computed: mapGetters(['story', 'storiesLoader'])
    }
</script>
