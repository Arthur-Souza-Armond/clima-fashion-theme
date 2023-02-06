<?php

    /**
     * Função para recuperar todas as categorias do sistema e organizar em htmlElements
     */
    function get_all_categories(  ){

        $content = '';

        $taxonomy     = 'product_cat';
        $orderby      = 'name';  
        $show_count   = 0;      // 1 for yes, 0 for no
        $pad_counts   = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no  
        $title        = '';  
        $empty        = 0;

        $args = array(
                'taxonomy'     => $taxonomy,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
        );
        $all_categories = get_categories( $args );
        foreach ($all_categories as $cat) {
            if($cat->category_parent == 0) {
                $category_id = $cat->term_id;       
                
                $parentCategories[ $category_id ] = $cat;

                $args2 = array(
                        'taxonomy'     => $taxonomy,
                        'child_of'     => 0,
                        'parent'       => $category_id,
                        'orderby'      => $orderby,
                        'show_count'   => $show_count,
                        'pad_counts'   => $pad_counts,
                        'hierarchical' => $hierarchical,
                        'title_li'     => $title,
                        'hide_empty'   => $empty
                );
                $sub_cats = get_categories( $args2 );
                if($sub_cats) {
                    foreach($sub_cats as $sub_category) {
                        if( !( $sub_category->parent == 'sem-categoria' ) ){
                            $subCategories[ $category_id ][] = $sub_category;
                        }                            
                    }   
                }
            }      
        }

        $allContent = '<div id="all-content-menu">';

        $parentCategoriesContainer = '<div class="parent-categories">';
        foreach( $parentCategories as $category ){
            if( ! ( $category->category_nicename == 'sem-categoria') ){
                $parentCategoriesContainer .= '<span id="parent-categories-' . $category->cat_ID . '" onclick="show_content_category_selected( ' . $category->cat_ID .' )">' . $category->cat_name . '</span>';
            }
        }
        $parentCategoriesContainer .= '</div>';

        $subCatetegorieContainer = '<div class="sub-categories">';

        foreach( $subCategories as $sub ){
            $subCatetegorieContainer .= '<div id="subcategories-' . $sub[0]->parent . '">';
            foreach( $sub as $s ){
                $subCatetegorieContainer .= '<p><a href="' . get_term_link( $s->slug, 'product_cat' ) . '">' . $s->name . '</a><i class="material-icons">arrow_forward_ios</i></p>';
            }  
            $subCatetegorieContainer .= '</div>';          
        }

        $subCatetegorieContainer .= '</div>';

        $allContent .= $parentCategoriesContainer;
        $allContent .= $subCatetegorieContainer;
        $allContent .= '</div>';

        return $allContent;
    }

    /**
     * Função para recuperar as categorias pai
     *  @return string $content
     */
    function get_initial_pics(  ){

        $taxonomy     = 'product_cat';
        $orderby      = 'name';  
        $show_count   = 0;      // 1 for yes, 0 for no
        $pad_counts   = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no  
        $title        = '';  
        $empty        = 0;

        $args = array(
                'taxonomy'     => $taxonomy,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
        );

        $all_categories = get_categories( $args );

        $content = '';

        foreach ($all_categories as $cat) {
            if($cat->category_parent == 0 && !( $cat->category_nicename == 'sem-categoria' ) ) {
                $content .= 
                '<a onclick="show_content_category_selected( ' . $cat->term_id . ' )">' . $cat->name    . '</a>';
            }
        }

        return $content;

    }

    function get_login_content(  ){

        if( is_user_logged_in() ){

            $current_user = wp_get_current_user();
            return 
            '
                <div id="options-user-logged">
                    <div>
                        Pedidos
                    </div>
                    <div>
                        Endereços
                    </div>
                    <div>
                        Sair
                    </div>
                </div>
            ';

        }else{
            return 
            '
                <p>            
                    <button onclick="window.location = '. "'" . get_permalink( get_option('woocommerce_myaccount_page_id') ) . "'" . '" class="button-login-menu" id="acessar-conta-button">
                        Acessar minha conta
                    </button>
                    <button onclick="window.location = '. "'" . get_permalink( get_option('woocommerce_myaccount_page_id') ) . "'" . '" class="button-login-menu" id="criar-nova-conta">
                        Criar conta
                    </button>
                </p> 
            ';
        }

    }

?>

<div id="menu">
    <div id="header-menu">
        <img alt="icon-site" src="<?php echo get_site_icon_url() ?>">
        <button onclick="control_menu_mobile(  )">
            <i class="material-icons">
                close
            </i>
        </button>
    </div>
    <div id="display-category">
        <div id="pictures-initial">
            <?php
                echo get_initial_pics(  );
            ?>
        </div>
        <div id="content">            
            <?php
                echo get_all_categories();
            ?>
        </div>        
    </div>
    <div id="login-content">
        <span>Minha conta</span>
        <?php
            echo get_login_content(  );
        ?>                     
    </div>
    <div id="unishop-publicy">
        <p>Quer ter um site parecido com este?</p>
        <a href="https://www.unishopbrasil.com/home/"><img alt="Unishop Brasil - Seu site online, hoje" src="<?php echo get_theme_file_uri() . '/assets/unishop-logo.png' ?>"></a>
    </div>
</div>