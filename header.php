<div class="header">
    <div style="height:3px;background-color:#252525;"></div>
    <div id="header-contents">
        <div id="header-menu">
            <button onclick="control_menu_mobile()" id="btn-show-menu" class="btn-header">
                <i class="material-icons">menu</i>
            </button>
            <button onclick="control_display_search(  )" class="btn-header">
                <i class="material-icons">
                    search
                </i>
            </button>
            <?php
                require( 'templates/header/menu-template.php' );
            ?>
            <?php
                require( 'templates/header/search-template.php' );
            ?>
        </div>
        <div id="logotipo">
            <?php
                if ( function_exists( 'the_custom_logo' ) ) {
                    if( get_custom_logo() == '' ){
                        echo get_option( 'blogname' );
                    }else{
                        echo get_custom_logo();
                    }
                }
            ?>
        </div>  
        <div id="function-buttons">  
            <button onclick="console.log( 'carrinho' )">
                <i class="material-icons">
                    local_mall
                </i>
            </button>
            <?php require( 'templates/header/cart-template.php' ) ?>     
        </div>
    </div>
</div>