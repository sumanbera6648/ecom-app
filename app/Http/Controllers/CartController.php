<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function product()
    {
        $val = Product::all();
        return view('products')->with('products',$val);
    }
    public function index()
    {
        return view('frontend.cart');
    }
    public function addToCart(Product $product)
    {
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [$product->id => $this->sessionData($product)];
            return $this->setSessionAndReturnResponse($cart);
        }
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
            return $this->setSessionAndReturnResponse($cart);
        }
        $cart[$product->id] = $this->sessionData($product);
        return $this->setSessionAndReturnResponse($cart);

    }
    public function changeQty(Request $request, Product $product)
    {
        $cart = session()->get('cart');
        if ($request->change_to === 'down') {
            if (isset($cart[$product->id])) {
                if ($cart[$product->id]['quantity'] > 1) {
                    $cart[$product->id]['quantity']--;
                    return $this->setSessionAndReturnResponse($cart);
                } else {
                    return $this->removeFromCart($product->id);
                }
            }
        } else {
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity']++;
                return $this->setSessionAndReturnResponse($cart);
            }
        }

        return back();
    }
    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', "Removed from Cart");
    }
    protected function sessionData(Product $product)
    {
        return [
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price,
            'image' => $product->image
        ];
    }

    protected function setSessionAndReturnResponse($cart)
    {
        session()->put('cart', $cart);
        return redirect()->route('cart')->with('success', "Added to Cart");
    }

}
