export default {
    page_loader(state, payload) {
        state.page_loader = payload
    },
    loading(state, payload) {
        state.loading = payload
    },
    errors(state, payload) {
        state.errors = payload
    },
    alertEvent(state, payload) {
        state.alertEvent = payload
    },
    updateUsersList(state, payload) {
        state.users = payload
    },
    updateDeletedUsersList(state, payload) {
        state.deletedUsers = payload
    },
    updateRoleList(state, payload) {
        state.roles = payload
    },
    updatePermissionList(state, payload) {
        state.permissions = payload
    },
    updateProductsList(state, payload) {
        state.products = payload
    },
    updateSupplierList(state, payload) {
        state.suppliers = payload
    },
    updateClientList(state, payload) {
        state.clients = payload
    },
    updateSellerList(state, payload) {
        state.sellers = payload
    },
    updateSaleList(state, payload) {
        state.sales = payload
    },
    // Unique
    updateunique_sku(state, payload) {
        state.unique_sku = payload
    },
    updateunique_inv(state, payload) {
        state.unique_inv = payload
    },
    updateunique_pkg(state, payload) {
        state.unique_pkg = payload
    },

    updateDiscountList(state, payload) {
        state.discounts = payload
    },
    updateGroupList(state, payload) {
        state.groups = payload
    },
    updateDrawerList(state, payload) {
        state.drawers = payload
    },

    updateCategoryList(state, payload) {
        state.categories = payload
    },

    updateBrandList(state, payload) {
        state.brands = payload
    },

    // Deleted
    updateDeletedClients(state, payload) {
        state.deleted_clients = payload
    },

    updateOptionsList(state, payload) {
        state.options = payload
    },
    updateOptionValuesList(state, payload) {
        state.option_values = payload
    },
    updateSubcategoryList(state, payload) {
        state.subcategories = payload
    },
    updateMenuList(state, payload) {
        state.menu = payload
    },
    updateCurrencyList(state, payload) {
        state.currency = payload
    },
    updateSliderList(state, payload) {
        state.slider = payload
    },

    updateWeeklySalesList(state, payload) {
        state.weekly_sale = payload
    },

    updateTopSaleList(state, payload) {
        state.top_sales = payload
    },
    updateLowstokeList(state, payload) {
        state.low_stoke = payload
    },



    updateUserCountList(state, payload) {
        state.user_count = payload
    },
    updateWeekSalesCountList(state, payload) {
        state.week_sales_count = payload
    },
    updateSellerCountList(state, payload) {
        state.sellers_count = payload
    },
    updateSaleCountList(state, payload) {
        state.total_sales_count = payload
    },
    UpdateProductsCountList(state, payload) {
        state.product_count = payload
    },
    UpdateCategoryCountList(state, payload) {
        state.category_count = payload
    },
    UpdateBrandCountList(state, payload) {
        state.brand_count = payload
    },
    updateClientChartList(state, payload) {
        state.clients_chart = payload
    },
    updateSellerChartList(state, payload) {
        state.sellers_chart = payload
    },
    updateSaleChartList(state, payload) {
        state.sales_chart = payload
    },
    updateClientCountList(state, payload) {
        state.clients_count = payload
    },


    updateCartList(state, payload) {
        state.cart = payload

        var exists = state.cart.some(function (product_1) {
            return product_1.id === payload.id
        });
        if (!exists) {
            payload.ordered = 1
            state.cart.push(payload)
        } else {
            var index = state.cart.indexOf(payload);
            var add_item = (Object.assign({}, payload));
            add_item.ordered += 1
            // console.log(add_item);
            Object.assign(state.cart[index], add_item)
        }
        state.cart = state.cart
    },
}

