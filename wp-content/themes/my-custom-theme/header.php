<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php wp_title(); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-3.2.1.min.js"></script>
    
    <?php wp_head(); ?>

</head>
<body>

    <?php 

        function __isMobile() {
            return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
        }

        //Inicializa o array dos metaboxes
        $dados = array(
            'type_media_header' => false, 
            'link_image_header' => false,
            'link_video_header' => false, 
        );

        //Se for post individual pega a thumb como imagem ou a cadastrada para o header
        if(is_single()){
            $dados['link_image_header'] = ( get_post_meta($post->ID, "header_single_meta_box", true) ) ? get_post_meta($post->ID, "header_single_meta_box", true) : get_the_post_thumbnail_url();
            $dados['type_media_header'] = 'I';
        }

        //Se for a home pega a imagem padrão (por enquanto)
        else if(is_home()){
            $dados['link_image_header'] = get_template_directory_uri()."/assets/images/bg-header-home.jpeg";
            $dados['type_media_header'] = 'I';
        }

        //Se for página pega os dados do metabox
        else if(!is_404()){
            //Pega os valores
            foreach ($dados as $key => &$value) {
                $value = get_post_meta($post->ID, $key, true);
            }        
        }

        //Definindo o título
        if(is_single())
            $dados['title'] = get_the_title(get_the_ID());
        else if(is_home())
            $dados['title'] = "Get Ready For The New!";

        else if(is_page('equipe'))
            $dados['title'] = "Nossa Equipe";

        else
            $dados['title'] = get_the_title();

        //Validando e formatando o título
        $valid = preg_replace('/\s+/', ' ', $dados['title']); //Removendo excesso de espaços
        $valid = trim($valid); //Removendo espaço antes e depois da string
        $dados['title'] = str_replace(' ', '<br>', $valid); //Trocando espaço por quebra de linha]
     ?>

    <?php if( !is_404() ) : ?>

        <!--Exibe o header com imagem de background caso o tipo de mídia seja imagem-->
        <div class="header" id="header"
            style="<?php echo ( $dados['type_media_header'] == 'I' || __isMobile() ) ? 
                    "background: url('".$dados['link_image_header']."');
                    background-repeat: no-repeat;
                    background-size: cover;" : ""; ?>" >

            <!--Exibe um player de vídeo caso seja vídeo-->
            <?php if( $dados['type_media_header'] == 'V' && !__isMobile() ) : ?>
                <video width="100%" height="100%" autoplay loop >
                    <source src="<?php echo $dados['link_image_header']; ?>" type="video/mp4">
                </video>

            <!--Ou um efeito sobre a imagem-->
            <?php elseif( $dados['type_media_header'] == 'I' || __isMobile() ) :  ?>

                <div class="efeito-imagem-degrade">
                </div>

            <?php endif; ?>

            <div class="logo-yo-header">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/logo@site_yo.png">
            </div>

            <div class="menu-button-header" id="open-menu-button">
                <button onclick="showMenu()">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/menu-button-header.png">
                </button>            
            </div>
        <div class="title-header <?php echo ( is_single() ) ? "title-header-single" : ""; ?>">
            <h1><?php echo $dados['title']; ?></h1>
        </div>

    <?php endif; ?>

        <?php if( !is_home() && !is_404() && !is_single() ) : ?>

            <div class="redes-sociais">
                <div class="rede-social-icon">
                    <a href="https://www.facebook.com/yoagencia/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/facebook-icon.png">                
                    </a>
                </div>
                <div class="rede-social-icon">
                    <a href="https://www.instagram.com/yoagenciadigital/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/instagram-icon.png">
                    </a>
                </div>   
                <div class="rede-social-icon">
                    <a href="https://www.linkedin.com/company/11325813/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/linkedin-icon.png">
                    </a>
                </div>   
            </div>

        <?php endif; ?>

    </div>

    <div class="background-page-menu" id="menu" style="display: none;">
        <div class="close-menu">
            <button onclick="hideMenu()">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/close-menu.png">
            </button>            
        </div>
        <div class="list-pages-menu">
            <div class="text-list-pages-menu">
                <?php wp_nav_menu(array('menu' => 'Menu do topo')); ?>                
            </div>
        </div>
        <div class="redes-sociais">
            <div class="rede-social-icon">
                <a href="https://www.facebook.com/yoagencia/">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/facebook-icon.png">                
                </a>
            </div>
            <div class="rede-social-icon">
                <a href="https://www.instagram.com/yoagenciadigital/">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/instagram-icon.png">
                </a>
            </div>   
            <div class="rede-social-icon">
                <a href="https://www.linkedin.com/company/11325813/">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/linkedin-icon.png">
                </a>
            </div>   
        </div>        
    </div> 