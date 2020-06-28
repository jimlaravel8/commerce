<template>
<div>
    <v-menu offset-y id="menu_css" transition="scale-transition">
        <template v-slot:activator="{ on }">
            <v-btn text color="blue-grey" class="ma-2 white--text" v-on="on" style="border: 1px solid #57cdfc;">
                Categories
                <v-icon right color="primary">arrow_drop_down</v-icon>
            </v-btn>
        </template>
        <v-card>

            <v-row @mouseleave="display_menu = false">
                <v-col sm="4" style="border-right: solid 1px #999;max-width: 200px !important;min-width: 200px !important;" v-if="display_menu">
                    <v-list style="cursor: pointer">
                        <v-list-item v-for="(item, index) in menu.data" :key="index" @mouseover="changeCategory(item)" @mouseenter="display_menu = true">
                            <v-list-item-title>{{ item.menu }}</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-col>

                <v-col sm="12" style="border-right: solid 1px #999;max-width: 200px !important;min-width: 200px !important;" v-else>
                    <v-list style="cursor: pointer">
                        <v-list-item v-for="(item, index) in menu.data" :key="index" @mouseover="changeCategory(item)" @mouseenter="display_menu = true">
                            <v-list-item-title>{{ item.menu }}</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-col>
                <!-- <v-divider vertical /> -->
                <v-col sm="7" v-if="display_menu">
                    <v-card class="mx-auto" outlined>
                        <v-list subheader three-line>
                            <!-- <v-subheader>User Controls</v-subheader> -->
                            <v-row wrap row>
                                <v-col sm="4" v-for="category in categories" :key="category.id">
                                    <v-list-item>
                                        <v-list-item-content>
                                            <router-link :to="'/category/' + category.id">
                                                <v-list-item-title>{{ category.category }}</v-list-item-title>
                                            </router-link>
                                            <v-list-item-subtitle v-for="sub in category.subcategories" :key="sub.id">
                                                <router-link :to="'/subcategories/' + sub.id">
                                                    {{ sub.subcategory }}
                                                </router-link>
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-col>
                            </v-row>

                        </v-list>
                    </v-card>
                </v-col>

            </v-row>
        </v-card>

    </v-menu>
</div>
</template>

<script>
import {
    mapState
} from "vuex";
export default {
    name: 'Example',
    data: () => ({
        display_menu: false,
        categories: [],
    }),

    async fetch({
        store
    }) {

        var payload = {
            model: 'menu',
            update: 'updateMenuList',
        }

        await store.dispatch("getItems", payload)
    },
    computed: {
        ...mapState(['menu']),
    },
    methods: {
        changeCategory(data) {
            // console.log(data);
            this.categories = data.categories
        }
    },
}
</script>

<style>
.theme--dark.v-list {
    /* background: #fff !important;
    color: #999 !important; */
}

.v-list-item .v-list-item__title,
.v-list-item .v-list-item__subtitle {
    color: #333;
}

.v-list--three-line .v-list-item .v-list-item__subtitle,
.v-list-item--three-line .v-list-item__subtitle {
    color: #999;
}

.v-list-item,
.v-list-item__content {
    padding: 0 !important;
}

.theme--dark.v-list-item:not(.v-list-item--active):not(.v-list-item--disabled) {
    margin-left: 10px;
}
</style>
