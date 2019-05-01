<?php 

    //Função com a lógica de montagem do html pelo seu índice
    function montaHtml($dados){
        $html = "";
        $i = $dados["index"];

        if( $i == 1 || $i == 2 ) : //Exibe o conteúdo e uma div maior para o 1 e 2 post
            $html = '<a href="'.$dados["post_url"].'">
                <div class="'.$dados["class"].'" style="background: url('.$dados["img"].');">
                    <div class="efeito-imagem-degrade">
                    </div>
                    <div class="content-post-news">';
                    //Exibe o título somente para o primeiro
                    if( $i == 1 )
                        $html .= '<h1>'.$dados["title"].'</h1>';

                        $html .= '<p>'.$dados["excerpt"].'</p>
                        <p class="ver-mais">[ver mais]</p>
                    </div>
                </div>
            </a>';

        endif;

        if( $i == 3 ) : //Se for o terceiro post, abre a div pai e exibe seu conteúdo

            $html = '<div class="others-posts-news">
            <a href="'.$dados["post_url"].'">
                <div class="'.$dados["class"].'" style="background: url('.$dados["img"].');">
                    <div class="efeito-imagem-degrade">
                    </div>
                    <div class="content-post-news">
                        <p>'.$dados["excerpt"].'</p>
                        <p class="ver-mais">[ver mais]</p>
                    </div>
                </div>
            </a>';

        endif;

        if( $i == 4 || $i == 5 ) : //Se for o 4 ou 5 post só exibe a imagem
            $html = '<a href="'.$dados["post_url"].'">
                <div class="'.$dados["class"].'" style="background: url('.$dados["img"].');">
                    <div class="efeito-imagem-degrade">
                    </div>  
                </div>
            </a>';
        endif;

        return $html;
    }

    function be_ajax_load_more() {

        //Seta os filtros da busca
        $args = array(
            'posts_per_page' => 5,
            'category_name' => 'news',
            'post_type' => 'post',
            'paged' => esc_attr( $_POST['page'] )
        );

        header("Content-Type: text/html");

        $index = 0;
        //Faz a busca
        $loop = new WP_Query( $args );

        //Se não tiver posts envia erro
        if( !$loop->have_posts() ):
            wp_send_json_error();
            wp_die();
        endif;

        //Se tiver posts pega os dados do post e monta o html de retorno
        if( $loop->have_posts() ): 
            //Coloca margem antes de exibir os posts
            $data = '<div class="space"></div>';

            while( $loop->have_posts() ): 
                $index++; //Começa o index com 1 e incrementa a cada post
                $loop->the_post();
                $post_id = get_the_ID();

                //Monta os dados
                $dados = array(
                    'index'    => $index,
                    'class'    => "post-news-".$index, //Define a classe de cada post
                    'post_url' => get_permalink($post_id), //Pega o link do post
                    'img'      => get_the_post_thumbnail_url(), //Pega o link da imagem
                    'title'    => get_the_title(), //Pega o título do post
                    'excerpt'  => get_the_excerpt(), //Pega o excerto
                 );

                //Concatena para o retorno
                $data .= montaHtml($dados);

            endwhile; 

            //Se parou no 3º ou 4º post, não esquece de fechar a div
            if( $index == 3 || $index == 4 )
                $data .= '</div>';

        endif; 

        //Envia o sucesso com a html de retorna, reseta os dados do post e finaliza a função
        wp_send_json_success( $data );
        wp_reset_postdata();
        wp_die();
    }

    add_action( 'wp_ajax_be_ajax_load_more', 'be_ajax_load_more' );
    add_action( 'wp_ajax_nopriv_be_ajax_load_more', 'be_ajax_load_more' );

    /**
     * Javascript for Load More
     *
     */
    function be_load_more_js() {
        global $wp_query;
        $args = array(
            'url'   => admin_url( 'admin-ajax.php' )
        );
                
        wp_enqueue_script( 'be-load-more', get_stylesheet_directory_uri() . '/assets/js/load-more.js', array( 'jquery' ), '1.0', true );
        wp_localize_script( 'be-load-more', 'beloadmore', $args );
        
    }

    add_action( 'wp_enqueue_scripts', 'be_load_more_js' );
    
    add_theme_support( 'post-thumbnails' );

    add_action( 'init', 'sections_home' );
    function sections_home() {
        $tipoCPT = 'Seções da Home';
        $labels = array(
            'name' => _x( 'Seções da Home', $tipoCPT ),
            'singular_name' => _x( 'Seção', $tipoCPT ),
            'add_new' => _x( 'Adicionar Nova', $tipoCPT ),
            'add_new_item' => _x( 'Adicionar Seção', $tipoCPT ),
            'edit_item' => _x( 'Editar Seção', $tipoCPT ),
            'new_item' => _x( 'Nova Seção', $tipoCPT ),
            'view_item' => _x( 'Ver Seção', $tipoCPT ),
            'search_items' => _x( 'Localizar Seção', $tipoCPT ),
            'not_found' => _x( 'Nenhuma Seção encontrada', $tipoCPT ),
            'not_found_in_trash' => _x( 'Não há Seções na Lixeira', $tipoCPT ),
            'parent_item_colon' => _x( 'Pai Seção:', $tipoCPT ),
            'all_items' => _x( 'Todos as Seções', $tipoCPT   ),
            'menu_name' => _x( 'Seções da Home', $tipoCPT   ),
        );
        
        $args = array(
            'labels' => $labels,
            'supports' =>  array('title', 'editor', 'thumbnail'),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_icon' => 'dashicons-admin-home',
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true,
            'capability_type' => 'post'
        );
    register_post_type( 'sections', $args );
    }
     

    add_filter('manage_edit-sections_columns', 'sections_columns');
    function sections_columns($columns){
      $columns = array(
        'cb'    => '<input type="checkbox" />',
        'title' => 'Título',
        'editor' => 'Conteúdo',
        'imagem'=> __( 'Imagem', 'luna_lang' ),
        'date'  => __( 'Date', 'painta_lang' )
      );
      return $columns;
    }
     
    //Meta box com as cores
    add_action( 'add_meta_boxes', 'fields_meta_box_add' );
    function fields_meta_box_add() {
        add_meta_box('header-single-id', 'Header para a página do post news single', 'header_single_meta_box', 'post', 'normal', 'high' );
        add_meta_box('header-pages-id', 'Mídia do header', 'header_pages_meta_box', 'page', 'normal', 'high' );
        add_meta_box('fields-section-id', 'Personalizar cores e mídia', 'fields_section_meta_box', 'sections', 'normal', 'high');
    }
     
    //Definindo os campos das seções da home
    function __getFieldsHome(){
        return array(
            'type_media_home' => 
                array(
                    'type' => "select",
                    'label' => "Exibir preferencialmente",
                    'options' => 
                        array(
                            "Imagem" => 'I', 
                            "Vídeo" => 'V'
                        )
                ),
            'link_image_home' => 
                array(
                    'type' => "text",
                    'label' => "URL da imagem",
                ),
            'link_video_home' => 
                array(
                    'type' => "text",
                    'label' => "URL do vídeo",
                ),
            'color_font_title' => 
                array(
                    'type' => "color",
                    'label' => "Cor da fonte do título",
                ),
            'color_bg_title' => 
                array(
                    'type' => "color",
                    'label' => "Cor de fundo do título",
                ),
            'opacity_title' => 
                array(
                    'type' => "number",
                    'label' => "Nível de opacidade do título (%)",
                ),
            'color_font_content' => 
                array(
                    'type' => "color",
                    'label' => "Cor da fonte do conteúdo",
                ),
            'color_bg_content' => 
                array(
                    'type' => "color",
                    'label' => "Cor do fundo do conteúdo",
                ),
            'opacity_content' => 
                array(
                    'type' => "number",
                    'label' => "Nível de opacidade do conteúdo (%)",
                ),
        );
    }
     
    //Definindo os campos dos headers
    function __getFieldsHeader(){
        return array(
            'type_media_header' => 
                array(
                    'type' => "select",
                    'label' => "Exibir preferencialmente",
                    'options' => 
                        array(
                            "Imagem" => 'I', 
                            "Vídeo" => 'V'
                        )
                ),
            'link_image_header' => 
                array(
                    'type' => "text",
                    'label' => "URL da imagem",
                ),
            'link_video_header' => 
                array(
                    'type' => "text",
                    'label' => "URL do vídeo",
                ),
        );
    }

    function header_single_meta_box(){

        //Busca os valores da página se existir
        $valuesSingle = get_post_custom( $post->ID );
        $headerSingle = isset( $valuesSingle["header_single_meta_box"][0] ) ? esc_attr( $valuesSingle["header_single_meta_box"][0] ) : '';
        wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
        ?>

        <label for="header_single_meta_box">Link da Imagem</label>
        <input type="text" name="header_single_meta_box" id="header_single_meta_box" value="<?php echo $headerSingle; ?>" />
        <?php

    }

    function header_pages_meta_box(){

        //Busca os valores da página se existir
        $valuesHeader = get_post_custom( $post->ID );

        //Busca os campos
        $fieldsHeader = __getFieldsHeader(); 

        //Se o valor para o campo já existir exibe no value
        foreach ($fieldsHeader as $key => &$data) {
            $data['value'] = isset( $valuesHeader[$key][0] ) ? esc_attr( $valuesHeader[$key][0] ) : '';
        }

        unset($data);        
        wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');

        //Exibe os inputs
        foreach ($fieldsHeader as $key => $data) : ?>
            <?php if( $data['type'] == 'select' ) : //Exibe um select para escolher o tipo de mídia (Imagem ou Video) ?>
                <label for="<?= $key; ?>"><?= $data['label']; ?></label>
                <select name="<?= $key; ?>">
                    <?php foreach ($data['options'] as $lblOpt => $valOpt) : ?>
                        <option value="<?= $valOpt ?>" <?php echo ( $valOpt == $data['value'] ) ? "selected" : "" ?> ><?= $lblOpt; ?></option>
                    <?php endforeach; ?>
                </select>
                <br><br>
            <?php else : ?>
                <label for="<?= $key; ?>"><?= $data['label']; ?></label>
                <input type="<?= $data['type'] ?>" name="<?= $key; ?>" id="<?= $key; ?>" value="<?= $data['value']; ?>" />
                <br><br>
            <?php endif; ?>
        <?php endforeach;
    }

    function fields_section_meta_box(){

        //Busca os valores do post se existir
        $valuesHome = get_post_custom( $post->ID );

        //Busca os campos
        $fieldsHome = __getFieldsHome(); 

        //Se o valor para o campo já existir exibe no value
        foreach ($fieldsHome as $key => &$data) {
            $data['value'] = isset( $valuesHome[$key][0] ) ? esc_attr( $valuesHome[$key][0] ) : '';
        }

        unset($data);
        wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');

        //Exibe os inputs
        foreach ($fieldsHome as $key => $data) : ?>
            <?php if( $data['type'] == 'select' ) : //Exibe um select para escolher o tipo de mídia (Imagem ou Video) ?>
                <label for="<?= $key; ?>"><?= $data['label']; ?></label>
                <select name="<?= $key; ?>">
                    <?php foreach ($data['options'] as $lblOpt => $valOpt) : ?>
                        <option value="<?= $valOpt ?>" <?php echo ( $valOpt == $data['value'] ) ? "selected" : "" ?> ><?= $lblOpt; ?></option>
                    <?php endforeach; ?>
                </select>
                <br><br>
            <?php else : ?>
                <label for="<?= $key; ?>"><?= $data['label']; ?></label>
                <input type="<?= $data['type'] ?>" name="<?= $key; ?>" id="<?= $key; ?>" value="<?= $data['value']; ?>" />
                <br><br>
            <?php endif; ?>
        <?php endforeach;
    }

    add_action( 'save_post', 'fields_meta_box_save' );
    function fields_meta_box_save( $post_id ) {

        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
        if( !current_user_can( 'edit_post' ) ) return;

        //Percorre os campos da home para salvar seu valor se necessário
        foreach ( __getFieldsHome() as $key => $data ) {
            if( isset( $_POST[$key] ) )
                update_post_meta( $post_id, $key, $_POST[$key] );
        }

        //Percorre os campos do header para salvar seu valor se necessário
        foreach ( __getFieldsHeader() as $key => $data ) {
            if( isset( $_POST[$key] ) )
                update_post_meta( $post_id, $key, $_POST[$key] );
        }

        //Salva o header do single
        if( isset( $_POST["header_single_meta_box"] ) )
            update_post_meta( $post_id, "header_single_meta_box", $_POST["header_single_meta_box"] );
    }

 ?>