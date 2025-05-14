$(document).ready(function(){
    validarInput();
    $('#cpf').mask('999.999.999-99');
    $('#prontuario').mask('999.99.999');
    $('#telefone').mask('(99) 99999-9999');
})




function validarInput(){  
    $('form input:not([type="submit"]),form textarea').focusout(function(){
        var el = $(this);
        var value = el.val();
        var required = el.attr("content");
        var max = el.attr("maxCaracter");
        var lengthStr = el.val().length;
        var re  = /\S+@\S+\.\S+/;
        
        if(value == "" && required == "required")
            errorInput(el,"Preencha o campo destacado")
        else if(lengthStr > max)
            errorInput(el,"O limite de caracteres neste campo é "+max);
        else  if(el.attr('id') == 'email' && !re.test(value))
            errorInput(el,"Formato de E-mail inválido");
        else  if(el.attr('id') == 'cpf' && !validarCPF(value))
            errorInput(el,"Formato de CPF inválido");
        else if(el.attr('id') == 'senha' && value.length < 6)
            errorInput(el,'A senha deve conter pelo menos 6 caracteres');
        else if(el.attr('id') == 'senha' && !/(?=.*[a-zA-Z])(?=.*[0-9])/.test(value))
            errorInput(el,'A senha deve conter letras e números');
        else if(el.attr('id') == 'confirmar_senha'){
            var senha = el.parent().parent().find('#senha');
            
            if(senha.val() != value){
                errorInput(senha,'')
                errorInput(el,"As senhas estão diferentes");
            }else{
                resetInput(senha)
                resetInput(el)
            }
            
        }else
            resetInput(el);
    })

    $('form').on('submit',function(){
        var form  = $(this);
        var input = form.find('input');
        var i=0;

        input.focusout()
        
        while (i < input.length) {    
            if($(input[i]).css('borderColor') == 'rgb(255, 0, 0)'){
                return false;
            }
            i++;
        }   
        
    })
    
    
}

function errorInput(el, msg){
    alertMessage(msg,"erro");
    el.css("borderColor","red");
    el.addClass('erro-input');

    if(el.attr('type') == "file"){
      el.parent().find('.file-btn').css("border-color","red");
      el.parent().find('.file-btn').css("backgroundColor","#a83131");
    }
}

function resetInput(el){
    el.css("borderColor","");
    el.removeClass('erro-input');
    if(el.attr('type') == "file"){
      el.parent().find('.file-btn').css("borderColor","");
      el.parent().find('.file-btn').css("backgroundColor","");
    }
}

function validarCPF(cpf) {
    // Remove caracteres não numéricos
    cpf = cpf.replace(/\D/g, '');

    // Verifica se o CPF tem 11 dígitos
    if (cpf.length !== 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais
    if (/^(\d)\1+$/.test(cpf)) {
        return false;
    }

    // Valida o primeiro dígito verificador
    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf[i]) * (10 - i);
    }
    let resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) {
        resto = 0;
    }
    if (resto !== parseInt(cpf[9])) {
        return false;
    }

    // Valida o segundo dígito verificador
    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf[i]) * (11 - i);
    }
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) {
        resto = 0;
    }
    if (resto !== parseInt(cpf[10])) {
        return false;
    }
    console.log("CPF válido");
    return true;
}
