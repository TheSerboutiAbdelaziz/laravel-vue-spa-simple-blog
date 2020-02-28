<template>
     <div class="admin-area">
        <div class="uk-section uk-section-small">
            <div class="uk-container">
                <div class="uk-text-center " uk-grid>
                    <div class="uk-width-1-4@s">
                         <AdminSidebar /> 
                    </div>
                    <div class="uk-width-3-4@s">                    
                        <router-view></router-view> 
                    </div>
                </div>
            </div>        
        </div>     
     </div>
</template>

<script>
    import AdminSidebar from './AdminSidebar'

    export default {
        name: 'AdminLayout',
        components: {
            AdminSidebar            
        }
    }
</script>
