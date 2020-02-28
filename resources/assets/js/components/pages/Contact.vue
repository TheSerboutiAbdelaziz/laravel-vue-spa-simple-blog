<template>
    <div class="contact-page">    
        <div class="uk-section uk-section-small uk-flex uk-flex-center">
            <div class="uk-container">
                <div class="uk-card uk-card-default uk-width-xxlarge">
                    <div class="uk-card-body">
                        <div class="uk-card-title uk-text-center">
                            <h1 class="uk-text-uppercase uk-padding-small uk-padding-remove-horizontal">Get in touch</h1>
                        </div>

                        <!-- START FLASH COMPONENT -->
                        <Flash v-if="flashMessage.message"  :flashMessage="flashMessage" @closeFlash="closeFlash($event)"  />
                        <!-- START FLASH COMPONENT -->
                        
                        <!-- START VEE-VALIDATE VALIDATION OBSERVER COMPONENT -->
                        <ValidationObserver ref="form" v-slot="{ passes }">

                            <form @submit.prevent="passes(sendEmail)" class="uk-grid-small" uk-grid>

                                <div class="uk-width-1-3@s">    
                                    <div class="uk-margin">
                                        <div class="uk-form-control">

                                            <!-- START VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->
                                            <ValidationProvider vid="name" name="name" v-slot="{ classes, errors }">
                                                <div class="uk-inline uk-display-block">                                      
                                                    <span class="uk-form-icon" uk-icon="icon: user"></span>
                                                    <input  v-model="form.name" 
                                                            type="text" 
                                                            name="name"
                                                            placeholder="Your name" 
                                                            class="uk-input" 
                                                            :class="classes">   
                                                </div>
                                                <span class="uk-text-danger"> {{ errors[0] }} </span>     
                                            </ValidationProvider>
                                            <!-- END VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="uk-width-1-3@s">
                                    <div class="uk-margin">
                                        <div class="uk-form-control">

                                            <!-- START VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->
                                            <ValidationProvider vid="address" name="address" v-slot="{ classes, errors }">
                                                <div class="uk-inline uk-display-block">                                      
                                                    <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                                    <input  v-model="form.address" 
                                                            type="text" 
                                                            name="address"
                                                            placeholder="Your email" 
                                                            class="uk-input" 
                                                            :class="classes">   
                                                </div>
                                                <span class="uk-text-danger"> {{ errors[0] }} </span>     
                                            </ValidationProvider>
                                            <!-- END VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->

                                        </div>
                                    </div>
                                </div>

                                <div class="uk-width-1-3@s">    
                                    <div class="uk-margin">
                                        <div class="uk-form-control">

                                            <!-- START VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->
                                            <ValidationProvider vid="subject" name="subject" v-slot="{ classes, errors }">
                                                <div class="uk-inline uk-display-block">                                      
                                                    <span class="uk-form-icon" uk-icon="icon: pencil"></span>
                                                    <input  v-model="form.subject" 
                                                            type="text" 
                                                            name="subject"
                                                            placeholder="Subject" 
                                                            class="uk-input" 
                                                            :class="classes">   
                                                </div>
                                                <span class="uk-text-danger"> {{ errors[0] }} </span>     
                                            </ValidationProvider>
                                            <!-- END VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->

                                        </div>
                                    </div>
                                </div>

                                <div class="uk-width-1-1@s">          
                                    <div class="uk-margin">
                                    <div class="uk-form-control">

                                        <!-- START VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->
                                        <ValidationProvider vid="body" name="body" v-slot="{ classes, errors }">
                                            <textarea   v-model="form.body" 
                                                        name="body"
                                                        class="uk-textarea" 
                                                        :class="classes">
                                            </textarea>     
                                            <span class="uk-text-danger"> {{ errors[0] }} </span>     
                                        </ValidationProvider>
                                        <!-- END VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->

                                    </div>
                                    </div>
                                </div>

                                <div class="uk-width-1-1@s">
                                    <div class="uk-margin">
                                        <div class="uk-form-controls">
                                            <button     :disabled="loading"
                                                        type="submit" 
                                                        class="uk-button uk-button-primary">
                                                Send your message
                                            </button>
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
    export default {
        name: 'ContactUs',
        data(){
            return {
                  form: {
                    name: '',
                    address: '',
                    subject: '',
                    body: ''
                  },
                    flashMessage:{
                        message:'',
                        classes: '',
                    },
                  loading: false        
            }
        },
        methods:{
            sendEmail(){
                this.flashMessage.message = '';
                this.loading = true;
                return  axios.post('contact-us', {
                    name: this.form.name,
                    address: this.form.address,
                    subject: this.form.subject,
                    body: this.form.body,
                 })
                    .then(res => {
                        this.flashMessage = { message: res.data.message, classes: 'uk-alert-success'};
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
        }
    }
</script>
