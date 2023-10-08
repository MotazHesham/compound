@include('Admin.includes.scripts.dataTableHelper')

<script type="text/javascript">

    var table = $('#datatable').DataTable({
        bLengthChange: false,
        searching: true,
        responsive: true,
        'processing': true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': '<div class="spinner"></div>',
            'sSearch' : '{{trans('admins.search')}} :',
            "paginate": {
                "next": "next",
                "previous": "previous"
            },
            "sInfo":  "عرض صفحة _PAGE_ من _PAGES_" ,
        },
        serverSide: true,

        order: [[0, 'desc']],

        buttons: ['copy', 'excel', 'pdf'],

        ajax: "{{ route('Compound.allData')}}",

        columns: [
            {data: 'checkBox', name: 'checkBox'},
            {data: 'id', name: 'id'},
            {data: 'compound_name', name: 'compound_name'},
            {data: 'number_of_villas', name: 'number_of_villas'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#formSubmit').submit(function (e) {
        e.preventDefault();
        saveOrUpdate( save_method == 'add' ?"{{ route('Compound.create') }}" : "{{ route('Compound.update') }}");
    });


    function editFunction(id) {

        save_method = 'edit';

        $('#err').slideUp(200);

        $('#loadEdit_' + id).css({'display': ''});

        $.ajax({
            url: "/Admin/Compound/edit/" + id,
            type: "GET",
            dataType: "JSON",

            success: function (data) {

                $('#loadEdit_' + id).css({'display': 'none'});

                $('#save').text('{{trans('basic.edit')}}');

                $('#titleOfModel').text('{{trans('basic.edit')}}');

                $('#formSubmit')[0].reset();

                $('#formModel').modal();

                $('#compound_name').val(data.compound_name);
                $('#compound_address').val(data.compound_address);
                $('#number_of_villas').val(data.number_of_villas);
                $('#id').val(data.id);
            }
        });
    }


    function deleteFunction(id,type) {
        if (type == 2 && checkArray.length == 0) {
            alert('no items marked to be deleted  ');
        } else if (type == 1){
            url =  "/Admin/Compound/destroy/" + id;
            deleteProccess(url);
        }else{
            url= "/Admin/Compound/destroy/" + checkArray + '?type=2';
            deleteProccess(url);
            checkArray=[];
        }
    }


</script>
