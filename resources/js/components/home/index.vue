<template>
<div>
    <myCarousel />
    <myRecomend />
    <!-- <VDivider/>
    <myFeature />
    <VDivider/>
    <myLotery /> -->
</div>
</template>

<script>
import myCarousel from './carosel'
import myRecomend from './cards/recommend'
import myFeature from './cards/feature'
import myLotery from './cards/lotery'
export default {
    components: {
        myCarousel, myRecomend, myFeature, myLotery
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
