
    $(document).ready( function () {
        var table = $('#schools_list').DataTable({
            language: {
                url: '../../json/fr_FR.json'
            },
            ajax: {
                url: listUrl,
                dataSrc: ''
            },
            columns: [
                { data:'name'},
                { data:'number'},
                { data:'email'},
                { data:'academy'},
                {
                    data: 'id',
                    sortable: false,
                    render: function(data){
                        return '<a href="/school/'+ data +'">gérer</a>'
                }}
            ],
        });

        // $('#filter td').each( function (i) {
        //     var title = $('#schools_list thead th').eq( $(this).index() ).text();
        //     $(this).html( '<input type="text" placeholder="&#x1F50E; '+title+'" data-index="'+i+'" /><i class="fa fa-search" aria-hidden="true"></i>' );
        // } );


        // $( table.table().container() ).on( 'keyup', '#filter input', function () {
        //     table
        //         .column( $(this).data('index') )
        //         .search( this.value )
        //         .draw();
        // } );

    } );