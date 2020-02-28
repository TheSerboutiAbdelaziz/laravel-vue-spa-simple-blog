<template>
    <div class="uk-flex uk-flex-middle uk-section" :class="loaderClasses">
            <div class="uk-margin-auto">
                <div class="" uk-spinner></div>
            </div>
    </div>
</template>

<script>
    export default {
        name: "Loader",
        props:['loaderClasses'],
    }
</script>
