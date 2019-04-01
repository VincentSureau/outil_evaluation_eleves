
    $(document).ready( function () {
        var table = $('#competence_list').DataTable({
            language: {
                url: '../../json/fr_FR.json'
            },
            ajax: {
                url: listUrl,
                dataSrc: ''
            },
            columns: [
                { data:'reference'},
                { data:'name'},
                {
                    data: 'id',
                    sortable: false,
                    render: function(data){
                        return '<a href="/admin/competence/'+ data +'/edit">Editer</a>'
                }}
            ],
        });

        // $('#filter td').each( function (i) {
        //     var title = $('#competence_list thead th').eq( $(this).index() ).text();
        //     $(this).html( '<input type="text" placeholder="&#x1F50E; '+title+'" data-index="'+i+'" /><i class="fa fa-search" aria-hidden="true"></i>' );
        // } );


        // $( table.table().container() ).on( 'keyup', '#filter input', function () {
        //     table
        //         .column( $(this).data('index') )
        //         .search( this.value )
        //         .draw();
        // } );

    } );