<template>
    <div :class="flashMessage.classes" uk-alert>
        <a @click.prevent="destroyFlash()" class="uk-alert-close" uk-close></a>
        <p> {{ flashMessage.message }}</p>
    </div>  
</template>

<script>
    export default {
        name: "Flash",
        props:['flashMessage'],
        methods:{
        	destroyFlash(){
        		this.flashMessage.message = null;
        		this.$emit('closeFlash', this.flashMessage.message);
        	}
        }
    }
</script>
