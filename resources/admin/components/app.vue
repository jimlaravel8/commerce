<template>
    <router-view :user="user"   v-loading="page_loader" element-loading-text="Pos..." element-loading-spinner="el-icon-loading" element-loading-background="rgba(0, 0, 0, 0.8)"></router-view>
</template>

<script>
import { mapState } from 'vuex'
    export default {
       props: ['user'],
       computed: {
           ...mapState(['page_loader'])
       },
    }
</script>
