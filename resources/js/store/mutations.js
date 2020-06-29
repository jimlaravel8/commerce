export default {
    updateSlider (state, slider) {
       state.slider = slider
    },
    updateProduct (state, products) {
       state.products = products
    },

    updateShowProduct (state, product) {

      state.product = product
   },

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
  updateSaleList(state, payload) {
      state.sales = payload
  },
  // Unique
  updateCartsList(state, payload) {
      state.carts = payload
  },
  updateCartCountList(state, payload) {
      state.cart_count = payload
  },
  updateCartTotalList(state, payload) {
      state.cart_total = payload
  },
  updateWishCountList(state, payload) {
      state.wish_count = payload
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
  updateOrderList(state, payload) {
      state.orders = payload
  },
  updateProductSettingList(state, payload) {
      state.product_setting = payload
  },
  updateSliderList(state, payload) {
      state.slider = payload
  },

  CategoryList(state, payload) {
    state.category = payload
  },
  Subcategory(state, payload) {
    state.subcategory = payload
  },

  updateSliderSList(state, payload) {
      state.sliderS = payload
  },


  updateRelatedList(state, payload) {
      state.related = payload
  },


  updateOrderAddressList(state, payload) {
      state.order_address = payload
  },

  updateSlideProductsList(state, payload) {
      state.product_slide = payload
  },
  updateonSaleList(state, payload) {
      state.onSale = payload
  },

  updateCategortProductsList(state, payload) {
      state.category_products = payload
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


  SET_TOKEN(state, token) {
    state.token = token;
  },

  REMOVE_TOKEN(state) {
    state.token = null;
  },

  overlayLoader(state, payload) {
    state.overlay = payload
  },
  }
