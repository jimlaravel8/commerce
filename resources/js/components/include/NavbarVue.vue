<template>
<div>
    <header class="section-header" style="max-height: 180px;">
        <nav class="navbar navbar-dark navbar-expand p-0 bg-primary" :class="{classA: scrollPosition < 150, classB: scrollPosition > 150}">
            <div class="container">
                <ul class="navbar-nav d-none d-md-flex mr-auto">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">Home</router-link>
                    </li>
                    <!-- <li class="nav-item">
                        <router-link to="/shop" class="nav-link">Shop</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/category" class="nav-link">Category</router-link>
                    </li> -->
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="tel:+99912">Call: +99912</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> English </a>
                    </li>
                </ul> <!-- list-inline //  -->
            </div> <!-- navbar-collapse .// -->

            <!-- container //  -->
        </nav> <!-- header-top-light.// -->

        <section class="header-main border-bottom">
            <div class="">
                <v-row wrap>
                    <!-- <div class="row align-items-center"> -->
                    <v-col sm="4" md="8" lg="2" :class="{show_menu: show_menu}">
                        <router-link to="/" class="brand-wrap">
                            <!-- <img class="logo" :src="logo"> -->
                            Loter
                        </router-link>
                    </v-col>
                    <!-- <v-col sm="6" md="2" lg="2">
                        test
                    </v-col>

                    <v-col sm="5" md="3" lg="3">
                        test
                    </v-col> -->

                    <v-col sm="6" md="4" lg="4">
                        <div class="widgets-wrap float-md-right">
                            <div class="widget-header  mr-3">
                                <!-- <div class="icon icon-sm rounded-circle border"> -->
                                    <v-badge color="green" :content="cart_count">
                                        <myCart />
                                    </v-badge>
                                <!-- </div> -->
                                <!-- <span class="badge badge-pill badge-danger notify">{{ cart_count }}</span> -->
                            </div>
                            <div class="widget-header icontext">
                                <div class="icon icon-sm rounded-circle border" v-if="user">
                                    <!-- <v-icon>account_circle</v-icon> -->
                                    <myAccount />
                                </div>
                                <div class="text">
                                    <div v-if="!user">
                                        <a href="/login">Sign in</a>
                                        <a href="/register">Sign up</a>
                                    </div>
                                    <span class="text-muted" v-else>Welcome {{ user.name }}! </span>
                                </div>
                            </div>
                        </div> <!-- widgets-wrap.// -->
                    </v-col>
                </v-row>
            </div> <!-- container.// -->
        </section> <!-- header-main .// -->
    </header>

    <v-snackbar :timeout="timeout" bottom :color="Scolor" left v-model="snackbar">
        {{ message }}
        <v-icon dark right>check_circle</v-icon>
    </v-snackbar>
</div>
</template>

<script>
// import mySearch from './Search'
// import myCategory from './nav/category'
import myCart from "./nav/cart";
import myAccount from "./nav/login";
import {
    mapState
} from 'vuex';
export default {
    props: ['user'],
    name: 'navigation',
    components: {
        myCart,
        myAccount

    },
    data() {
        return {
            show_menu: false,
            timeout: 5000,
            snackbar: false,
            message: '',
            Scolor: 'black',
            scrollPosition: null,
            logo: process.env.LOGO,
            offsetTop: 0,
            duration: 1000,
            easing: "easeInOutCubic",
        }
    },

    methods: {

        updateScroll() {
            this.scrollPosition = window.scrollY
        },
        getCart() {
            // if (this.user) {
            //     var cookie_id = this.$store.state.auth.user.id
            // } else {
            //     var rString = this.randomString(15, '0123456789');
            //     if (this.$cookie.get('cart_session') == null) {
            //         this.$cookie.set('cart_session', rString);
            //     }
            //     var cookie_id = this.$cookie.get('cart_session')
            // }

            var payload = {
                model: 'getCart',
                // id: cookie_id,
                update: 'updateCartsList',
            }
            this.$store.dispatch('getItems', payload)
        },

        getMenu() {
            var payload = {
                model: 'menu',
                update: 'updateMenuList',
            }

            this.$store.dispatch("getItems", payload)
        },

        get_cart_total() {

            var payload = {
                model: 'cart_total',
                update: 'updateCartTotalList',
            }
            this.$store.dispatch('getItems', payload)
        },
        get_cart_count() {

            var payload = {
                model: 'cart_count',
                update: 'updateCartCountList',
            }
            this.$store.dispatch('getItems', payload)

            // var payload = {
            //     model: 'cart_count',
            //     update: 'updateCartCountList',
            // }

            // this.$store.dispatch('getItems', payload)
        },

        showerror(data) {
            // this.$message({
            //     showClose: true,
            //     message: 'Congrats, this is a success message.',
            //     type: 'success'
            // });

            this.message = data;
            this.Scolor = "black";
            this.snackbar = true;
        },

        showalert(data) {
            // this.$message({
            //     showClose: true,
            //     message: 'Congrats, this is a success message.',
            //     type: 'success'
            // });
            // alert('test')
            this.message = data;
            this.Scolor = "black";
            this.snackbar = true;
        },

        update_cart(data) {
            console.log(data);
            // var cart = data.cart

            // cart.quantity = data.order_qty
            var payload = {
                model: 'update_cart',
                id: data.id,
                data: data,
            }
            this.$store.dispatch('postItem', payload).then((res) => {
                this.getCart()
                this.get_cart_total()
                this.get_cart_count()
            })
        },
        addToCart(cart) {
            // console.log(cart);

            // if (this.user) {
            //     var cookie_id = this.$store.state.auth.user.id
            // } else {
            //     var rString = this.randomString(15, '0123456789');
            //     if (this.$cookie.get('cart_session') == null) {
            //         this.$cookie.set('cart_session', rString);
            //     }
            //     var cookie_id = this.$cookie.get('cart_session')
            // }

            // console.log(cookie_id)
            // return

            eventBus.$emit("progressEvent");
            var payload = {
                model: 'cartAdd',
                // id: cookie_id,
                // id: cart.id,
                data: cart,
            }

            this.$store.dispatch('postItems', payload).then((res) => {
                this.getCart()
                this.get_cart_count()
                this.get_cart_total()
            })
        },
        randomString(length, chars) {
            var result = '';
            for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
            return result;
        },

        progressBar() {
            // this.$refs.topProgress.start();
        },

        onScroll(e) {
            // this.offsetTop = window.pageYOffset || document.documentElement.scrollTop;
        },
        flashCart(cart) {
            // if (this.user) {
            //     var cookie_id = this.$store.state.auth.user.id
            // } else {
            //     var rString = this.randomString(15, '0123456789');
            //     if (this.$cookie.get('cart_session') == null) {
            //         this.$cookie.set('cart_session', rString);
            //     }
            //     var cookie_id = this.$cookie.get('cart_session')
            // }

            this.$store.dispatch('overlayAction', true)
            var payload = {
                model: 'flashCart',
                data: cart,
                // id: cookie_id
            }
            this.$store.dispatch('postItems', payload).then((res) => {
                this.get_cart_total()
                this.getCart()
                this.get_cart_count()

            }).catch((error) => {
                console.log(error);
                this.$store.dispatch('overlayAction', false)
            })
        }

    },

    computed: {
        ...mapState(['cart_count']),



        // console.log(this.$auth.$state.access_local);

    },
    mounted() {
        window.addEventListener('scroll', this.updateScroll);
        // this.progressBar();
        this.getCart();
        // // this.getWish();
        this.get_cart_total()
        this.get_cart_count()
        // this.getCategory()
        // this.getMenu()
    },

    created() {
        eventBus.$on("addCartEvent", data => {
            this.addToCart(data);
        });
        eventBus.$on("subCartEvent", data => {
            this.update_cart(data);
        });
        eventBus.$on("WishListEvent", data => {
            this.addToWish(data);
        });
        eventBus.$on("cartTotalEvent", data => {
            this.get_cart_total()
        });

        eventBus.$on("flashCartEvent", data => {
            this.flashCart(data)
        });
        eventBus.$on("cartCountEvent", data => {
            this.get_cart_count()
        });
        eventBus.$on("cartEvent", data => {
            this.getCart()
        });
        eventBus.$on("alertRequest", data => {
            // console.log(data);

            this.showalert(data);
        });
        eventBus.$on("errorRequest", data => {
            this.showerror(data);
        });
        eventBus.$on("loadingRequest", data => {
            this.loadingalert();
        });
        eventBus.$on("progressEvent", data => {
            // this.$refs.topProgress.start();
        });
        eventBus.$on("StoprogEvent", data => {
            // this.$refs.topProgress.done();
        });
        eventBus.$on("ScollEvent", data => {
            // window.scrollTo(0, 300);
            // VueScroll.scrollTo('#headerq', 1000)
        });
        eventBus.$on("ScollTopEvent", data => {
            // window.scrollTo(0, 0);
            // VueScroll.scrollTo('#headerq', 1000)
        });
        eventBus.$on("errorEvent", data => {
            this.showerror(data);
        });

        eventBus.$on("Productdetails", data => {
            this.redirect(data);
        });
        eventBus.$on("showMenuEvent", data => {
            this.show_menu = data
        });

        // this.timer = window.setInterval(() => {
        //     this.getCart();
        //     // eventBus.$emit("cartEvent", response.data);
        // }, 60000);

        eventBus.$on('addCartVariantEvent', res_data => {
            var choices = res_data.choices
            var data = res_data.skus
            this.product = data.product
            data.product.sku_no = data.sku_no
            data.product.order_qty = 1
            data.product.price = data.price
            data.product.quantity = data.quantity
            data.product.sku_id = data.sku_id

            if (choices) {
                data.product.choices = choices
            }

            this.addToCart(data.product);
            // this.addCart(data.product)
        })
    },

}
</script>

<style>
header {
    position: fixed;
    width: 100%;
    background: #000;
    z-index: 100;
}

.v-btn--outlined .v-btn__content .v-icon,
.v-btn--round .v-btn__content .v-icon,
.v-icon.v-icon {
    color: #00b5ff !important
}

.classA {
    display: block;
}

.classB {
    display: none;
}

.bg-primary {
    background-color: #29425d !important;
}

.v-snack__content {
    color: #fff !important;
}

/* .ais-SearchBox [type=search] {
    color: white !important;
} */

.show_menu .logo {
    top: 8% !important;
}
</style>
