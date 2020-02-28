<template>
    <div class="admin-sidebar-section uk-border">
    	<div class="uk-card uk-background-muted  uk-margin-small-bottom">
    		<div class="uk-card-body uk-grid-small" uk-grid>
    			<div class="uk-width-auto">
    				<img :src="'/images/avatars/' + authProfile.avatar" class="uk-border-circle avatar-img"  alt="">
    			</div>
    			<div class="uk-width-expand"> {{ authProfile.name }} </div>
    		</div>
    	</div>
    	<ul class="uk-list uk-list-divider uk-text-left uk-panel">
    		<li>
	    		<router-link :to="{ name: 'dashboard'}" class="uk-text-muted">
	    			Dashboard
	    		</router-link>    			
    		</li>
    		<li v-if="isAdmin">
	    		<router-link :to="{ name: 'admin-users'}" class="uk-text-muted"> 	    			
	    			Users
	    		</router-link>    			
    		</li>
    		<li>
	    		<router-link :to="{ name: 'admin-stories'}" class="uk-text-muted">
	    			Stories
	    		</router-link>
	    	</li>
    		<li>
	    		<router-link :to="{ name: 'admin-comments'}" class="uk-text-muted" >
	    			Comments
	    		</router-link>    			
    		</li>
    	</ul>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: 'AdminSidebar',
        created(){
            this.$store.dispatch('authUser')
        },
        computed: mapGetters(['authProfile', 'isAdmin'])
    }
</script>
