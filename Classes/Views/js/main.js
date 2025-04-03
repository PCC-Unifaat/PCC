if($('.box-alert').is(':visible')){
    setTimeout(function(){
        $('.box-alert').fadeOut();
    },5000)
}

$('.confirmar-acao').click(function(){
    let url = $(this).attr('url');
    let btn = $(this).attr('btn');
    let msg = $(this).attr('msg');

    confirmarAcao(url, btn, msg)
})

function alertMessage(mensagem, tipo){
    $('body').before('<div class="box-alert '+tipo+'"><i class="fas fa-check-circle"></i> '+mensagem+'</div>');

    setTimeout(function(){
        $('.box-alert').fadeOut();
    },5000)
}

function confirmarAcao(url, btn, mensagem = ''){
    $('body').append(
        '<div class="confirma-acao">'+
            '<div class="confirma-acao-container">'+
                '<h4><i class="fa-solid fa-triangle-exclamation"></i></h4>'+
                '<h2>Certeza que deseja continuar?</h2>'+
                '<p class="mensagem">'+mensagem+'</p>'+
                '<div class="btn-confirma">'+
                    '<span>Cancelar</span>'+
                    '<a href="'+url+'">'+btn+'</a>'+
                '</div>'+
            '</div>'+
        '</div>'
    );

    $('.btn-confirma > span').on('click',function(){
        $('.confirma-acao').fadeOut()
    })
}