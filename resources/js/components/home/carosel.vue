<template>
<el-carousel indicator-position="outside" style="width: 100%">
    <el-carousel-item v-for="item in 4" :key="item">
        <h3>{{ item }}</h3>
    </el-carousel-item>
</el-carousel>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    }
}
</script>

<style>
.el-carousel__item h3 {
    color: #475669;
    font-size: 18px;
    opacity: 0.75;
    line-height: 300px;
    margin: 0;
}

.el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
}

.el-carousel__item:nth-child(2n+1) {
    background-color: #d3dce6;
}
.el-carousel__container {
    height: 80vh !important;
}
</style>
