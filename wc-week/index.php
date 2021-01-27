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

//* Register activation hook to add Blog Manager role
// register_activation_hook( __FILE__ , 'vm_activation' );

//* Register deactivation hook to remove Blog Manager role
// register_deactivation_hook( __FILE__ , 'vm_deactivation' );

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
        <script src="'.plugin_dir_url( __FILE__ ) .'/static/js/main.dd5960a9.chunk.js"></script>
    ';
}