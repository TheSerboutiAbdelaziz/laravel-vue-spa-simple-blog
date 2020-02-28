<template>
    <div class="register-page">
        <div class="uk-section uk-section-small uk-flex uk-flex-center">
            <div class="uk-container">
                <div class="uk-card uk-card-default uk-width-large">
                    <div class="uk-card-body">
                        <div class="uk-card-title uk-text-center">
                            <h1 class="uk-text-uppercase uk-padding-small uk-padding-remove-horizontal">Register</h1>
                        </div>
                        
                        <!-- START VEE-VALIDATE VALIDATION OBSERVER COMPONENT -->
                        <ValidationObserver ref="form" v-slot="{ passes }">

                            <form @submit.prevent="passes(register)">

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
                                                        name="email"
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
                                    <div class="uk-form-control">

                                        <!-- START VEE-VALIDATE VALIDATION PROVIDER COMPONENT -->
                                        <ValidationProvider vid="password_confirmation" name="password_confirmation" v-slot="{ classes, errors }">
                                            <div class="uk-inline uk-display-block">                                      
                                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                                <input  v-model="form.password_confirmation" 
                                                        type="password" 
                                                        name="email"
                                                        placeholder="Confirm your password" 
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
                                        <button    :disabled="loading"
                                                    type="submit" 
                                                    class="uk-button uk-button-primary  uk-width-expand">
                                            Sign Up
                                        </button>
                                    </div>
                                </div> 

                                <div class="uk-margin">
                                    <div class="uk-form-controls">
                                        <router-link :to="{ name: 'login'}" class="uk-link uk-text-right uk-margin-right">
                                            Already have an account? Login 
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
    import { mapGetters } from 'vuex'

    export default {
        name: 'Register',
        data(){
            return {
                  form:{
                    action: 'register',
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                  },
                  loading: false
            }
        },
        methods:{
            register(){
                this.loading = true;
                this.$store.dispatch('authenticate', this.form)
                    .then(() => {
                        this.$router.push({ name:'dashboard' })
                        this.loading = false;
                    }) 
                    .catch(err => {
                        this.$refs.form.setErrors(err.response.data.errors)
                        this.loading = false;
                    })
            }
        },
    }
</script>