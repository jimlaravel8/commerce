export default {
    loading(state) {
      return state.loading;
    },
    errors(state) {
      return state.errors;
    },
    page_loader(state) {
      return state.page_loader;
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
    product(state) {
      return state.product
    },
    clients(state) {
      return state.clients
    },
    order_address(state) {
      return state.order_address;
    },
    related(state) {
      return state.related
    },
    product_slide(state) {
      return state.product_slide
    },
    category_products(state) {
      return state.category_products
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
    carts(state) {
      return state.carts
    },
    cart_count(state) {
      return state.cart_count
    },

    discounts(state) {
      return state.discounts
    },
    // Unique
    wish_count(state) {
      return state.wish_count;
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
    cart_total(state) {
      return state.cart_total;
    },
    orders(state) {
      return state.orders;
    },
    onSale(state) {
      return state.onSale;
    },


    options(state) {
      return state.options;
    },
    option_values(state) {
      return state.option_values;
    },
    product_setting(state) {
      return state.product_setting;
    },
    slider(state) {
      return state.slider;
    },
    sliderS(state) {
      return state.sliderS;
    },


    token(state) {
      return state.token;
    },

    // isAuthenticated(state) {
    //   return state.loggedIn
    // },

    loggedIn(state) {
      return state.loggedIn
    }
  }
