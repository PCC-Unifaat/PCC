$('.btn-add-horario').click(function(){
    var btn = $(this);
    var form = $('#form-add-horario')
    form.slideToggle();
    btn.find('i').toggleClass('fa-plus')
    btn.find('i').toggleClass('fa-minus')
})

$('#dados-paciente .btn-atualizar-dados').click(function(){
    //Ativar formulário
    let form = $('#dados-paciente');
    let input = form.find('input');
    let inputFoto = form.find('.trocar-foto');
    let formEnderecoContainer = form.find('.form-endereco-container');
    let iniEnderecoContaienr = form.find('.mostrar-endereco-container');

    form.toggleClass('leitura');
    form.toggleClass('update');


    iniEnderecoContaienr.fadeOut();
    formEnderecoContainer.css("display", "flex").hide().slideDown();
    inputFoto.stop().slideDown();

    $('.btn-fechar-form span').fadeIn();
    
    input.attr('disabled', false);
    input[0].focus();
    
    
})

$('.btn-fechar-form span').click(function(){
    // Desativar formulário
    let form = $('#dados-paciente');
    let input = form.find('input');
    let inputFoto = form.find('.trocar-foto');
    let formEnderecoContainer = form.find('.form-endereco-container');
    let iniEnderecoContaienr = form.find('.mostrar-endereco-container');

    form.toggleClass('leitura');
    form.toggleClass('update');

    formEnderecoContainer.css("display", "flex").slideUp();
    iniEnderecoContaienr.stop().fadeIn();
    inputFoto.stop().slideUp();

    input.attr('disabled', true);

    $(this).fadeOut()
})