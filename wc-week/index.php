<?php
/**
 * Plugin Name: WooCommerce Weekly Products
 * Description: Schedule WooCommerce Weekly Products
 * Plugin URI: https://vicodemedia.com
 * Author: Victor Rusu
 * Version: 0.0.1
**/

//* Don't access this file directly
defined( 'ABSPATH' ) or die();

// remove quantity from all products
add_filter( 'woocommerce_is_sold_individually', 'wc_remove_all_quantity_fields', 10, 2 );
function wc_remove_all_quantity_fields( $return, $product ) 
{
    return( true );
}

// remove sidebar from product page
function vicode_remove_sidebar( $is_active_sidebar, $index ) {              
    if( $index !== "sidebar-1" ) {
        return $is_active_sidebar;
    }
    if( ! is_product() ) {
        return $is_active_sidebar;
    }
    return false;
}
add_filter( 'is_active_sidebar', 'vicode_remove_sidebar', 10, 2 );

// display react app on grouped products only
add_filter( 'woocommerce_single_product_summary', 'vicode_filter_grouped_cart');  
function vicode_filter_grouped_cart(){
    global $post;
    if( function_exists('get_product') ){
        $product = get_product( $post->ID );
        if( $product->is_type( 'grouped' ) ){
            add_action('woocommerce_after_single_product_summary', 'vicode_react_app');
        }
    }
}

function vicode_react_app() {
    global $post;
    $assetsMediaURL = trim(str_replace('http://localhost/','',plugin_dir_url( __FILE__ )));
    echo '
    <style>
        .related,.woocommerce-product-gallery,.entry-summary,.woocommerce-tabs{
            display:none!important;
        }
    </style>
    <link href="'.plugin_dir_url( __FILE__ ) .'/static/css/2.c8940395.chunk.css" rel="stylesheet" />
    <link href="'.plugin_dir_url( __FILE__ ) .'/static/css/main.6dea0f05.chunk.css" rel="stylesheet" />
    <noscript>You need to enable JavaScript to run this app.</noscript>
        <div id="root"></div>
        <script>
            var assetsMediaURL = "'.$assetsMediaURL.'";
            var productParentId = '.$post->ID.';
            !(function (e) {
                function r(r) {
                    for (var n, u, i = r[0], c = r[1], l = r[2], p = 0, s = []; p < i.length; p++) (u = i[p]), Object.prototype.hasOwnProperty.call(o, u) && o[u] && s.push(o[u][0]), (o[u] = 0);
                    for (n in c) Object.prototype.hasOwnProperty.call(c, n) && (e[n] = c[n]);
                    for (f && f(r); s.length; ) s.shift()();
                    return a.push.apply(a, l || []), t();
                }
                function t() {
                    for (var e, r = 0; r < a.length; r++) {
                        for (var t = a[r], n = !0, i = 1; i < t.length; i++) {
                            var c = t[i];
                            0 !== o[c] && (n = !1);
                        }
                        n && (a.splice(r--, 1), (e = u((u.s = t[0]))));
                    }
                    return e;
                }
                var n = {},
                    o = { 1: 0 },
                    a = [];
                function u(r) {
                    if (n[r]) return n[r].exports;
                    var t = (n[r] = { i: r, l: !1, exports: {} });
                    return e[r].call(t.exports, t, t.exports, u), (t.l = !0), t.exports;
                }
                (u.e = function (e) {
                    var r = [],
                        t = o[e];
                    if (0 !== t)
                        if (t) r.push(t[2]);
                        else {
                            var n = new Promise(function (r, n) {
                                t = o[e] = [r, n];
                            });
                            r.push((t[2] = n));
                            var a,
                                i = document.createElement("script");
                            (i.charset = "utf-8"),
                                (i.timeout = 120),
                                u.nc && i.setAttribute("nonce", u.nc),
                                (i.src = (function (e) {
                                    return u.p + "static/js/" + ({}[e] || e) + "." + { 3: "2a8833cf" }[e] + ".chunk.js";
                                })(e));
                            var c = new Error();
                            a = function (r) {
                                (i.onerror = i.onload = null), clearTimeout(l);
                                var t = o[e];
                                if (0 !== t) {
                                    if (t) {
                                        var n = r && ("load" === r.type ? "missing" : r.type),
                                            a = r && r.target && r.target.src;
                                        (c.message = "Loading chunk " + e + " failed.\n(" + n + ": " + a + ")"), (c.name = "ChunkLoadError"), (c.type = n), (c.request = a), t[1](c);
                                    }
                                    o[e] = void 0;
                                }
                            };
                            var l = setTimeout(function () {
                                a({ type: "timeout", target: i });
                            }, 12e4);
                            (i.onerror = i.onload = a), document.head.appendChild(i);
                        }
                    return Promise.all(r);
                }),
                    (u.m = e),
                    (u.c = n),
                    (u.d = function (e, r, t) {
                        u.o(e, r) || Object.defineProperty(e, r, { enumerable: !0, get: t });
                    }),
                    (u.r = function (e) {
                        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(e, "__esModule", { value: !0 });
                    }),
                    (u.t = function (e, r) {
                        if ((1 & r && (e = u(e)), 8 & r)) return e;
                        if (4 & r && "object" == typeof e && e && e.__esModule) return e;
                        var t = Object.create(null);
                        if ((u.r(t), Object.defineProperty(t, "default", { enumerable: !0, value: e }), 2 & r && "string" != typeof e))
                            for (var n in e)
                                u.d(
                                    t,
                                    n,
                                    function (r) {
                                        return e[r];
                                    }.bind(null, n)
                                );
                        return t;
                    }),
                    (u.n = function (e) {
                        var r =
                            e && e.__esModule
                                ? function () {
                                    return e.default;
                                }
                                : function () {
                                    return e;
                                };
                        return u.d(r, "a", r), r;
                    }),
                    (u.o = function (e, r) {
                        return Object.prototype.hasOwnProperty.call(e, r);
                    }),
                    (u.p = "/"),
                    (u.oe = function (e) {
                        throw (console.error(e), e);
                    });
                var i = (this["webpackJsonpdrag-and-drop-react"] = this["webpackJsonpdrag-and-drop-react"] || []),
                    c = i.push.bind(i);
                (i.push = r), (i = i.slice());
                for (var l = 0; l < i.length; l++) r(i[l]);
                var f = c;
                t();
            })([]);
        </script>
        <script src="'.plugin_dir_url( __FILE__ ) .'/static/js/2.ab43b664.chunk.js"></script>
        <script src="'.plugin_dir_url( __FILE__ ) .'/static/js/main.ba8c8c2d.chunk.js"></script>
    ';
}




function vicode_add_multiple_products_to_cart( $url = false ) {
	// Make sure WC is installed, and add-to-cart qauery arg exists, and contains at least one comma.
	if ( ! class_exists( 'WC_Form_Handler' ) || empty( $_REQUEST['add-to-cart'] ) || false === strpos( $_REQUEST['add-to-cart'], ',' ) ) {
		return;
	}

	// Remove WooCommerce's hook, as it's useless (doesn't handle multiple products).
	remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

	$product_ids = explode( ',', $_REQUEST['add-to-cart'] );
	$count       = count( $product_ids );
    $number      = 0;



	foreach ( $product_ids as $id_and_quantity ) {
		// Check for days defined in curie notation (<product_id>:<product_day>)
        $id_and_quantity = explode( ':', $id_and_quantity );
        $product_id = $id_and_quantity[0];

        $adding_to_cart    = wc_get_product( $product_id );

		$_REQUEST['quantity'] = ! empty( $id_and_quantity[1] ) ? absint( $id_and_quantity[1] ) : 1;

		if ( ++$number === $count ) {
            
			// Ok, final item, let's send it back to woocommerce's add_to_cart_action method for handling.
            $_REQUEST['add-to-cart'] = $product_id;

            // saving weekday in the database
            $adding_to_cart->update_meta_data( 'weekday', sanitize_text_field( $id_and_quantity[1] ) );
            $adding_to_cart->save();

            $weekday = $adding_to_cart->get_meta( 'weekday' );
            $_SESSION['weekday'] = $weekday;

            return WC_Form_Handler::add_to_cart_action( $url );
        }

		$product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $product_id ) );
		$was_added_to_cart = false;
        

        // saving weekday in the database
        $adding_to_cart->update_meta_data( 'weekday', sanitize_text_field( $id_and_quantity[1] ) );
        $adding_to_cart->save();

        $weekday = $adding_to_cart->get_meta( 'weekday' );
        $_SESSION['weekday'] = $weekday;

        // Add the item data
        add_filter( 'woocommerce_add_cart_item_data', 'insert_cartt', 10, 4 );

		if ( ! $adding_to_cart ) {
			continue;
		}

        $add_to_cart_handler = apply_filters( 'woocommerce_add_to_cart_handler', $adding_to_cart->get_type(), $adding_to_cart );

		// grouped product handling
		woo_hack_invoke_private_method( 'WC_Form_Handler', 'add_to_cart_handler_simple', $product_id );
		
    }
    
}

// Fire before the WC_Form_Handler::add_to_cart_action callback.
add_action( 'wp_loaded', 'vicode_add_multiple_products_to_cart', 15 );


/**
 * Invoke class private method
 *
 * @since   0.1.0
 *
 * @param   string $class_name
 * @param   string $methodName
 *
 * @return  mixed
 */
function woo_hack_invoke_private_method( $class_name, $methodName ) {
	if ( version_compare( phpversion(), '5.3', '<' ) ) {
		throw new Exception( 'PHP version does not support ReflectionClass::setAccessible()', __LINE__ );
	}

	$args = func_get_args();
	unset( $args[0], $args[1] );
	$reflection = new ReflectionClass( $class_name );
	$method = $reflection->getMethod( $methodName );
	$method->setAccessible( true );

	$args = array_merge( array( $reflection ), $args );
	return call_user_func_array( array( $method, 'invoke' ), $args );
}

function insert_cartt($cart_item_data, $product_id, $variation_id, $weekday){

    $cart_item_data['weekday'] =  $_SESSION['weekday'];

    return $cart_item_data;
    
}


// display weekday on the cart page
function vicode_field_to_cart( $item_data, $cart_item_data ) {

        $item_data[] = array(
            'key' => __( 'Day', 'vicode-media' ),
            'value' => wc_clean( $cart_item_data['weekday'] )
        );
    return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'vicode_field_to_cart', 10, 2 );





