<?php get_header(); ?>
    <?php the_post(); ?>
    <div class="container-fluid single-body">
        <div class="card content">
            <h1><?php the_title(); ?></h1>
            <small><?php the_date(); ?></small>
            <?php the_content(); ?>
        </div>
    </div>
<?php get_footer(); ?>  