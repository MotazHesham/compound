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
        },
        serverSide: true,

        order: [[0, 'desc']],

        buttons: ['copy', 'excel', 'pdf'],

        ajax: "{{ route('exchangeOrder.allData',['order_id'=>$order_id])}}",

        columns: [
            {data: 'checkBox', name: 'checkBox'},
            {data: 'id', name: 'id'},
            {data: 'quantity', name: 'quantity'},
            {data: 'technical_id', name: 'technical_id'},
            {data: 'piece_id', name: 'piece_id'},
            {data: 'villa_id', name: 'villa_id'},
            {data: 'order_id', name: 'order_id'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#formSubmit').submit(function (e) {
        e.preventDefault();
        saveOrUpdate( save_method == 'add' ?"{{ route('exchangeOrder.create') }}" : "{{ route('exchangeOrder.update') }}");
    });


    function editFunction(id) {

        save_method = 'edit';

        $('#err').slideUp(200);

        $('#loadEdit_' + id).css({'display': ''});

        $.ajax({
            url: "/Admin/exchangeOrder/edit/" + id,
            type: "GET",
            dataType: "JSON",

            success: function (data) {

                $('#loadEdit_' + id).css({'display': 'none'});

                $('#save').text('{{trans('basic.edit')}}');

                $('#titleOfModel').text('{{trans('basic.edit')}}');

                $('#formSubmit')[0].reset();

                $('#formModel').modal();

                $('#supplierName').val(data.supplierName);
                $('#price').val(data.price);
                $('#phone').val(data.phone);
                $('#quantity').val(data.quantity);
                $('#WarehouseType').val(data.WarehouseType);
                $('#name').val(data.name);
                $('#cat_id ').val(data.cat_id );
                $('#exchangeOrderNumber').val(data.exchangeOrderNumber);
                $('#id').val(data.id);
            }
        });
    }


    function deleteFunction2(id,type) {
        if (type == 2 && checkArray.length == 0) {
            alert('no items marked to be deleted  ');
        } else if (type == 1){
            url =  "/Admin/exchangeOrder/destroy/" + id;
            deleteProccess(url);
        }else{
            url= "/Admin/exchangeOrder/destroy/" + checkArray + '?type=2';
            deleteProccess(url);
            checkArray=[];
        }
    }


</script>

<script>
    $('#seachForm').submit(function(e){
        e.preventDefault();
        var formData=$('#seachForm').serialize();
        table.ajax.url('/Admin/exchangeOrder/allData?'+formData);
        table.ajax.reload();
        TosetV2('{{trans('basic.success')}}','success','',5000);

    })
</script>

<script>
    function ExchangeFunc(id) {
        $('#exchangeOrder_id').val(id);
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
        $('#exchangeOrder_id2').val(id);
        $('#DestroyModel').modal();
    }

    $('#DestroyForm').submit(function (e) {
        e.preventDefault();
        sendAjaxForm("{{route('exchangeOrder.create')}}",'DestroyModel','saveDestroy','DestroyForm');
    })


    function changeStatus(id,status) {
        Toset('{{trans('basic.wait')}}','info','{{trans('basic.progress')}}',false);
        $.ajax({
            url : '/Admin/exchangeOrder/ChangeStatus/' +id +'?status='+status,
            type : 'get',
            success : function(data){
                $.toast().reset('all');
                table.ajax.reload();
                Toset('order status changed successfully','success','',5000);
            }
        })
    }
</script>