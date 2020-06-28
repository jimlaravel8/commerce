<template>
<el-row style="margin-left: 60px;">
    <el-col :span="5" v-for="product in products.data" :key="product.id" style="margin-right: 30px">
        <el-card :body-style="{ padding: '0px' }">
            <img :src="product.image" class="image"  @error="imageUrlAlt">
            <div style="padding: 14px;">
                <span>{{ product.product_name }}</span>
                <div class="bottom clearfix">
                    <time class="time">{{ product.price }}</time>
                    <el-button type="text" class="button" @click="redirect(product.id)">Details</el-button>
                </div>
            </div>
        </el-card>
    </el-col>
</el-row>
</template>

<script>
import { mapState } from "vuex";
export default {
    data() {
        return {
            currentDate: new Date()
        };
    },
    methods: {

        getProducts() {

            var payload = {
                model: 'shop',
                update: 'updateProductsList',
            }
            this.$store.dispatch('getItems', payload)
        },

        redirect(proId) {

            // alert('oooo')
            this.$router.push({
                name: "details",
                params: {
                    id: proId
                }
            });
        },
        imageUrlAlt() {
            event.target.src = '/assets/notfound/no_image.png'
        }
    },
    mounted () {
        this.getProducts();
    },
    computed: {
        ...mapState(['products'])
    },
}
</script>

<style scoped>
.time {
    font-size: 13px;
    color: #999;
}

.bottom {
    margin-top: 13px;
    line-height: 12px;
}

.button {
    padding: 0;
    float: right;
}

.image {
    width: 100%;
    display: block;
}

.clearfix:before,
.clearfix:after {
    display: table;
    content: "";
}

.clearfix:after {
    clear: both
}

.image[data-v-16ef01da] {
    height: 300px !important;
}
</style>
