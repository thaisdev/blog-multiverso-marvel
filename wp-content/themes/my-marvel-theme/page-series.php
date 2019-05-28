<?php get_header(); ?>

<div class="container-fluid posts">
    <?php if ( have_posts() ) : query_posts(array('orderby' => 'date', 'order' => 'DESC', 'category_name' => 'curiosidades')); ?>
        <div class="row">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="col-md-6 col-sm-12 post-card">
                    <a href="<?php the_permalink(); ?>">
                        <div class="card">
                            <p><?php the_title(); ?></p>
                            <small><?php the_time( 'j \d\e F \d\e Y' ); ?></small>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else : ?>

        <div class="info-no-posts">
            <h3>Não há posts para exibir</h3>
        </div>

    <?php endif; ?></div>

<?php get_footer(); ?>