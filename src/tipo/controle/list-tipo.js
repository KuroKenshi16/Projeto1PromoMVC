$(document).ready(function(){
    $('#table-tipo').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "src/tipo/modelo/list-tipo.php",
            "type": "POST"
        },
        "columns": [{
            "data": 'ID',
            "className": 'text-center'
        },
        {
            "data": 'NOME',
            "className": 'text-center'
        },
        {
            "data": 'ID',
            "className": 'text-center',
            "orderable": false,
            "searchble": false,
            "render": function(data, type, row, meta){
                return `
                <button id="${data}" class="btn btn-info btn-view">Visualizar</button>
                <button id="${data}" class="btn btn-warning btn-edit">Editar</button>
                <button id="${data}" class="btn btn-danger btn-delete">Excluir</button>
                `
            }
        }
    ]
    })
})