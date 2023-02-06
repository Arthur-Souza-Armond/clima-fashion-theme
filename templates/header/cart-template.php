<?php
    function get_cart_content(  ){

        $cart = WC()->cart->get_cart();
        return '<script>console.log( '. json_encode( $cart ) .' )</script>';

    }
?>

<div id="cart-content">
    <?php
        echo get_cart_content(  );
    ?>
</div>