var tableodonto;
function inicializarOdonto() {
    if($.fn.DataTable.isDataTable('.listardadosodonto')) {
        $('.listardadosodonto').DataTable().destroy();
    }
    tableodonto = $(".listardadosodonto").DataTable({
        dom: '<"flex justify-between"<"#title_odonto">ftr><t><"flex justify-between"lp>',
        language: {
            "search": "Pesquisar",
            "paginate": {
                "next": "Próx.",
                "previous": "Ant.",
                "first": "Primeiro",
                "last": "Último"
            },
            "emptyTable": "Nenhum registro encontrado",
            "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 até 0 de 0 registros",
            "infoFiltered": "(Filtrados de _MAX_ registros)",
            "infoThousands": ".",
            "loadingRecords": "Carregando...",
            "processing": "Processando...",
            "lengthMenu": "Exibir _MENU_ por página",
            "zeroRecords": "Nenhum registro encontrado"
        },
        ajax: {
            "url":listarOdonto,
            "dataSrc": ""
        },
        "lengthMenu": [1000,2000,3000],
        "ordering": false,
        "paging": true,
        "searching": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "processing": true,
        columns: [
            {data:"created_at",name:"created_at"},
            {data:"nome",name:"nome"},
            {data:"usuario",name:"usuario",},
            {data:"valor",name:"valor_plano",render: $.fn.dataTable.render.number('.', ',', 2, 'R$ ')},
        ],
        "columnDefs": [],
        "initComplete": function( settings, json ) {},
        "drawCallback":function(settings) {},
        footerCallback: function (row, data, start, end, display) {}
    });
}

$('#tabela_odonto').on('click', 'tbody tr', function () {
    tableodonto.$('tr').removeClass('textoforte');
    $(this).closest('tr').addClass('textoforte');
});
