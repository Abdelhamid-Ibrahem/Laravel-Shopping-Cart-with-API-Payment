<?php

namespace App\Http\Controllers;

use App\Product;
use App\Order;
use App\Cart;
use Illuminate\Http\Request;
use Session;
use Auth;
use Stripe\Charge;
use Stripe\Stripe;

class ProductController extends Controller
{
  public function getIndex()
    {
    	$products = Product::all ();
        return view('shop.index', ['products' => $products]);
    }

  public function getAddToCart(Request $request, $id) {

  	$Product = Product::find($id);
  	$oldCart = Session::has('cart') ? Session::get('cart') : null;
  	$cart = new Cart($oldCart);
  	$cart->add($Product, $Product->id);

  	$request->session()->put('cart', $cart);

  	return redirect()->route('product.index');
  }

  public function getReduceByOne($id) {
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->reduceByOne($id);

    if (count($cart->items) > 0) {
      Session::put('cart', $cart);
    }else {
      Session::forget('cart');
    }

    return redirect()->route('product.shoppingCart');
  }

  public function getRemoveItem($id) {
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->removeItem($id);

    if (count($cart->items) > 0) {
      Session::put('cart', $cart);
    }else {
      Session::forget('cart');
    }

    return redirect()->route('product.shoppingCart');
  }

  public function getCart() {
	if (!Session::has('cart')) {
		return view('shop.shopping-cart');
	}
	$oldCart = Session::get('cart');
	$cart = new cart($oldCart);
	return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
  }
  public function getCheckout() {
  	if (!Session::has('cart')) {
		return view('shop.shopping-cart');
	}
  	$oldCart = Session::get('cart');
  	$cart = new cart($oldCart);
  	$total = $cart->totalPrice;
  	return view('shop.checkout', ['total' => $total]);
  }

  public function postCheckout(Request $request)
  {
      if (!Session::has('cart')) {
         return redirect()->route('shop.shoppingCart');
    }
    $oldCart = Session::get('cart');
    $cart = new cart($oldCart);

      Stripe::setApiKey('pk_test_TYooMQauvdEDq54NiTphI7jx');
    try {
      $charge = Charge::create(array(
          "amount" => $cart->totalPrice * 100,
          "currency" => "usd",
          "source" => $request->input('stripeToken'), // obtained with Stripe.js
          "description" => "Test Charge"
      ));
        $Order = new Order();
        $Order->cart = serialize($cart);
        $Order->address = $request->input('address');
        $Order->name = $request->input('name');
        $Order->payment_id = $charge->id;

      Auth::user()->orders()->save($Order);

    } catch (\Exception $e) 
      {
         return redirect()->route('checkout')->with('error', $e->getMessage());
      }

      Session::forget('cart');
      return redirect()->route('product.index')->with('success', 'Successfully purchased products');
 }

}
