<template>
    <div class="uk-card uk-card-default">
        <div class="uk-card-media-top">
            <img :src="'/images/stories/'+ image" alt="">
        </div>
        <div class="uk-card-body">
            <h3 class="uk-card-title">{{ title | truncate }}</h3>
        </div>
        <div class="uk-card-footer">
            <div class="uk-grid-small" uk-grid>
                <div class="uk-width-2-3@s">
                    <div class="uk-grid-small" uk-grid>
                        <div class="uk-width-auto">
                            <img    class="uk-border-circle avatar-img" 
                                    :src="'/images/avatars/'+author.avatar">
                        </div>
                        <div class="uk-width-expand">
                            <h3 class="uk-h5 uk-margin-remove-bottom">
                                 {{ author.name }} 
                            </h3>
                            <p class="uk-text-meta uk-margin-remove-top">
                             {{ date }} 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-3@s">                 
                    <router-link :to="{ name: 'story', params: { id: id }}" 
                                  uk-icon="icon: arrow-right; ratio: 1.5" 
                                  class="uk-float-right uk-icon-button">   
                    </router-link> 
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Card',
        props:['image', 'author', 'date','title', 'content', 'id']
    }
</script>