<template>
        <div class="uk-container" v-if="total >= 3">
            <div class="uk-text-center" uk-grid>
                <div class="uk-width-1-1@m">
                    <ul class="uk-pagination uk-flex-center" uk-margin>

                        <li>
                            <a href="#" @click.prevent="prev(currentPage,lastPage)" >
                                <span uk-pagination-previous></span>
                            </a>
                        </li>
                        <li v-for="p in lastPage">
                            <a href="#" @click.prevent="goToPage(p)"> 
                                {{ p }}
                            </a>
                        </li>
                        <li>
                            <a href="#" @click.prevent="next(currentPage,lastPage)">
                                <span uk-pagination-next></span>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>   
</template>

<script>
    export default {
        name: "Stories",
        props:['perPage', 'total', 'currentPage', 'lastPage'],
        data(){
            return {
            }
        },
        created(){
            this.goToPage(),
            this.prev(),
            this.next()
        },
        methods:{
            goToPage(page){
                this.$store.dispatch('getAllWebStories', { p: page });
            },
            prev(page,lastPage){
                if (page === 1) { 
                    return this.$store.dispatch('getAllWebStories', { p: lastPage });
                }else{
                    return this.$store.dispatch('getAllWebStories', { p: page-1 });
                }
            },
            next(page, lastPage){
                if (page === lastPage) {
                    return this.$store.dispatch('getAllWebStories', { p: 1 });
                }else{
                    return this.$store.dispatch('getAllWebStories', { p: page+1 });
                }
            }
        },
    }
</script>
