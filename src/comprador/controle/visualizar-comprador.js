$(document).ready(function(){

    $('#table-comprador').on('click', 'button.btn-view', function(e){
        e.preventDefault()

        //Limpar todas as informações já existentes em na modal
       $('.modal-title').empty()
       $('.modal-body').empty()

       //Incluir novos textos no cabeçalho da janela modal
       $('.modal-title').append('Visualizar registro')

      let ID = `ID=${$(this).attr('id')}`

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
                      $('#NOME').attr('readonly', 'true')
                      $('#CELULAR').val(dado.dados.CELULAR)
                      $('#CELULAR').attr('readonly', 'true')
                  })
                  $('.btn-salvar').hide()
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