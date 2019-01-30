
    $(document).ready( function () {
        var table = $('#students_list').DataTable({
            ajax: {
                url: listUrl,
                dataSrc: ''
            },
            columns: [
                { data:'firstname'},
                { data:'lastname'},
                { data:'specialisation.name'},
                { data:'school.name'},
                { data:'srm.name'},
                { data:'cirfa.city'},
                { data:'bordee.name'},
                { data:'referent.name'},
            ],
        });

        $('#filter td').each( function (i) {
            var title = $('#students_list thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" placeholder="&#x1F50E; '+title+'" data-index="'+i+'" /><i class="fa fa-search" aria-hidden="true"></i>' );
        } );


        $( table.table().container() ).on( 'keyup', '#filter input', function () {
            table
                .column( $(this).data('index') )
                .search( this.value )
                .draw();
        } );

    } );