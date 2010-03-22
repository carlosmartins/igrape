<?php
class CartController extends Controller {

	/**
	 * Lists the products in the shopping cart
	 *
	 */
	function index() {
		
		// Load the "Cart" session variable
		$cart_contents = session('cart');
		
		// Export that to the view (/app/views/cart/index.php)
		$this->set('cart_contents', $cart_contents);
	}

	/**
	 * Displays the checkout form
	 *
	 */
	function checkout() {

	}
	
	/**
	 * Adds a product to the cart
	 * Please note that this function has no view. 
	 * It just adds the product to the session and redirects back to the Products list
	 */ 
	function add($product) {
		// load the cart
		$cart = session('cart');
		
		// append the new product to it
		$cart[] = $product;
		
		// save again
		session('cart', $cart);
		
		// back to the products
		redirect('/products');
		
	}

	/**
	 * Displays a message confirming the checkout
	 *
	 */
	function confirm() {
		// If no email was set, redirect to the cart contents
		if(!isset($this->data['form']['email'])) {
			redirect('/cart');
		}
		
		// on a real app we'd at least send an email to the user
		
		// clean up the cart
		session('cart', array());
	}
}
?>