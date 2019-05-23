<?php get_header(); ?>
    <?php the_post(); ?>
    <div class="container-fluid single-body">
        <div class="card content">
            <small><?php the_date(); ?></small>
            <?php the_content(); ?>
        </div>
    </div>
<?php get_footer(); ?>  