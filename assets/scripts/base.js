$(document).ready( function () {

    $('[data-fancybox="galeria"]').fancybox({
        loop: true,
    });


    $('.realFomato').priceFormat({
        prefix: 'R$ ',
        centsSeparator: ',',
        thousandsSeparator: '.'
    });


    $('.time').mask('00:00:00');
    $('.hora').mask('00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
    $('.cep').mask('00000-000');
    $('.phone').mask('0000-0000');
    $('.phone_with_ddd').mask('(00) 0000-0000');
    $('.phone_us').mask('(000) 000-0000');
    $('.mixed').mask('AAA 000-S0S');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.money2').mask("#.##0,00", {reverse: true});
    $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
        translation: {
            'Z': {
                pattern: /[0-9]/, optional: true
            }
        }
    });
    $('.ip_address').mask('099.099.099.099');
    $('.percent').mask('##0,00%', {reverse: true});
    $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
    $('.data_linha').mask("00/00/0000", {placeholder: "__/__/____"});
    $('.fallback').mask("00r00r0000", {
        translation: {
            'r': {
                pattern: /[\/]/,
                fallback: '/'
            },
            placeholder: "__/__/____"
        }
    });
    $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});

    var maskara = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(maskara.apply({}, arguments), options);
        }
    };

    $('.telefone-br').mask(maskara, spOptions);


    $('.js-example-basic-single').select2();
    $('.js-example-basic-multiple').select2();


    
});


function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

$('#confirm-modal').on('show.bs.modal', function(e) {

    let texto;

    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

    let tipo = $(e.relatedTarget).data('tipo');

    switch (tipo) {
        case "confirmar":
            texto = "Deseja realmente excluir este item?";
          break;
        case "Maçãs":
          console.log("Maçãs custam $0.32 o quilo.");
          break;
        case "Bananas":
          console.log("Bananas custam $0.48 o quilo.");
          break;
        case "Cerejas":
          console.log("Cerejas custam $3.00 o quilo.");
          break;
        case "Mangas":
        case "Mamões":
          console.log("Mangas e mamões custam $2.79 o quilo.");
          break;
        default:
          console.log("Desculpe, estamos sem nenhuma " + expr + ".");
      }

    $(this).find('p').text(texto);

    
    $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});


tinymce.init({
    selector: '.editorx',
    height: 200,
    content_style: "p {font-size: 14px}",
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code help'
    ],
    toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat code '
});

tinymce.init({
    selector: '.editorx02',
    height: 500,
    content_style: "p {font-size: 14px}, img {margin: 10px} ",
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code help'
    ],
    toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat code '
});

function gotop(){
	$("html, body").animate({ scrollTop: 0 }, "slow");
}

$(".seletor-simples").map(function() {
        
    let selecionado = $(this).data('select');
    if(selecionado) $(this).val(selecionado)
    
});

  
$(".seletor-radio").map(function() {
    
    let selecionado = $(this).data('select');
    if(selecionado) $(this).val(selecionado);
    if(!selecionado) return;

    $(this).find("[value=" + selecionado + "]").prop('checked', true);

    //$("input[name="+nome_radio+"][value=" + selecionado + "]").prop('checked', true);
    
});


function preloader(str)
{
    if(str == 'add')
    {
        $('.preloader-wrapper').fadeIn(500);;
    }

    if(str == 'remove')
    {
        $('.preloader-wrapper').fadeOut(300);
    }
}





