/**
 * showMenu
 *
 * Exibe o menu no header
 *
 * @author Thaís Oliveira
 * @since  01/2018
 */
function showMenu(){
    $("#header").hide();
    $("#menu").show();
    $("#open-menu-button").hide();
}

/**
 * hideMenu
 *
 * Esconde o menu
 *
 * @author Thaís Oliveira
 * @since  01/2018
 */
function hideMenu(){
    $("#header").show();
    $("#menu").hide();  
    $("#open-menu-button").show(); 
}