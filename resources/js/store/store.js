import actions from './actions';
import getters from './getters';
import mutations from './mutations';

export default {
    state: {
        page_loader: false,
        loading: false,
        errors: [],
        users: [],
        deletedUsers: [],
        roles: [],
        permissions: [],
        products: [],
        customers: [],
        sellers: [],
        discount: [],
        sales: [],
        groups: [],
        drawers: [],
        discounts: [],
        clients: [],
        suppliers: [],
        categories: [],
        menu: [],
        subcategories: [],
        brands: [],
        unique_sku: null,
        option_values: [],
        currency: [],
        // Deleted
        deleted_clients: [],


        // Dashboard
        user_count: null,
        week_sales_count: null,
        sellers_count: null,
        total_sales_count: null,
        clients_count: null,

        product_count: null,
        category_count: null,
        brand_count: null,
        low_stoke: null,
        weekly_sale: [],
        top_sales: [],

        // Charts
        clients_chart: null,
        sellers_chart: null,
        sales_chart: [],


        // Api
        options: [],
        slider_1: [],
        slider: [],
        cart: [],


    },
    getters,
    mutations,
    actions
}
