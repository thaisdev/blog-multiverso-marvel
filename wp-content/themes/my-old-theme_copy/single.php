<?php get_header(); ?>
    <?php the_post(); ?>
    <div class="single-body">
        <small><?php the_date(); ?></small>
        <div class="content">
            <?php the_content(); ?>
        </div>
    </div>
<?php get_footer(); ?>  