<template>
    <div class="dashboard uk-section-small uk-padding-small">

        <!-- START LOADER COMPONENT -->
        <loader v-if="commentsLoader" :loaderClasses="'uk-section-large'" />
        <!-- END LOADER COMPONENT -->

        <div v-else>
            <h3 class="uk-heading-divider uk-text-left uk-padding-small">
                Dashboard Area
            </h3>
            <div class="uk-child-width-1-2@s uk-grid-collapse" uk-grid>
                <div v-if="isAdmin">
                    <div class="uk-tile uk-tile-default uk-child-width-1-2@m uk-text" uk-grid>
                        <i uk-icon="icon: user; ratio: 2" ></i>
                        <span   v-if="usersLoader" uk-spinner="ratio: 0.5" 
                                class="uk-h4 uk-text-middle uk-text-left uk-padding-remove">
                        </span>
                        <p v-else class="uk-h4 uk-text-middle uk-text-left uk-padding-remove">
                            {{ users.length }} Users
                        </p>                            
                    </div>
                </div>
                <div>
                    <div class="uk-tile uk-tile-muted uk-child-width-1-2@m" uk-grid>
                        <i uk-icon="icon: file-text; ratio: 2"></i>
                        <span   v-if="storiesLoader" uk-spinner="ratio: 0.5" 
                                class="uk-h4 uk-text-middle uk-text-left uk-padding-remove">
                        </span>
                        <p v-else class="uk-h4 uk-text-middle uk-text-left uk-padding-remove">
                            {{ stories.length }} Stories
                        </p>
                    </div>
                </div>
                <div>
                    <div class="uk-tile uk-tile-primary uk-child-width-1-2@m" uk-grid>
                        <i uk-icon="icon: comment; ratio: 2"></i>
                        <span   v-if="commentsLoader" uk-spinner="ratio: 0.5" 
                                class="uk-h4 uk-text-middle uk-text-left uk-padding-remove">
                        </span>
                        <p v-else class="uk-h4 uk-text-middle uk-text-left uk-padding-remove">
                            {{ comments.length }} Comments
                        </p>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</template>

<script>
   import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "Dashboard",
        created() {
            mapActions(['getAllUsers','getAllStories','getAllComments'])
        },
        computed: mapGetters(['isAdmin','users','stories','comments','usersLoader', 'storiesLoader', 'commentsLoader'])
    }
</script>
