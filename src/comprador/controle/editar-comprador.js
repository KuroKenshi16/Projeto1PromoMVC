$(document).ready(function(){

    $('#table-comprador').on('click', 'button.btn-edit', function(e) {
        e.preventDefault()

        //Limpar todas as informações já existentes em na modal
       $('.modal-title').empty()
       $('.modal-body').empty()

       //Incluir novos textos no cabeçalho da janela modal
       $('.modal-title').append('Editar registro')

      let ID = `ID=${$(this).attr('id')}`

      $('.btn-salvar').removeAttr('data-operation')

      $.ajax({
          type: 'POST',
          dataType: 'json',
          assync: true,
          data: ID,
          url: 'src/comprador/modelo/visualizar-comprador.php',
          success: function(dado) {
              if(dado.tipo == 'success') {
                  $('.modal-body').load('src/comprador/visao/form-comprador.html', function() {
                      $('#NOME').val(dado.dados.NOME)
                      $('#CELULAR').val(dado.dados.CELULAR)
                      $('#ID').val(dado.dados.ID)
                  })
                  $('.btn-salvar').show()
                  $('#modal-comprador').modal('show')
               } else {
                Swal.fire({
                    title: 'SysRifa',
                    text: dados.mensagem,
                    icon: dados.tipo,
                    confirmButtonText: 'OK'
                })

               }
         }
      })
    })
})