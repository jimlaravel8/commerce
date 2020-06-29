<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\models\CouponSession;
use App\models\Product;
use App\models\ProductAttribute;
use App\models\Sku;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function cartAdd(Request $request)
    {
        // return $request->all();
        // Cart::clear();
        $product = $request->all();
        // return $product['sku_no'];
        // return ['id' => $id, 'product' => $product, 'name' => $product['product_name'], 'quantity' => $request->order_qty, 'price' => $request->price];
        $product['skus'] = null;
        $product['product_variants'] = null;
        $product['categories'] = null;
        $product['images'] = null;
        // return $product;
        // $product = Product::setEagerLoads([])->find($id);
        if (!$request->price) {
            $request->price = 0;
        }
        // $product_name = ($request->product_name) ? $product->product_name;
        // Cart::add(['id' => $id, 'product' => $product, 'name' => $product['product_name'], 'quantity' => $request->order_qty, 'price' => $request->price]);
        $sku_id = Sku::where('sku_no', $request->sku_no)->first('id');
        $sku_id = $sku_id->id;
        // return $sku_id;
        Cart::add([
            'id' => $sku_id,
            'name' => $product,
            'quantity' => $request->order_qty,
            'price' => $request->price,
            'product_i' => ['test'],
            'attributes' => array( // attributes field is optional
                $request->choices
            )
        ]);
        return $this->getCart();
    }
    public function update_cart(Request $request, $id)
    {
        // return $request->all();
        $cart_item = $request->all();
        // return $cart_item['name']['sku_no'];
        $sku_id = Sku::where('sku_no', $cart_item['name']['sku_no'])->first('id');
        $sku_id = $sku_id->id;

        // return $sku_id;

        $quantity = $request->order_qty;
        $cart_available = Cart::get($cart_item['id']);
        if ($cart_available->quantity < 2 && $quantity == -1) {
            $this->flash_cart($id, $cart_item['id']);
            return;
        }
        // dd($quantity);
        Cart::update($cart_item['id'], ['quantity' => $quantity]);
        return;
    }

    public function flashCart(Request $request)
    {
        // return $request->all();
        Cart::remove($request->id);
    }

    public function flash_cart($id, $cart_id)
    {
        Cart::remove($cart_id);
    }
    public function getCart()
    {
        // Cart::session(1)->remove();

        // return Cart::getContent();
        return $cart_d =  Cart::getContent();
        // foreach ($cart_d as $cart) {
        //     $sku = Sku::where('id', (int) $cart->id)->first('product_id');
        //     // return $sku;
        //     $products = Product::setEagerLoads([])->where('id', $sku->product_id)->get();

        //     $prod_tras = new ProductController;
        //     $prod_tras = $prod_tras->transform_product($products);

        //     $cart['product'] = $prod_tras[0];
        //     // return ($cart);
        // }
        // $cart_d->transform(function ($cart) {
        // dd($cart->id);
        // $product = Product::setEagerLoads([])->find((int) $cart->id);
        // // dd($product);
        // $cart->product = $product;
        // return $cart;
        // });
        return $cart_d;
    }

    public function getCartProduct()
    {
        $cart = $this->getCart();
        foreach ($cart as $product) {
            $cart_id = $product['item']['id'];
            $cart_qty = $product['qty'];
            $product_s = Product::find($cart_id);
            $new_qty = $product_s->quantity - $cart_qty;
            // dd($product_s->quantity .' - '. $cart_qty . ' = '. $new_qty);
            $product = Product::where('id', $cart_id)->update(['quantity' => $new_qty]);
        }
        return $product;
    }


    public function couponSes()
    {
        $oldCounpon = Session::has('coupon') ? Session::get('coupon') : null;
        $coupon = new CouponSession($oldCounpon);
        return $coupon->getCoupon();
    }

    public function cartAdd_1(Request $request, $id)
    {
        // Cart::destroy();
        // return;
        return $request->all();
        $product = Product::setEagerLoads([])->find($id);
        if ($request->attribute) {
            $attr_ = ProductAttribute::select('quantity', 'value', 'price')->find($request->attribute);
            $attr_qty = $attr_->quantity;
            $product->quantity = $request->attribute;
            $price = (float) $attr_['price'];
            // dd($price);
            $value = $attr_['value'];
            if ($request->quantity > $attr_qty) {
                return response()->json(['errors' => "Only " . $attr_qty . " items are available, you already have " . $av_quantity . " in your cart", 'status' => '200'], '200');
            }
            Cart::add(['id' => $id, 'product' => $product, 'name' => $product->product_name, 'qty' => $request->quantity, 'price' => $price, 'options' => ['size' => $value]]);
        } else {
            // dd($product->price);
            if ($request->quantity > $product->quantity) {
                return response()->json(['errors' => "Only " . $product->quantity . " items are available, you already have " . $product->quantity . " in your cart", 'status' => '200'], '200');
                Cart::add(['id' => $id, 'product' => $product, 'name' => $product->product_name, 'qty' => $request->quantity, 'price' => $product->price]);
            }
            Cart::add(['id' => $id, 'product' => $product, 'name' => $product->product_name, 'qty' => $request->quantity, 'price' => (int) $product->price]);
        }
    }


    public function cart_total()
    {
        $total = 0;
        $items = $this->getCart();
        // dd($items);
        // return  $item->getPriceSum();

        foreach ($items as $item) {

            $item->id; // the Id of the item
            $item->name; // the name
            $item->price; // the single price without conditions applied
            $total += $item->getPriceSum(); // the subtotal without conditions applied
            $item->getPriceWithConditions(); // the single price with conditions applied
            $item->getPriceSumWithConditions(); // the subtotal with conditions applied
            $item->quantity; // the quantity
            $item->attributes; // the attributes
            // if ($item->attributes->has('size')) {
            //     // item has attribute size
            // } else {
            //     // item has no attribute size
            // }
        }
        return $total;

        // return $cart = Cart::getSubTotal();
        // return str_replace(',', '', $cart);
    }

    public function cart_count()
    {
        $cart_d =  Cart::getContent();
        return $cart_d->count();
    }
}
