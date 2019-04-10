
    $(document).ready( function () {
        var table = $('#referents_list').DataTable({
            language: {
                url: '../../json/fr_FR.json'
            },
            ajax: {
                url: listUrl,
                dataSrc: ''
            },
            columns: [
                { data:'gender'},
                { data:'firstname'},
                { data:'lastname'},
                {
                    data: 'id',
                    sortable: false,
                    render: function(data){
                        return '<a href="/admin/referent/'+ data +'/edit">Editer</a>'
                }}
            ],
        });

        // $('#filter td').each( function (i) {
        //     var title = $('#referents_list thead th').eq( $(this).index() ).text();
        //     $(this).html( '<input type="text" placeholder="&#x1F50E; '+title+'" data-index="'+i+'" /><i class="fa fa-search" aria-hidden="true"></i>' );
        // } );


        // $( table.table().container() ).on( 'keyup', '#filter input', function () {
        //     table
        //         .column( $(this).data('index') )
        //         .search( this.value )
        //         .draw();
        // } );

    } );