<template>
<div>
    <headerP></headerP>
    <!-- <div v-show="loading" style="text-align: center; width: 100%; margin-top: 200px;">
        <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
    </div> -->
    <section class="bgwhite p-t-55 p-b-65">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                    <div class="leftbar p-r-20 p-r-0-sm">
                        <!--  -->
                        <!-- <h4 class="m-text14 p-b-7">Categories</h4> -->
                        <myFilter></myFilter>

                    </div>
                </div>

                <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                    <!--  -->
                    <div class="flex-sb-m flex-w p-b-35">
                        <div class="flex-w">
                            <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                                <!-- <v-layout wrap> -->
                                <!-- <v-flex xs12 sm12>
                                    <v-select :items="items" v-model="itemSelect" label="Filter By" single-line item-text="state" item-value="abbr" return-object persistent-hint @change="FilterShop"></v-select>
                                </v-flex> -->
                            </div>
                        </div>

                        <span class="s-text8 p-t-5 p-b-5">Showing page {{ products.current_page }} of {{ products.last_page }} pages</span>
                    </div>

                    <!-- Product -->
                    <div class="row" v-if="products.data.length > 0">
                        <div class="col-sm-12 col-md-6 col-lg-4 p-b-50" v-for="product in products.data" :key="product.id">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew" v-if="product.new_product === 1">
                                    <img :src="product.image" @error="imageUrlAlt">

                                    <div class="block2-overlay trans-0-4">
                                        <v-tooltip bottom style="margin-left: 90%;" v-if="product.wish_list === 1">
                                            <v-btn icon class="mx-0 block2-btn-addwishlist hov-pointer trans-0-4" slot="activator" @click="addToWish(product.id)" style="margin-top: -20px;">
                                                <v-icon color="pink darken-2" large>favorite</v-icon>
                                            </v-btn>
                                            <span>Wish list</span>
                                        </v-tooltip>

                                        <v-tooltip bottom style="margin-left: 90%;" v-else>
                                            <v-btn icon class="mx-0 block2-btn-addwishlist hov-pointer trans-0-4" slot="activator" @click="addToWish(product.id)" style="margin-top: -20px;">
                                                <v-icon color="white darken-2" large>favorite</v-icon>
                                            </v-btn>
                                            <span>Wish list</span>
                                        </v-tooltip>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <v-btn color="success" @click="addToCart(product)">Add to Cart</v-btn>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-img wrap-pic-w of-hidden pos-relative" v-else>
                                    <img :src="product.image" @error="imageUrlAlt">

                                    <div class="block2-overlay trans-0-4">
                                        <v-tooltip bottom style="margin-left: 90%;" v-if="product.wish_list === 1">
                                            <v-btn icon class="mx-0 block2-btn-addwishlist hov-pointer trans-0-4" slot="activator" @click="addToWish(product.id)" style="margin-top: -20px;">
                                                <v-icon color="pink darken-2" large>favorite</v-icon>
                                            </v-btn>
                                            <span>Wish list</span>
                                        </v-tooltip>
                                        <v-tooltip bottom style="margin-left: 90%;" v-else>
                                            <v-btn icon class="mx-0 block2-btn-addwishlist hov-pointer trans-0-4" slot="activator" @click="addToWish(product.id)" style="margin-top: -20px;">
                                                <v-icon color="white darken-2" large>favorite</v-icon>
                                            </v-btn>
                                            <span>Wish list</span>
                                        </v-tooltip>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <v-btn color="primary" @click="addToCart(product)">Add to Cart</v-btn>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <button class="block2-name dis-block s-text3 p-b-5" @click="redirect(product.id)">{{ product.product_name }}</button>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <small class="list-price text-danger">List price: <s>{{ product.list_price }}</s></small>
                                        </div>
                                        <div class="col-6">
                                            <p>Price {{ product.price }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <p class="text-center" style="background: #f2dede; font-size: 13px; color: #a94442 !important;">No products available</p>
                    </div>
                </div>
                <div class="text-xs-center" style="margin: auto; width: 100%;" v-if="products.last_page > 1">
                    <v-pagination v-model="products.current_page" :length="products.last_page" total-visible="6" @input="next(products.path, products.current_page, 'products')" circle></v-pagination>
                </div>
            </div>
        </div>
    </section>
    <myVariants></myVariants>
</div>
</template>

<script>
import headerP from "../include/Headerpartial";
import myFilter from './details/filter'

import myVariants from '../home/products/variants'

export default {
    components: {
        headerP,
        myFilter,
        myVariants
    },
    data() {
        return {
            form: {
                search: ""
            },
            items: [{
                    state: "All"
                },
                {
                    state: "New",
                    abbr: "new_product"
                },
                {
                    state: "Popularity",
                    abbr: "best_sell"
                },
                {
                    state: "Featured",
                    abbr: "featured"
                }
            ],
            itemSelect: {
                abbr: "All",
                state: "All"
            },
            price: [0, 30000],
            priceSelect: {
                state: "All"
            },
            loader: false,
            cat_id: null,

            filter_data: {
                price: [0, 0],
                category_id: 0
            },
        };
    },
    methods: {
        searchItems() {
            eventBus.$emit("progressEvent");
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
        catId(item) {
            this.cat_id = item;
            this.FilterShop();
        },
        catAll() {
            this.cat_id = null;
            this.FilterShop();
        },
        getProducts() {
            var payload = {
                model: 'shop',
                update_list: 'updateProductsList',
            }
            this.$store.dispatch('getItems', payload)
        },
        // addToCart(cart) {
        //     console.log(cart);

        //     cart.order_qty = 1
        //     eventBus.$emit("addCartEvent", cart);
        // },

        addToCart(cart) {
            if (cart.product_variants.length > 0) {
                eventBus.$emit('selectVariantsEvent', cart)
                // this.select_variants()
                return
            }
            cart.order_qty = 1
            eventBus.$emit("addCartEvent", cart);
        },

        next(page) {
            var payload = {
                path: this.products.path,
                page: this.products.current_page,
                update_list: 'updateProductsList',
            }
            this.$store.dispatch('nextPage', payload)
        },
        getMenus() {
            var payload = {
                model: 'menus',
                update_list: 'updateMenuList',
            }
            this.$store.dispatch('getItems', payload)
        },
        FilterShop(id) {
            eventBus.$emit("progressEvent");
            this.filter_data.category_id = id
            eventBus.$emit("progressEvent");
            var payload = {
                model: 'FilterShop',
                update: 'updateProductsList',
                data: this.filter_data,

            }
            this.$store.dispatch('filterData', payload)
        },
        getWish() {

            var payload = {
                model: 'wish',
                update_list: 'updateWishList',
            }
            this.$store.dispatch('getItems', payload)

        },
        addToWish(item) {
            eventBus.$emit("WishListEvent", item);
        },

        imageUrlAlt(e) {
                event.target.src = "/assets/notfound/notfound.jpg"
        }
    },
    mounted() {
        // this.loader = true;
        this.FilterShop();
        this.getProducts();
        this.getMenus();
        eventBus.$emit("ScollTopEvent");
    },
    updated() {},
    beforeRouteLeave(to, from, next) {
        // eventBus.$emit("progressEvent");
        next();
    },
    created() {
        eventBus.$on("RefWishEvent", data => {
            this.FilterShop();
        });


    },
    computed: {
        products() {
            return this.$store.getters.products
        },
        menus() {
            return this.$store.getters.menu
        },
        loading() {
            return this.$store.getters.loading
        },
        wish() {
            return this.$store.getters.wish
        }
    },
};
</script>

<style scoped>
.wrap-pic-w img {
    height: 300px;
}
</style>
