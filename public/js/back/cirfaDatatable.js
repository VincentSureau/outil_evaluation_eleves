
    $(document).ready( function () {
        var table = $('#students_list').DataTable({
            language: {
                url: '../../json/fr_FR.json'
            },
            // responsive: true,
            // scrollX: true,
            ajax: {
                url: listUrl,
                dataSrc: ''
            },
            columns: [
                { data:'city'},
                { data:'number'},
                { data:'email'},
                {
                    data: 'id',
                    sortable: false,
                    render: function(data){
                        return '<a href="/admin/cirfa/'+ data +'/edit">Editer</a>'
                }}
            ],
        });

        // $('#filter td').each( function (i) {
        //     var title = $('#cirfa_list thead th').eq( $(this).index() ).text();
        //     $(this).html( '<input type="text" placeholder="&#x1F50E; '+title+'" data-index="'+i+'" /><i class="fa fa-search" aria-hidden="true"></i>' );
        // } );


        // $( table.table().container() ).on( 'keyup', '#filter input', function () {
        //     table
        //         .column( $(this).data('index') )
        //         .search( this.value )
        //         .draw();
        // } );

    } );