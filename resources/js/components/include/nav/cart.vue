<template>
<div class="text-center">
    <v-menu v-model="menu" :close-on-content-click="false" :nudge-width="200" offset-y>
        <template v-slot:activator="{ on }">
            <v-btn text icon color="primary" v-on="on">
                <v-icon>shopping_cart</v-icon>
            </v-btn>

        </template>

        <v-card style="padding-right: 10px;">
            <ul class="header-cart-wrapitem">
                <li class="header-cart-item" v-for="cart in carts" :key="cart.id" style="cursor: pointer;border-bottom: 1px solid rgba(153, 153, 153, 0.31)">
                    <div class="header-cart-item-img">
                        <img :src="cart.name.image" alt="IMG" style="border-radius: 10px">
                    </div>

                    <div class="header-cart-item-txt">
                        <a href="#" class="header-cart-item-name">{{ cart.name.product_name }}</a>
                        <span class="header-cart-item-info">{{ cart.quantity }} X {{ cart.price }}</span>
                    </div>
                </li>
            </ul>
            <v-divider></v-divider>
            <v-card-actions>
                <v-spacer></v-spacer>
                <router-link to="/cart">
                    <v-btn text @click="menu = false">Go To Cart</v-btn>
                </router-link>
                <router-link to="/checkout">
                    <v-btn color="primary" text @click="menu = false">Checkout</v-btn>
                </router-link>
            </v-card-actions>
        </v-card>
    </v-menu>
</div>
</template>

<script>
import {
    mapState
} from 'vuex'
export default {
    data: () => ({
        fav: true,
        menu: false,
        message: false,
        hints: true,
    }),
    methods: {

        getCart() {
            eventBus.$emit("cartEvent")

        },
    },
    mounted() {
        // this.getCart()
    },
    computed: {
        ...mapState(['carts', 'cart_count'])
    },
}
</script>
