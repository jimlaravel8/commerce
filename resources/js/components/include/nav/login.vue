<template>
<div class="text-center">
    <v-menu v-model="menu" :close-on-content-click="false" :nudge-width="200" offset-y>
        <template v-slot:activator="{ on }">
            <v-btn text icon v-on="on">
                <v-icon>account_circle</v-icon>
            </v-btn>

        </template>
        <v-card>
            <v-card-text>
                <v-list dense>

                    <v-list-item>
                        <avatar :username="this.$store.state.auth.user.name" style="font-size: 20px;margin: auto;padding: 20px;"></avatar>
                        <v-list-item-content>
                            <v-list-item-title>{{ this.$store.state.auth.user.name }}</v-list-item-title>
                        </v-list-item-content>

                    </v-list-item>
                    <v-divider></v-divider>
                    <v-list-item-group color="primary">
                        <v-list-item>
                            <router-link to="/account" class="v-list-item v-list-item--link theme--light">
                                <div class="v-list__tile__action">
                                    <i aria-hidden="true" class="icon material-icons">account_circle</i>
                                </div>
                                <div class="v-list-item__content">
                                    <div class="v-list-item__title">My Account</div>
                                </div>
                            </router-link>
                        </v-list-item>
                    </v-list-item-group>
                </v-list>
            </v-card-text>

            <v-card-actions>
                <v-tooltip bottom>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn icon v-bind="attrs" v-on="on" @click="logout">
                            <v-icon color="grey lighten-1">mdi-logout</v-icon>
                        </v-btn>
                    </template>
                    <span>Logout</span>
                </v-tooltip>
            </v-card-actions>

        </v-card>
    </v-menu>
</div>
</template>

<script>
import {
    mapState
} from 'vuex'
import Avatar from 'vue-avatar'

export default {
    components: {
        Avatar
    },

    data: () => ({
        fav: true,
        menu: false,
        message: false,
        hints: true,
    }),
    methods: {
        logout() {
            this.$auth.logout()
        },

        getCart() {
            eventBus.$emit("cartEvent")
        },
    },
    mounted() {
        this.getCart()
    },
    computed: {
        ...mapState(['carts', 'cart_count'])
    },
}
</script>
