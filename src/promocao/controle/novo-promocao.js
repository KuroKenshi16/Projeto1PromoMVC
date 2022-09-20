$(document).ready(function() {

    $('.btn-novo').click(function(e){
        e.preventDefault()

        //Limpar todas as informações já existentes em nossa modal
        $('.modal-title').empty()
        $('.modal-body').empty()

        //Incluir novos textos no cabeçalho da minha janela modal
        $('.modal-title').append('Adicionar novo registro')

        //Incluir nosso formulário dentro do corpo da nossa janela modal
        $('.modal-body').load('src/promocao/visao/form-promocao.html')

        //Iremos incluir uma função no botão salvar para demonstrar um novo registro
        $('.btn-salvar').attr('data-operation', 'insert')

        //Abrir a janela modal
        $('#modal-promocao').modal('show')
    })

})