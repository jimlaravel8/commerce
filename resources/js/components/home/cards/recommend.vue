<template>
<el-row style="margin-left: 60px;">
    <el-col :span="5" v-for="product in products.data" :key="product.id" style="margin-right: 30px">
        <el-card :body-style="{ padding: '0px' }">
            <img :src="product.image" class="image" @error="imageUrlAlt">
            <div style="padding: 14px;">
                <span>{{ product.product_name }}</span>
                <div class="bottom clearfix">
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn icon v-bind="attrs" v-on="on" @click="addToCart(product)">
                                <v-icon color="grey lighten-1">mdi-cart</v-icon>
                            </v-btn>
                        </template>
                        <span>Add to Cart</span>
                    </v-tooltip>

                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn icon v-bind="attrs" v-on="on" @click="redirect(product.id)" style="float: right">
                                <v-icon color="grey lighten-1">mdi-eye</v-icon>
                            </v-btn>
                        </template>
                        <span>More details</span>
                    </v-tooltip>
                    <!-- <el-button type="text" class="button" @click="redirect(product.id)">Details</el-button> -->
                </div>
            </div>
        </el-card>
    </el-col>
    <div class="text-center">
        <v-pagination v-model="products.current_page" :length="products.last_page" total-visible="6" @input="nextPage(products.path, products.current_page, 'products')" circle></v-pagination>
        <!-- <v-pagination v-model="products.current_page" :length="products.last_page" circle @click="nextPage"></v-pagination> -->
    </div>
</el-row>
</template>

<script>
import {
    mapState
} from "vuex";
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

        addToCart(cart) {
            if (cart.product_variants.length > 0) {
                eventBus.$emit('selectVariantsEvent', cart)
                // this.select_variants()
                return
            }
            cart.order_qty = 1
            eventBus.$emit("addCartEvent", cart);
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
        nextPage() {
            var payload = {
                path: this.products.path,
                page: this.products.current_page,
                update: 'updateProductsList',
            }
            this.$store.dispatch('nextPage', payload)
        },
        imageUrlAlt() {
            event.target.src = '/assets/notfound/no_image.png'
        }
    },
    mounted() {
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
