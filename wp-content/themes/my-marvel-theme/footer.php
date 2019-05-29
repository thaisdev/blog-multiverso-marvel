    <?php wp_footer(); ?>
    <?php 
        $id = get_the_ID();
        $title = get_the_title(get_the_ID());
    ?>
    <div class="footer">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="http://localhost/wordpress/">MM</a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="<?= ($title == 'Filmes') ? 'active' : ''; ?> nav-item nav-link" href="http://localhost/wordpress/index.php/filmes/">
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
    </div>

    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.lazy.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/lazy-load.js"></script>

</body>
</html>