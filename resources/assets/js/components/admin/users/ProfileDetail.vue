<template>
    <div class="admin-user-profile">        
        <div class="uk-section uk-section-small uk-overflow-auto">
            
            <!-- START LOADER COMPONENT -->
            <loader v-if="usersLoader" :loaderClasses="'uk-section-large'" />
            <!-- END LOADER COMPONENT -->

            <div v-else class="uk-container">
                <div  v-if="userProfile" 
                        class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
                    <div class="uk-card-media-left uk-cover-container">
                        <img :src="'/images/avatars/'+userProfile.avatar"  alt="" uk-cover>
                        <canvas width="600" height="400"></canvas>
                    </div>
                    <div>
                        <div class="uk-card-body">
                            <dl class="uk-description-list uk-description-list-divider uk-text-left">
                                <dt>Name:</dt>
                                <dd>{{ userProfile.name }}</dd>
                                <dt>Email:</dt>
                                <dd>{{ userProfile.email }}</dd>
                                <dt>Stories:</dt>
                                <dd>{{ userProfile.stories_length }}</dd>
                                <dt>Comments:</dt>
                                <dd>{{ userProfile.comments_length }}</dd>
                                <dt >Created at:</dt>
                                <dd>{{ userProfile.timestamps.published_at.date }}</dd>
                            </dl>     
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</template>

<script>
    import { mapGetters} from 'vuex'

    export default {
        name: "ProfileDetail",
        created() {
            this.$store.dispatch('getSingleUser', { id: this.$route.params.id })
        },
        computed: mapGetters(['userProfile', 'usersLoader'])
    }
</script>
