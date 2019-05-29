<?php get_header(); ?>

<div class="container-fluid posts">
    <?php if ( have_posts() ) : query_posts(array('orderby' => 'date', 'order' => 'DESC', 'category_name' => 'series')); ?>
        <div class="row">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="col-md-6 col-sm-12 post-card">
                    <div class="row">
                        <div class="col-6 image">
                            <a href="<?php the_permalink(); ?>">
                                <img class="lazy" data-src="<?php echo get_image_by_post_id($post->id); ?>">
                            </a>    
                        </div>
                        <div class="col-6 text">
                            <a href="<?php the_permalink(); ?>">
                                <div class="card">
                                    <p class="title-post"><?php the_title(); ?></p>
                                    <small class="date-post"><?php the_time( 'j \d\e F \d\e Y' ); ?></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else : ?>

        <div class="info-no-posts">
            <h3>Não há posts para exibir</h3>
        </div>

    <?php endif; ?></div>

<?php get_footer(); ?>