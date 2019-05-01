<?php /* Template Name: CustomPageTeam */ ?>

<?php get_header(); ?>

<?php
    // example args
    $args = array( 'orderby' => 'date', 'order' => 'ASC', 'category_name' => 'equipe' );

    // the query
    $the_query = new WP_Query( $args );
?>

<?php if ( $the_query->have_posts() ) : ?>

    <div class="equipe">

        <!-- start of the loop -->
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="membro-equipe">
                <div class="thumb-membro-equipe">
                    <?php if ( has_post_thumbnail() ) : ?>                            
                        <?php the_post_thumbnail(); ?>                        
                    <?php endif; ?>
                </div>
                <div class="efeito-imagem"></div>
                <div class="nome-cargo-membro">
                    <h3><?php the_title(); ?></h3>
                    <?php the_content(); ?>
                </div>                    
            </div>
        <?php endwhile; ?><!-- end of the loop -->

        <!-- put pagination functions here -->
        <?php wp_reset_postdata(); ?>
        
    </div>


    <?php else : ?>

        <div class="info-no-posts">
            <h3>Não há posts para exibir</h3>
        </div>

<?php endif; ?>

<?php get_footer(); ?>