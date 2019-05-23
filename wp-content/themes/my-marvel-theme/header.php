<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css">
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-3.4.1.min.js"></script>
    
    <?php wp_head(); ?>

</head>
<?php 
    $id = get_the_ID();
    $title = get_the_title(get_the_ID());
?>
<div class="header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="http://localhost/wordpress/">BlogMarvel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="<?= ($title == 'Filmes') ? 'active' : 'ragatanga'; ?> nav-item nav-link" href="http://localhost/wordpress/index.php/filmes/">
                    Filmes
                </a>
                <a class="<?= ($title == 'Séries') ? 'active' : ''; ?> nav-item nav-link" href="http://localhost/wordpress/index.php/series/">
                    Séries
                </a>
                <a class="<?= ($title == 'Notícias') ? 'active' : ''; ?> nav-item nav-link" href="http://localhost/wordpress/index.php/noticias/">
                    Notícias
                </a>
                <a class="<?= ($title == 'Curiosidades') ? 'active' : ''; ?> nav-item nav-link" href="http://localhost/wordpress/index.php/curiosidades/">
                    Curiosidades
                </a>
                <a class="<?= ($title == 'Banco de wallpapers') ? 'active' : ''; ?> nav-item nav-link" href="http://localhost/wordpress/index.php/banco-de-wallpapers/">
                    Banco de wallpapers
                </a>
            </div>
        </div>
    </nav>
    <div class="player">
        <div class="row">
            <div class="col-12 text-center">
                <iframe src="https://open.spotify.com/embed/album/1DFixLWuPkv3KT3TnV35m3" width="300" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
            </div>
        </div>
    </div>
</div>