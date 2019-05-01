//Inicializando variáveis
var sections = []; //lista de seções existentes
var pageSelected = 0; //seção que está sendo exibida
var stopNavigate = false; //Caso precise parar a função
var direcao; //Identifica se está subindo ou descendo a página

//Seta o topo da página como o início
sections.push({
    offset: 0
})

//Percorre as seções para pegar sua distância do topo
/*$('.secao').each(function(index,item) {
    sections.push({
        offset: $(item).offset().top
    });
});*/

//Percorre as seções para pegar sua distância do topo
$('.secao').each(function(index,item) {
    sections.push({
        offset: $("#secao-1").offset().top * (index+1) + (index*94)
    });
});

//Alterna as seções com animação e indicando a página selecionada nas bolinhas
function setSection(page){
    $('body').animate({scrollTop: sections[page].offset}, 'swing');
    $(".page-index").removeClass("selected-page");
    $("#page-"+page).addClass("selected-page");
}

//Evento de rolagem pelo mouse
$('body').bind('mousewheel', function(e){
    //Verifica a direção de navegação e chama a função
    if(e.originalEvent.wheelDelta /120 > 0 && $(window).scrollTop() > 0)
        navigate('up');                   
    else if($(window).scrollTop() < sections[sections.length-1].offset)
        navigate('down');                

});

//Pelas teclas
$(document).on('keydown', function (e) {

    //Habilita a navegação
    stopNavigate = false;

    //Verifica qual é a tecla
    code = e.keyCode;

    //Se não estiver batendo no topo pode subir mais
    if($(window).scrollTop() > 0){

        //Se for a setinha pra cima, sobe uma seção
        if(code == 38)
            navigate('up');

        //Se for a tecla home, sobe para o início de tudo
        else if(code == 36)
            navigateByPage(0);
        
    }

    //Se não estiver exibindo a última seção pode descer mais
    if($(window).scrollTop() < sections[sections.length-1].offset){

        //Se for a setinha para baixo desce uma seção
        if(code == 40)
            navigate('down');

        //Se for a tecla end desce tudo
        else if(code == 35)
            navigateByPage(sections.length-1);

    }

});

//Função para o efeito de navegação recebe a direção
function navigate(direction){

    //Se estiver bloqueando a função, verifica se já pode voltar a navegar
    if(stopNavigate){
        //Verifica a direção para saber que tipo de condição deve usar
        if(direction == 'up'){
            //Se o scroll tiver ultrapassado o offset da página selecionada, volte a rolar
            if($(window).scrollTop() < sections[pageSelected].offset)
                stopNavigate = false;
        }

        else if(direction == 'down'){
            if($(window).scrollTop() > sections[pageSelected].offset)
                stopNavigate = false;
        }

    }
    //Deixa rolar :D
    else{

        if(pageSelected >= 0 && pageSelected < sections.length){

            //Se estiver subindo decrementa a página selecionada
            if(direction == 'up')
                pageSelected--;

            //Senão, incrementa a página selecionada
            else if(direction == 'down' && pageSelected < sections.length-1)
                pageSelected++;

            //Bloqueia a função para não pular mais de uma seção
            stopNavigate = true;

            //Muda a seção
            setSection(pageSelected);                   

        }

    }
}

//Seta uma seção pelo seu índice
function navigateByPage(pageVal){
    pageSelected = pageVal;
    setSection(pageVal);
}

$(window).scroll(function(){
    //Controla a exibição da paginação
    if( $(window).scrollTop() >= $(window).height()/2 && $(window).scrollTop() <= ( $(window).scrollTop() + $(".sections").height() )/2 ){
        $("#fixed-sections").show();
    }
    else{
        $("#fixed-sections").hide();
    }

}); 