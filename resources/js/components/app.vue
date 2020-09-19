<template>
    <router-view :user="user"   v-loading="page_loader" :element-loading-text="app_name + '...'" element-loading-spinner="el-icon-loading" element-loading-background="rgba(0, 0, 0, 0.8)"></router-view>
</template>

<script>
import { mapState } from 'vuex'
    export default {
       props: ['user'],
       data() {
           return {
               app_name: process.env.MIX_APP_NAME
           }
       },
       computed: {
           ...mapState(['page_loader'])
       },
    }
</script>
