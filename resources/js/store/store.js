import actions from './actions';
import getters from './getters';
import mutations from './mutations';


export default {
    state: {

    loading: false,
    errors: [],
    users: [],
    deletedUsers: [],
    roles: [],
    permissions: [],
    products: [],
    customers: [],
    discount: [],
    sales: [],
    order_address: [],
    related: [],
    carts: [],
    discounts: [],
    clients: [],
    cart_count: null,
    categories: [],
    menu: [],
    subcategories: [],
    brands: [],
    wish_count: null,
    option_values: [],
    orders: [],
    category_products: [],
    category: [],
    subcategory: [],
    product_slide: [],
    cart_total: null,
    // Deleted
    deleted_clients: [],
    onSale: [],

    // Api
    options: [],
    sliderS: [],
    slider: [],
    cart: [],
    product_setting: [],

    product: [],

    overlay: false,


    page_loader: false,
    token: null,

  },
    getters,
    mutations,
    actions
}
