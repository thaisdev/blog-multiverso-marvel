<?php get_header(); ?>

    <?php
        function get_images_highcompress_data() {
            $args = array(
                'post_type' => 'attachment',
                'post_mime_type' => 'image/jpeg,image/jpg,image/png',
                'post_status' => 'inherit',
                'posts_per_page' => -1,
                'orderby' => 'id',
                'order' => 'ASC'
            );
            // Get all the available thumbnail sizes
            $sizes = get_intermediate_image_sizes();
            // Query the attachments
            $query_images = new WP_Query( $args );
            $images = array();
            // Run a loop
            if ( $query_images->have_posts() ){
                while ($query_images->have_posts()){
                    $query_images->the_post();
                    $images[]["thumb"] = wp_get_attachment_image_src( get_the_ID(), "thumbnail")[0];
                }
                return $images;
            }
        }

        $lista = get_images_highcompress_data();
    ?>

    <div class="container-fuild wallpapers">
        <div class="row">
            <?php foreach($lista as $img) : ?>
                <div class="col-md-4 col-sm-12 text-center p-10">
                    <a href="<?=$img["thumb"]?>" download>
                    <img class="lazy" data-src="<?=$img["thumb"]?>" alt="">
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php get_footer(); ?>