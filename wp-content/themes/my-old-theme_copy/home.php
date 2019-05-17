<?php get_header(); ?>
        <?php 
            //Pega a quantidade de posts das seções da home
            $qtd = intval(wp_count_posts('sections')->publish);

            //Seta um contador para os posts
            $cont = 0;

            function isMobile() {
                return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
            }
        ?>     

        <div class="fixed-sections" style="display: none;" id="fixed-sections">
            <div class="lista" id="paginacao">
                <?php for ($i=1; $i <= $qtd; $i++) : ?>
                    <li id="page-<?=$i; ?>" class="page-index"></li>
                <?php endfor; ?>
            </div>

            <div class="redes-sociais-sections">
                <div class="rede-social-sections-icon">
                    <a href="https://www.facebook.com/yoagencia/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/facebook-icon.png">                
                    </a>
                </div>
                <div class="rede-social-sections-icon">
                    <a href="https://www.instagram.com/yoagenciadigital/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/instagram-icon.png">
                    </a>
                </div>   
                <div class="rede-social-sections-icon">
                    <a href="https://www.linkedin.com/company/11325813/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/linkedin-icon.png">
                    </a>
                </div>   
            </div>                        
        </div>

        <?php if ( have_posts() ) : query_posts(array('orderby' => 'date', 'order' => 'DESC', 'post_type' => 'sections')); ?>

            <div class="sections">
                
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php
                        //Incrementa o contador
                        $cont++;

                        //Inicializa o array dos metaboxes
                        $metaBoxes = array(
                            'type_media_home' => false, 
                            'link_image_home' => false,
                            'link_video_home' => false, 
                            'color_font_title' => false, 
                            'color_bg_title' => false, 
                            'opacity_title' => false, 
                            'color_font_content' => false, 
                            'color_bg_content' => false, 
                            'opacity_content' => false, 
                        );

                        //Pega os valores
                        foreach ($metaBoxes as $key => &$value) {
                            $value = get_post_meta($post->ID, $key, true);
                        }

                        //Converte a opacidade que estava em porcentagem para decimal
                        $metaBoxes['opacity_title'] /= 100; 
                        $metaBoxes['opacity_content'] /= 100; 

                        //Converte o hexadecimal para rgb e transforma em rgba com o nível opacidade
                        list($r, $g, $b) = sscanf($metaBoxes['color_bg_title'], "#%02x%02x%02x");
                        $metaBoxes['rgba_title'] = "rgba($r, $g, $b, ".$metaBoxes['opacity_title'].")";

                        list($r, $g, $b) = sscanf($metaBoxes['color_bg_content'], "#%02x%02x%02x");
                        $metaBoxes['rgba_content'] = "rgba($r, $g, $b, ".$metaBoxes['opacity_content'].")";
                    ?>

                    <div class="post-home secao" id="secao-<?=$cont; ?>">

                        <div class="conteudo-post-home" id="conteudo-post-home">
                        
                            <h1 style="<?php echo "color: ".$metaBoxes['color_font_title']."; background: ".$metaBoxes['rgba_title']; ?>"><?php the_title(); ?></h1>

                            <div class="content"  style="<?php echo "color: ".$metaBoxes['color_font_content']."; background: ".$metaBoxes['rgba_content']; ?>">
                                <?php the_content(); ?>
                            </div>
                        </div>

                        <div class="thumb-post-home" id="thumb-post-home">

                            <!--Exibe um vídeo ou uma imagem dependendo do tipo de mídia-->

                            <?php if ( $metaBoxes['type_media_home'] == 'V' && !isMobile() ) : ?>

                                <video width="100%" height="" autoplay loop >
                                    <source src="<?= $metaBoxes['link_video_home']; ?>" type="video/mp4">
                                </video>

                            <?php elseif ( $metaBoxes['type_media_home'] == 'I' || isMobile() ) : ?>

                                <div class="efeito-imagem-degrade">
                                </div>
                                <img class="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/grey.gif" data-original="<?=$metaBoxes['link_image_home'] ?>">

                            <?php endif; ?>
                        </div>
                                          
                    </div>

                <?php endwhile; ?>
            </div>


        <?php else : ?>

            <div class="info-no-posts">
                <h3>Não há posts para exibir</h3>
            </div>

        <?php endif; ?>

<?php get_footer(); ?>
