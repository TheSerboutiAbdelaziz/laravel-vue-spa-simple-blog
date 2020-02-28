<template>
    <div class="admin-add-story">        
        <div class="uk-section uk-section-small uk-overflow-auto">
            <div class="uk-container">
                <h3 class="uk-heading-divider uk-text-left uk-padding-small">
                    Create new Story
                </h3>
                <!-- START FLASH COMPONENT -->
                <Flash v-if="flashMessage.message"  :flashMessage="flashMessage" @closeFlash="closeFlash($event)"  />
                <!-- START FLASH COMPONENT -->

                <div class="uk-card uk-card-body">
                        <!-- START VEE-VALIDATE VALIDATION OBSERVER COMPONENT -->
                        <ValidationObserver ref="form" v-slot="{ passes }">

                            <form   @submit.prevent="passes(createNewStory)" 
                                    class="uk-grid-small" 
                                    enctype="multipart/form-data" uk-grid>
                                
                                <div class="uk-width-2-3@s">                                    
                                    <div class="uk-margin">
                                        <div class="uk-form-control">

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
                                    </div>
                                </div>

                                <div class="uk-width-1-3@s">

                                    <div>
                                        <div class="uk-margin">
                                            <div class="uk-form-control">

                                                <!-- START VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->
                                                <ValidationProvider vid="title" name="title" v-slot="{ classes, errors }">
                                                    <input  v-model="form.title" 
                                                            type="text" 
                                                            name="title"
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
                                                        <input  v-model="form.category_name" 
                                                                type="text" 
                                                                name="category_name"
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
                                                            Upload image
                                                        </button>
                                                        <span class="uk-text-danger"> {{ errors[0] }} </span>  
                                                    </div>   
                                                </ValidationProvider>
                                                <!-- END VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->

                                            </div>
                                        </div>  
                                    </div>
                                    
                                    <div>
                                        <div class="uk-margin">
                                            <div class="uk-form-controls">
                                                <button :disabled="loading"    
                                                        type="submit" 
                                                        class="uk-button uk-button-primary  uk-width-expand">
                                                    Create story
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
</template>

<script>

    export default {
        name: 'AddStory',
        data(){
            return {
                form: {
                    content: '',
                    title: '',
                    category_name: '',
                    image: ''
                },
                flashMessage:{
                    message:'',
                    classes: '',
                },
                loading: false
            }
        },
        methods:{
            handleFileChange(e) {
                return  this.form.image = e.target.files[0];
            },
            createNewStory(){
                this.flashMessage.message = '';
                this.loading = true;
                let formData = new FormData();
                formData.append('content', this.form.content);
                formData.append('title', this.form.title);
                formData.append('category_name', this.form.category_name);
                formData.append('image', this.form.image);
                console.log(formData);      

                this.$store.dispatch('createNewStory', formData)
                    .then(res => {
                        this.flashMessage = { message: res, classes: 'uk-alert-success'};
                        this.loading = false;
                    })
                    .catch(err => {
                            this.$refs.form.setErrors(err);
                            this.loading = false;
                    })
            },
            closeFlash(flash){
                this.flashMessage.message = flash;
            }
        }
    }
</script>