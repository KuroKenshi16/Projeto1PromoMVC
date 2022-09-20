$(document).ready(function(){

    $('#table-tipo').on('click', 'button.btn-view', function(e){
        e.preventDefault()

        //Limpar todas as informações já existentes em nossa modal
       $('.modal-title').empty()
       $('.modal-body').empty()

       //Incluir nonos textos no cabeçalho da minha janela modal
       $('.modal-title').append('Visualizar registro')

       let ID = `ID=${$(this).attr('id')}`

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
                    $('#TITULO').attr('readonly', 'true'),
                    $('#DESCRICAO').val(dado.dados.DESCRICAO)
                    $('#DESCRICAO').attr('readonly', 'true'),
                    $('#DATA_INICIO').val(dado.dados.DATA_INICIO)
                    $('#DATA_INICIO').attr('readonly', 'true'),
                    $('#DATA_FIM').val(dado.dados.DATA_FIM)
                    $('#DATA_FIM').attr('readonly', 'true'),
                    $('#DATA_SORTEIO').val(dado.dados.DATA_SORTEIO)
                    $('#DATA_SORTEIO').attr('readonly', 'true'),
                    $('#ARRECADACAO').val(dado.dados.ARRECADACAO)
                    $('#ARRECADACAO').attr('readonly', 'true'),
                    $('#VALOR_RIFA').val(dado.dados.VALOR_RIFA)
                    $('#VALOR_RIFA').attr('readonly', 'true')
                })
                $('.btn-salvar').hide()
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