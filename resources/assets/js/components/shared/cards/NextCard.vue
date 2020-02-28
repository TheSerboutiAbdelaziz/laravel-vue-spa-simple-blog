<template>
    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
        <div :class="nextImagePosition" class="uk-flex-last@s uk-cover-container" >
            <img :src="nextImage" alt="" uk-cover>
            <canvas width="500" height="300"></canvas>
        </div>
        <div>
            <div class="uk-card-body">
                <h3 class="uk-card-title">{{ nextTitle }}</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                <router-link :to="{name: nextRouteName}" class="uk-button uk-button-primary uk-text-uppercase">
                    {{ nextBtnName }}
                </router-link>
            </div>
        </div>
    </div>      
</template>

<script>
    export default {
        name: 'NextCard',
        props: ['nextImagePosition', 'nextImage' ,'nextTitle', 'nextRouteName', 'nextBtnName']
    }
</script>
