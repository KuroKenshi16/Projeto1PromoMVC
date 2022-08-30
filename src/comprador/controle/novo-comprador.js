$(document).ready(function() {

    $('.btn-novo').click(function(e) {
        e.preventDefault()

       //Limpar todas as informações já existentes em na modal
       $('.modal-title').empty()
       $('.modal-body').empty()

       //Incluir novos textos no cabeçalho da janela modal
       $('.modal-title').append('Adicionar novo registro')

       //Incluir o formulário dentro do corpo da janela modal
       $('.modal-body').load('src/comprador/visao/form-comprador.html')

       //Inclui função no otão salvar para demonstração de novo registro
       $('.btn-salvar').attr('data-operation', 'insert')

       //abrir janela modal
       $('#modal-comprador').modal('show')
    })

})