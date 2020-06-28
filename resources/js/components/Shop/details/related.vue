<template>
<div>
    <v-data-iterator :items="related.data" :items-per-page.sync="itemsPerPage" :page="page" :search="search" :sort-by="sortBy.toLowerCase()" :sort-desc="sortDesc" hide-default-footer>
        <template v-slot:header>
            <v-toolbar dark color="blue darken-3" class="mb-1">
                <!-- <v-text-field v-model="search" clearable flat solo-inverted hide-details prepend-inner-icon="search" label="Search"></v-text-field>
                    <template v-if="$vuetify.breakpoint.mdAndUp">
                        <v-spacer></v-spacer>
                        <v-select v-model="sortBy" flat solo-inverted hide-details :items="keys" prepend-inner-icon="search" label="Sort by"></v-select>
                        <v-spacer></v-spacer>
                        <v-btn-toggle v-model="sortDesc" mandatory>
                            <v-btn large depressed color="blue" :value="false">
                                <v-icon>mdi-arrow-up</v-icon>
                            </v-btn>
                            <v-btn large depressed color="blue" :value="true">
                                <v-icon>mdi-arrow-down</v-icon>
                            </v-btn>
                        </v-btn-toggle>
                    </template> -->
                Related Products
            </v-toolbar>
        </template>

        <template v-slot:default="props">
            <v-row>
                <v-col v-for="item in props.items" :key="item.product_name" cols="12" sm="6" md="4" lg="3">
                    <v-hover v-slot:default="{ hover }">
                        <v-card class="mx-auto" color="grey lighten-4" max-width="800">
                            <v-img :aspect-ratio="16/9" :src="item.image" height="300px">
                                <v-expand-transition>
                                    <div v-if="hover" class="d-flex transition-fast-in-fast-out black darken-2 v-card--reveal display-3 white--text" style="height: 100%;">
                                        <v-tooltip bottom>
                                            <template v-slot:activator="{ on }">
                                                <v-btn icon v-on="on" @click="product_view(item)">
                                                    <v-icon color="primary">visibility</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Quick view</span>
                                        </v-tooltip>
                                        <v-tooltip bottom>
                                            <template v-slot:activator="{ on }">
                                                <v-btn icon v-on="on">
                                                    <v-icon color="primary">favorite</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>add to wish list</span>
                                        </v-tooltip>
                                        <v-tooltip bottom>
                                            <template v-slot:activator="{ on }">
                                                <v-btn icon v-on="on" @click="addToCart(item)">
                                                    <v-icon color="primary">shopping_cart</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>add to cart</span>
                                        </v-tooltip>
                                    </div>
                                </v-expand-transition>
                            </v-img>
                            <v-card-text class="pt-6" style="position: relative;">
                                <!-- <v-btn absolute color="orange" class="white--text" fab large right top  @click="addToCart(item)">
                                <v-icon>shopping_cart</v-icon>
                            </v-btn> -->
                                <div class="font-weight-light grey--text title mb-2">{{ item.product_name }}</div>
                                <div class="font-weight-light title mb-2">
                                    {{ item.price }}
                                </div>
                            </v-card-text>
                        </v-card>
                    </v-hover>

                </v-col>
            </v-row>
        </template>

        <template v-slot:footer>
            <v-row class="mt-2" align="center" justify="center">
                <span class="grey--text">Items per page</span>
                <v-menu offset-y>
                    <template v-slot:activator="{ on }">
                        <v-btn dark text color="primary" class="ml-2" v-on="on">
                            {{ itemsPerPage }}
                            <v-icon>mdi-chevron-down</v-icon>
                        </v-btn>
                    </template>
                    <v-list>
                        <v-list-item v-for="(number, index) in itemsPerPageArray" :key="index" @click="updateItemsPerPage(number)">
                            <v-list-item-title>{{ number }}</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>

                <v-spacer></v-spacer>

                <span class="mr-4
            grey--text">
                    Page {{ page }} of {{ numberOfPages }}
                </span>
                <v-btn fab dark color="blue darken-3" class="mr-1" @click="formerPage">
                    <v-icon>mdi-chevron-left</v-icon>
                </v-btn>
                <v-btn fab dark color="blue darken-3" class="ml-1" @click="nextPage">
                    <v-icon>mdi-chevron-right</v-icon>
                </v-btn>
            </v-row>
        </template>
    </v-data-iterator>
</div>
</template>

<script>
export default {
    components: {
    },
    data() {
        return {
            itemsPerPageArray: [4, 8, 12],
            search: '',
            filter: {},
            sortDesc: false,
            page: 1,
            itemsPerPage: 4,
            sortBy: 'product_name',
            keys: [
                'Product name',
                'sku no',
            ],
        }
    },
    computed: {
        numberOfPages() {
            return Math.ceil(this.related.data.length / this.itemsPerPage)
        },

        related() {
            return this.$store.getters.related
        },
    },
    methods: {
        nextPage() {
            if (this.page + 1 <= this.numberOfPages) this.page += 1
        },
        formerPage() {
            if (this.page - 1 >= 1) this.page -= 1
        },
        updateItemsPerPage(number) {
            this.itemsPerPage = number
        },

        product_view(product) {
            eventBus.$emit("viewProEvent", product);
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
        wishList(item) {
            eventBus.$emit("WishListEvent", item);
        }
    },
}
</script>

<style scoped>
.v-card--reveal {
    align-items: center;
    bottom: 0;
    justify-content: center;
    opacity: .5;
    position: absolute;
    width: 100%;
}
</style>
