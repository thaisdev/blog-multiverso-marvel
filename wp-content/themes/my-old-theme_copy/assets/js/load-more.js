
var page = 1;
var loading = false;
var scrollHandling = {
    allow: true,
    reallow: function() {
        scrollHandling.allow = true;
    },
    delay: 400 //(milliseconds) adjust to the highest acceptable value
};

$(window).scroll(function(){
    if( ! loading && scrollHandling.allow ) {
        scrollHandling.allow = false;
        setTimeout(scrollHandling.reallow, scrollHandling.delay);

         //Busca os valores
        var size   = $(window).scrollTop() + $(window).height();
        var height = $(document).height();

        //Se estiver perto do fim
        if( size >= (height-700) ) {
            var data = {
                action: 'be_ajax_load_more',
                page: page
            };

            //Faz a requisição passando o número da página
            $.post(beloadmore.url, data, function(res) {
                if( res.success) {
                    //Esconde a mensagem de que não há posts
                    $("#no-posts").hide();
                    
                    //Se veio posts exibe o html na página e incrementa a página
                    $('#all-posts').append( res.data );
                    page++;
                } else {
                    console.log(res);
                    //Mostra a mensagem de que não há posts
                    if(page == 1){
                        $("#no-posts").show();
                    }
                }
            }).fail(function(xhr, textStatus, e) {
                console.log(xhr.responseText);
            });

        }
    }
});