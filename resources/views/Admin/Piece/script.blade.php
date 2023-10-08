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
            "sInfo": "عرض صفحة _PAGE_ من _PAGES_",
        },
        serverSide: true,

        order: [[0, 'desc']],

        buttons: ['copy', 'excel', 'pdf'],

        ajax: "{{ route('Piece.allData',['WarehouseType'=>$WarehouseType])}}",

        columns: [
            {data: 'checkBox', name: 'checkBox'},
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'name', name: 'name'},
            {data: 'pieceNumber', name: 'pieceNumber'},
            {data: 'quantity', name: 'quantity'},
            {data: 'cat_id', name: 'cat_id '},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#formSubmit').submit(function (e) {
        e.preventDefault();
        saveOrUpdate( save_method == 'add' ?"{{ route('Piece.create') }}" : "{{ route('Piece.update') }}");
    });


    function editFunction(id) {

        save_method = 'edit';

        $('#err').slideUp(200);

        $('#loadEdit_' + id).css({'display': ''});

        $.ajax({
            url: "/Admin/Piece/edit/" + id,
            type: "GET",
            dataType: "JSON",

            success: function (data) {

                $('#loadEdit_' + id).css({'display': 'none'});

                $('#save').text('{{trans('basic.edit')}}');

                $('#titleOfModel').text('{{trans('basic.edit')}}');

                $('#formSubmit')[0].reset();

                $('#formModel').modal();

                $('#phone').val(data.phone);
                $('#quantity').val(data.quantity);
                $('#name').val(data.name);
                $('#cat_id ').val(data.cat_id );
                $('#pieceNumber').val(data.pieceNumber);
                $('#id').val(data.id);
            }
        });
    }


    function deleteFunction(id,type) {
        if (type == 2 && checkArray.length == 0) {
            alert('no items marked to be deleted  ');
        } else if (type == 1){
            url =  "/Admin/Piece/destroy/" + id;
            deleteProccess(url);
        }else{
            url= "/Admin/Piece/destroy/" + checkArray + '?type=2';
            deleteProccess(url);
            checkArray=[];
        }
    }


</script>

<script>
    $('#seachForm').submit(function(e){
        e.preventDefault();
        var formData=$('#seachForm').serialize();
        table.ajax.url('/Admin/Piece/allData?'+formData);
        table.ajax.reload();
        TosetV2('{{trans('basic.success')}}','success','',5000);

    })
</script>

<script>
    function ExchangeFunc(id) {
        $('#piece_id').val(id);
        $('#ExchangeModel').modal();
    }

    $('#ExchangeForm').submit(function (e) {
        e.preventDefault();
        sendAjaxForm("{{route('exchangeOrder.create')}}",'ExchangeModel','saveExchange','ExchangeForm');
    })
</script>

{{--Destroy Functions--}}
<script>
    function DestroyFunc(id) {
        $('#piece_id2').val(id);
        $('#DestroyModel').modal();
    }

    $('#DestroyForm').submit(function (e) {
        e.preventDefault();
        sendAjaxForm("{{route('DestroyOrder.create')}}",'DestroyModel','saveDestroy','DestroyForm');
    })
</script>