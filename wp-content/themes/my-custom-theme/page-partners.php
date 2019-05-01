<?php /* Template Name: CustomPagePartners */ ?>
<?php get_header(); ?>

    <?php
        // args
        $args = array( 'orderby' => 'date', 'order' => 'ASC', 'category_name' => 'parceiros' );

        // the query
        $the_query = new WP_Query( $args );
    ?>

    <?php
        //Verifica se o número de posts é par ou ímpar para determinar a forma de exibição
        $count_posts = $the_query->post_count;
        $class = (($count_posts % 2) == 0) ? "posts-parceiros-par" : "posts-parceiros-impar";
    ?>

    <?php if ( $the_query->have_posts() ) : ?>

        <div class="parceiros <?php echo $class; ?>">

            <!-- start of the loop -->
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

            <div class="post-parceiro">
                <div class="thumb-parceiro">
                    <?php if ( has_post_thumbnail() ) : ?>                            
                        <?php the_post_thumbnail(); ?> 
                        <div class="efeito-imagem-degrade">
                        </div>                       
                    <?php endif; ?>
                </div>
            
                <div class="conteudo-parceiro">
                    <div class="texto-conteudo-parceiro">
                        <h3><?php the_title(); ?></h3>
                        <?php the_content(); ?>                        
                    </div>
                </div>
            </div>

            <?php endwhile; ?><!-- end of the loop -->

        </div>

        <!-- put pagination functions here -->
        <?php wp_reset_postdata(); ?>


    <?php else : ?>

        <div class="info-no-posts">
            <h3>Não há posts para exibir</h3>
        </div>

    <?php endif; ?>

<?php get_footer(); ?>