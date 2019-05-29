<?php
    function get_image_by_post_id($pid) { 
        $post = get_post( $pid );
        $content = $post->post_content;
        $regex = '/src="([^"]*)"/';
        preg_match_all( $regex, $content, $matches );
        if ($matches[1][0]) {
            return $matches[1][0];
        } else {
            return "http://localhost/wordpress/wp-content/uploads/2019/05/FB_IMG_1557960185115.jpg";
        }
    }

    add_theme_support( 'post-thumbnails' );

    add_action( 'init', 'posts_media' );
    function posts_media() {
        $tipoCPT = 'Posts com mídia';
        $labels = array(
            'name' => _x( 'Posts com mídia', $tipoCPT ),
            'singular_name' => _x( 'Post', $tipoCPT ),
            'add_new' => _x( 'Adicionar Novo', $tipoCPT ),
            'add_new_item' => _x( 'Adicionar Post', $tipoCPT ),
            'edit_item' => _x( 'Editar Post', $tipoCPT ),
            'new_item' => _x( 'Novo Post', $tipoCPT ),
            'view_item' => _x( 'Ver Post', $tipoCPT ),
            'search_items' => _x( 'Localizar Post', $tipoCPT ),
            'not_found' => _x( 'Nenhum Post encontrada', $tipoCPT ),
            'not_found_in_trash' => _x( 'Não há Posts na Lixeira', $tipoCPT ),
            'parent_item_colon' => _x( 'Pai Post:', $tipoCPT ),
            'all_items' => _x( 'Todos os Posts', $tipoCPT   ),
            'menu_name' => _x( 'Posts com mídia', $tipoCPT   ),
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
        'date'  => __( 'Data', 'painta_lang' )
      );
      return $columns;
    }

    //Meta box com as midias
    add_action( 'add_meta_boxes', 'fields_meta_box_add' );
    function fields_meta_box_add() {
        add_meta_box('header-single-id', 'Mídia do post', 'fields_meta_box', 'post', 'normal', 'high' );
    }

    //Definindo os campos dos posts com imagens/videos
    function __getMediaPost(){
        return array(
            'type_media' => 
                array(
                    'type' => "select",
                    'label' => "Tipo de mídia",
                    'options' => 
                        array(
                            "Imagem" => 'I', 
                            "Vídeo" => 'V'
                        )
                ),
            'link_media' => 
                array(
                    'type' => "text",
                    'label' => "URL da mídia",
                )
        );
    }

    function fields_meta_box(){

        //Busca os valores do post se existir
        $values = get_post_custom( $post->ID );

        //Busca os campos
        $fields = __getMediaPost(); 

        //Se o valor para o campo já existir exibe no value fields_meta_box
        foreach ($fields as $key => &$data) {
            $data['value'] = isset( $values[$key][0] ) ? esc_attr( $values[$key][0] ) : '';
        }

        unset($data);
        wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');

        //Exibe os inputs
        foreach ($fields as $key => $data) : ?>
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

        //Percorre os campos para salvar seu valor se necessário
        foreach ( __getMediaPost() as $key => $data ) {
            if( isset( $_POST[$key] ) )
                update_post_meta( $post_id, $key, $_POST[$key] );
        }
    }
?>