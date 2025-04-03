$(document).ready(function(){
    validarInput();

    $('#familia').mask('999.99.999');

    $('#area_micro').mask('999.99');

    $('#cep').mask('99999-999');

    $('#buscar-cep').click(function(){
        var cep = $(this).parent().parent().find('#cep').val();
        cep = cep.replace(/-/,'')
        
        buscarCep(cep);

    })

    $('form input[type="file"]').change(function(){
        var el = $(this);
        var fileName = el[0].files[0]['name'];
        var span = el.parent().find('span');
    
        console.log(el[0].files[0])
        if(fileName)
          span.html(fileName);
    })
})

function buscarCep(cep){
    var loading = $("#loading");

    loading.show();
    $.ajax({
        url: `https://viacep.com.br/ws/${cep}/json/`,
        type: "GET",
        dataType: "json",
        success: function (data) {

            if(data.erro !== undefined){
                alertMessage("CEP inválido ou não encontrado",'erro');
            }else{
               $('#rua').val(data['logradouro'])
               $('#bairro').val(data['bairro'])
            }
        },
        error: function(data){
            alertMessage("Não foi possível buscar este CEP.",'erro');
        },
        complete: function(){
            loading.hide();
        }
    });
}


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
        else if(el.attr('id') == 'familia' && value.length != 10)
            errorInput(el,'Formato inválido no campo "Área/Micro/Família"!"');
         if(el.attr('id') == 'senha' && value.length < 6)
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

