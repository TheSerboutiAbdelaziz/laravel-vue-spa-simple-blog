<template>
    <div class="login-page">    
        <div class="uk-section uk-section-small uk-flex uk-flex-center">
            <div class="uk-container">
                <div class="uk-card uk-card-default uk-width-large">
                    <div class="uk-card-body">
                        <div class="uk-card-title uk-text-center">
                            <h1 class="uk-text-uppercase uk-padding-small uk-padding-remove-horizontal">Login</h1>
                        </div>

                        <!-- START FLASH COMPONENT -->
                        <Flash v-if="flashMessage.message"  :flashMessage="flashMessage" @closeFlash="closeFlash($event)"  />
                        <!-- START FLASH COMPONENT -->

                        <!-- START VEE-VALIDATE VALIDATION OBSERVER COMPONENT -->
                        <ValidationObserver ref="form" v-slot="{ passes }">

                            <form @submit.prevent="passes(login)">

                                <div class="uk-margin">
                                    <div class="uk-form-control">

                                        <!-- START VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->
                                        <ValidationProvider vid="email" name="email" v-slot="{ classes, errors }">
                                            <div class="uk-inline uk-display-block">                                      
                                                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                                <input  v-model="form.email" 
                                                        type="text" 
                                                        name="email"
                                                        placeholder="Your email" 
                                                        class="uk-input" 
                                                        :class="classes">   
                                            </div>
                                            <span class="uk-text-danger"> {{ errors[0] }} </span>     
                                        </ValidationProvider>
                                        <!-- END VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->

                                    </div>
                                </div>

                                <div class="uk-margin">
                                    <div class="uk-form-control">

                                        <!-- START VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->
                                        <ValidationProvider vid="password" name="password" v-slot="{ classes, errors }">
                                            <div class="uk-inline uk-display-block">                                      
                                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                                <input  v-model="form.password" 
                                                        type="password" 
                                                        name="password"
                                                        placeholder="Your password" 
                                                        class="uk-input" 
                                                        :class="classes">   
                                            </div>
                                            <span class="uk-text-danger"> {{ errors[0] }} </span>     
                                        </ValidationProvider>
                                        <!-- END VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->

                                    </div>
                                </div>

                                <div class="uk-margin">
                                    <div class="uk-form-controls">
                                        <div class="uk-clearfix">
                                            <div class="uk-float-left">
                                                <label>
                                                    <input  v-model="form.remember" 
                                                            type="checkbox" 
                                                            name="remember"
                                                            class="uk-checkbox uk-margin-small-right">
                                                        Remember Me
                                                </label>
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="uk-margin">
                                    <div class="uk-form-controls">
                                        <button :disabled="loading"
                                                type="submit" 
                                                class="uk-button uk-button-primary  uk-width-expand">
                                            Sign In
                                        </button>
                                    </div>
                                </div> 

                                <div class="uk-margin">
                                    <div class="uk-form-controls">
                                        <router-link :to="{ name: 'register'}" class="uk-link uk-text-right uk-margin-right">
                                            Don't have an accounnt? Register now!
                                        </router-link>    
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
        name: 'Login',
        data(){
            return {
                form: {
                    action: 'login',
                    email: '',
                    password: '',
                    remember: false
                },
                flashMessage:{
                    message:'',
                    classes: '',
                },
                loading: false
            }
        },
        methods:{
            login(){
                this.flashMessage.message = '';
                this.loading = true;
                this.$store.dispatch('authenticate', this.form)
                    .then(() => {
                        this.$router.push({ name:'dashboard' })
                        this.loading = false;
                    })
                    .catch(err => {
                        if (err.response.status === 401) {
                            this.flashMessage = { message: err.response.data.error, classes: 'uk-alert-danger'};
                            this.loading = false;
                        }else if (err.response.status === 422) {
                            this.$refs.form.setErrors(err.response.data.errors);
                            this.loading = false;
                        }
                    })
            },
            closeFlash(flash){
                this.flashMessage.message = flash;
            }
        }
    }
</script>