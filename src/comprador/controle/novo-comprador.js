$(document).ready(function(){
    $('.btn-novo').click(function(event){
        event.preventDefault()

       //Limpar todas as informações já existentes em nossa modal
       $('.modal-title').empty()
       $('.modal-body').empty()

       //Incluir nonos textos no cabeçalho da minha janela modal
       $('.modal-title').append('Adicionar novo registro')

       //Incluir o nosso formulario dentro da nossa janela modal
       $('.modal-body').load('src/comprador/visao/form-comprador.html')

       //Iremos incluir uma função no botão salvar para demonstrar que é um novo registro
       $('.btn-salvar').attr('data-operation', 'insert')

       //Abrir nossa janela modal
       $('#modal-tipo').modal('show')
    })
})