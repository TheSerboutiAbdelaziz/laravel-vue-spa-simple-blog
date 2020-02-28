<template>
    <div class="admin-users">
        <div class="uk-section uk-section-small">

            <!-- START LOADER COMPONENT -->
            <loader v-if="usersLoader" :loaderClasses="'uk-section-large'" />
            <!-- END LOADER COMPONENT -->

            <div v-else class="uk-container">
                <h3 class="uk-heading-divider uk-text-left uk-padding-small">
                    Users section
                </h3>
                <div class="admin-list-table">
                    <table v-if="users && users.length !== 0" class="uk-table uk-table-striped uk-table-responsive">
                        <thead class="uk-background-secondary">
                            <tr class="uk-text-left">
                                <th>Author</th>
                                <th>Stories</th>
                                <th>Comments</th>
                                <th>Created at</th>
                                <th class="uk-text-center">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="uk-text-left" v-for="user in users" :key="user.id">
                                <td> 
                                    {{ user.name }} 
                                </td>
                                <td class="uk-text-truncate uk-text-left">
                                    {{ user.stories_length }}
                                </td>
                                <td class="uk-text-truncate uk-text-left">
                                    {{ user.comments_length }}
                                </td>
                                <td>
                                    {{ user.timestamps.published_at.date }}
                                </td>
                                <td>
                                    <div class="uk-button-group">
                                        <router-link :to="{ name: 'admin-profile', params: { id : user.id} }" 
                                                     class="uk-text-center uk-button uk-button-primary">
                                            <span uk-icon="arrow-right"></span>
                                        </router-link>
                                    </div>                               
                                </td>                               
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="uk-alert-primary" uk-alert>
                        <p> No users! </p>
                    </div>                     
                </div>                  
            </div>        
        </div>    
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "UsersList",
        created() {
            this.$store.dispatch('getAllUsers')
        },
        computed: mapGetters(['users', 'usersLoader'])
    }
</script>
