
    $(document).ready( function () {
        var table = $('#sn_tasks_list').DataTable({
            language: {
                url: '../../json/fr_FR.json'
            },
            ajax: {
                url: listUrl,
                dataSrc: ''
            },
            columns: [
                { data:'reference'},
                { data:'label'},
                {
                    data: 'id',
                    sortable: false,
                    render: function(data){
                        return '<a href="/admin/sntask/'+ data +'/edit">Editer</a>'
                }}
            ],
        });

        // $('#filter td').each( function (i) {
        //     var title = $('#sn_tasks_list thead th').eq( $(this).index() ).text();
        //     $(this).html( '<input type="text" placeholder="&#x1F50E; '+title+'" data-index="'+i+'" /><i class="fa fa-search" aria-hidden="true"></i>' );
        // } );


        // $( table.table().container() ).on( 'keyup', '#filter input', function () {
        //     table
        //         .column( $(this).data('index') )
        //         .search( this.value )
        //         .draw();
        // } );

    } );