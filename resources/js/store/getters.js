export default {

    page_loader(state) {
        return state.page_loader
    },
    
    loading(state) {
        return state.loading;
    },
    errors(state) {
        return state.errors;
    },
    alertEvent(state) {
        eventBus.$emit('alertEvent', state)
        // return state.alertEvent;
    },
    users(state) {
        return state.users
    },
    deletedUsers(state) {
        return state.deletedUsers
    },
    roles(state) {
        return _.orderBy(state.roles, 'name', 'asc')
    },
    permissions(state) {
        return state.permissions;
    },
    products(state) {
        return state.products
    },
    clients(state) {
        return state.clients
    },
    sellers(state) {
        return state.sellers
    },
    suppliers(state) {
        return state.suppliers
    },
    customers(state) {
        return state.customers
    },
    discount(state) {
        return state.discount
    },
    sales(state) {
        return state.sales
    },
    groups(state) {
        return state.groups
    },
    drawers(state) {
        return state.drawers
    },

    discounts(state) {
        return state.discounts
    },
    // Unique
    unique_sku(state) {
        return state.unique_sku;
    },
    categories(state) {
        return state.categories;
    },
    menu(state) {
        return state.menu;
    },
    subcategories(state) {
        return state.subcategories;
    },
    brands(state) {
        return state.brands;
    },
    currency(state) {
        return state.currency;
    },
    options(state) {
        return state.options;
    },
    option_values(state) {
        return state.option_values;
    },
    weekly_sale(state) {
        return state.weekly_sale;
    },
    low_stoke(state) {
        return state.low_stoke;
    },



    // Dashboard
    user_count(state) {
        return state.user_count
    },
    week_sales_count(state) {
        return state.week_sales_count
    },
    sellers_count(state) {
        return state.sellers_count
    },
    total_sales_count(state) {
        return state.total_sales_count
    },
    clients_count(state) {
        return state.clients_count
    },
    product_count(state) {
        return state.product_count;
    },
    category_count(state) {
        return state.category_count;
    },
    brand_count(state) {
        return state.brand_count;
    },
    top_sales(state) {
        return state.top_sales;
    },

    // Charts
    sales_chart(state) {
        return state.sales_chart
    },
    clients_chart(state) {
        return state.clients_chart
    },
    sellers_chart(state) {
        return state.sellers_chart
    },

}
