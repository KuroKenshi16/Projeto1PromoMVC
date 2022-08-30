$(document).ready(function(){
    $('#table-promocao').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "src/promocao/modelo/list-promocao.php",
            "type": "POST"
        },
        "columns": [
        {
            "data": 'ID',
            "className": 'text-center'
        },
        {
            "data": 'TITULO',
            "className": 'text-center'
        },
        {
            "data": 'DESCRICAO',
            "className": 'text-center'
        },
        {
            "data": 'DATA_INICO',
            "className": 'text-center'
        },
        {
            "data": 'DATA_FIM',
            "className": 'text-center'
        },
        {
            "data": 'DATA_SORTEIO',
            "className": 'text-center'
        },
        {
            "data": 'ARRECADACAO',
            "className": 'text-center'
        },
        {
            "data": 'VALOR_rifa',
            "className": 'text-center'
        },
        {
            "data": 'ID',
            "className": 'text-center',
            "orderable": false,
            "searchable": false,
            "render": function(data, type, row, meta){
                return `
                <button id="${data}" class="btn btn-info btn-view"> Visualizar</button>
                <button id="${data}" class="btn btn-warning btn-edit"> Editar</button>
                <button id="${data}" class="btn btn-danger btn-delete"> Excluir</button>
                `
            } 
        }
    
]
})
})