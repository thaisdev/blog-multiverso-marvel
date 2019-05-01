<?php /* Template Name: CustomPageMenu */ ?>

<?php get_header(); ?>

    <div class="background-page-menu">
        <div class="close-menu">
            <a href="<?php echo get_site_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/close-menu.png">
            </a>            
        </div>
        <div class="list-pages-menu">
            <div class="text-list-pages-menu">
                <?php wp_nav_menu(array('menu' => 'Menu do topo')); ?>                
            </div>
        </div>
        <div class="redes-sociais">
            <div class="rede-social-icon">
                <a href="https://www.facebook.com/yoagencia/">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/facebook-icon.png">                
                </a>
            </div>
            <div class="rede-social-icon">
                <a href="https://www.instagram.com/yoagenciadigital/">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/instagram-icon.png">
                </a>
            </div>   
            <div class="rede-social-icon">
                <a href="https://www.linkedin.com/company/11325813/">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/linkedin-icon.png">
                </a>
            </div>   
        </div>        
    </div> 