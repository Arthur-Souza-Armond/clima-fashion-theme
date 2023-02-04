<?php
    function get_menu_header_unishop(  ){ 

        $nameMenu = 'header';
        
        global $wpdb;

        $taxonomies = $wpdb->get_results( "SELECT term_id FROM {$wpdb->prefix}term_taxonomy WHERE taxonomy = 'nav_menu'" );

        foreach( $taxonomies as $tax ){
            
            foreach( get_terms() as $term ){
                if( $term->term_id == $tax->term_id && $term->name == $nameMenu ){

                    $relationShip = $wpdb->get_results( "SELECT object_id FROM {$wpdb->prefix}term_relationships WHERE term_taxonomy_id = {$term->term_id}" );

                    foreach( $relationShip as $object ){
                        $menuItems[] = get_post_meta( $object->object_id );
                        /*if( get_post_meta( $object->object_id, '_menu_item_object' ) == 'page' ){
                            $menuItems[] = get_post_meta( $object->object_id );
                        }*/
                    }

                }                    
            }            

        }

        //$terms = [];

        //print_r( $terms );

        $html = 
        '
            <button id="menu-hamburguer">
                <i class="material-icons">menu</i>
            </button>
            <div id="menu-site">
                <script>console.log(' . json_encode( $menuItems ) . ')</script>
            </div>
        ';
        return $html;
    }
?>

<div class="header">
    <div id="header-contents">
        <div id="header-menu">
            <?php
                echo get_menu_header_unishop(  );
            ?>
        </div>
        <div id="logotipo">
            <?php
                if ( function_exists( 'the_custom_logo' ) ) {
                    if( get_custom_logo() == '' ){
                        echo get_option( 'blogname' );
                    }else{
                        the_custom_logo();
                    }
                }
            ?>
        </div>  
        <div id="function-buttons">  
            buttons          
        </div>
    </div>
</div>