<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#show_schedules').DataTable({
            language: {
                processing:     "Processando...",
                search:         "Pesquisar&nbsp;:",
                lengthMenu:    "Ver _MENU_ registros",
                info:           "Mostrando _START_ &agrave; _END_ de _TOTAL_ registros",
                infoEmpty:      "Nenhum registro encontrado",
                infoFiltered:   "(Filtrado _MAX_ elementos no total)",
                infoPostFix:    "",
                loadingRecords: "Chargement en cours...",
                zeroRecords:    "Nenhum registro encontrado",
                emptyTable:     "Nenhum registro encontrado",
                paginate: {
                    first:      "Primeiro",
                    previous:   "Anterior",
                    next:       "Próximo",
                    last:       "Último"
                },
                aria: {
                    sortAscending:  ": Ordem crescente",
                    sortDescending: ": Ordem decrescente"
                }
            }
        });
    } );
</script>