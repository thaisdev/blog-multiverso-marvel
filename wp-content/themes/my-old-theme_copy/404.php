<?php get_header(); ?>

    <div class="bg-error-404">

        <div class="logo-yo-header">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/logo@site_yo.png">
        </div>

        <div class="msg-error-404">
            <h1 class="title-error-404">
                Error 404
            </h1>

            <p>Ops! Algo está errado, esta página não existe,</p>

            <input class="btn-back-home" type="button" value="Volte para o início, Shark!" onclick="window.location.href= '<?php echo get_home_url(); ?>'">

        </div>
        
    </div>

<?php get_footer(); ?>    