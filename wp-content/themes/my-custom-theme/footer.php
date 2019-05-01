
    <?php wp_footer(); ?>

    <?php 
        //Pega o link da página news
        $news_id = get_page_by_title('news')->ID; 
        $link = get_page_link($news_id);
    ?>

    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js"></script>

    <?php wp_reset_query();
    if( is_home() ) : ?>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/sections-navigate.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.lazyload.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/lazyload.js"></script>
    <?php endif; ?>

    <?php if( is_page('news') ) : ?>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/load-more.js"></script>
    <?php endif; ?>

    <?php if( !is_404() ) : ?>

        <?php if( is_home() || is_page('news') || is_single() ) : ?>

            <?php if( !is_page('news') ) : ?>
                <div class="title-news-home">
                    <a href="<?=$link ?>"><h1>news</h1></a>
                </div>
            <?php endif; ?>

            <?php echo do_shortcode('[carousel-horizontal-posts-content-slider]'); ?>

        <?php endif; ?>

        <div class="footer">
            <div class="top-footer">
                <div class="logo-yo-footer">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/logo_yo_negativo.png">
                </div>
                <div class="list-pages-footer">
                    <?php wp_nav_menu(array('menu' => 'Menu do topo')); ?>
                </div>
            </div>
            <div class="bottom-footer">
                <div class="direitos-reservados">
                    <small>&copy; Copyright 2018 yoagencia.digital - All Rights Reserved</small>
                </div>
            </div>
        </div>

    <?php endif; ?>

</body>
</html>