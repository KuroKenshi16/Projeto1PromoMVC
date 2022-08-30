$(document).ready(function(){

    $('#table-promocao').on('click', 'button.btn-edit', function(e){
        e.preventDefault()

        //Limpar todas as informações já existentes em nossa modal
       $('.modal-title').empty()
       $('.modal-body').empty()

       //Incluir nonos textos no cabeçalho da minha janela modal
       $('.modal-title').append('Editar registro')

       let ID = `ID=${$(this).attr('id')}`

       $('.btn-salvar').removeAttr('data-operation')

       $.ajax({
        type: 'POST',
        dataType: 'json',
        assync: true,
        data: ID,
        url: 'src/promocao/modelo/visualizar-promocao.php',
        success: function(dado){
            if(dado.tipo == 'success'){
                $('.modal-body').load('src/promocao/visao/form-promocao.html', function () {
                    $('#TITULO').val(dado.dados.TITULO)
                    $('#DESCRICAO').val(dado.dados.DESCRICAO)
                    $('#DATA_INICO').val(dado.dados.DATA_INICO)
                    $('#DATA_FIM').val(dado.dados.DATA_FIM)
                    $('#DATA_SORTEIO').val(dado.dados.DATA_SORTEIO)
                    $('#ARRECADACAO').val(dado.dados.ARRECADACAO)
                    $('#VALO_RIFA').val(dado.dados.VALOR_RIFA)
                    $('#ID').val(dado.dados.ID)
                })
                $('.btn-salvar').show()
                $('#modal-promocao').modal('show')
         }else{
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