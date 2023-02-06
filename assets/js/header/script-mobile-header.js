
// Menu Header

control_menu_mobile(  );

function control_menu_mobile(  ){

    var menuContainer = document.querySelector( '#menu' );

    if( menuContainer.style.display == "none" ){
        menuContainer.style.display = 'block';
    }else{
        menuContainer.style.display = 'none';
    }

}

control_inital_menu( 0 );

const containerSubCategory  = document.querySelector( '.sub-categories' );

/**
 * Função para exibir sub categorias do pai
 * @param { int } id 
 */
function show_content_category_selected( id ){    

    control_inital_menu( 1 );

    set_parent_selected( id );

    let subCategorys = document.querySelectorAll( '.sub-categories div' );
    subCategorys.forEach( element => {
        element.style.display = "none";
    } )

    let selectedElementSub = document.querySelector( '.sub-categories #subcategories-'+id );
    selectedElementSub.style.display = "block";

}

const containerParentCategory = document.querySelectorAll( '.parent-categories span' );

/**
 * Função para mudar estilo do item clicado
 * @param { int } id 
 */
function set_parent_selected( id ){

    containerParentCategory.forEach( element => {
        if( element.id == 'parent-categories-'+id ){
            element.style.fontWeight    = "bold";
            element.style.borderColor   = "#000";  
            element.style.borderBottomWidth = '2px';
        }else{
            element.style.fontWeight = "500";
            element.style.borderColor   = "#ccc"; 
            element.style.borderBottomWidth = '1px';
        }
    } )

}

/**
 * Função para verificação de categoria pai selecionada
 * @param { int } param 
 */
function control_inital_menu( param ){

    var contentCategorys    = document.querySelector( '#menu #display-category #content' );
    var initalPics          = document.querySelector( '#menu #display-category #pictures-initial' );

    if( param == 0 ){
        contentCategorys.style.display  = "none";
        initalPics.style.display        = 'block';
    }else{
        //contentCategorys.style.display  = "block";
        initalPics.style.display        = 'none';
        unfade( contentCategorys );
    }    

}

/**
 * Função para criar visibilidade fade em elemento
 * @param { HTMLElement } element 
 */
function unfade(element) {
    var op = 0.1;  // initial opacity
    element.style.display = 'block';
    var timer = setInterval(function () {
        if (op >= 1){
            clearInterval(timer);
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op += op * 0.1;
    }, 10);    
}

// Pesquisa

control_display_search(  );

function control_display_search(  ){

    var searchContent = document.querySelector( '#container-search-header' );

    if( searchContent.style.display == "none" ){
        searchContent.style.display =  'block';
    }else{
        searchContent.style.display = 'none';
    }

}