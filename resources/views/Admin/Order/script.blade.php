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
           // "sInfo":  "عرض صفحة _PAGE_ من _PAGES_" ,
        },
        serverSide: true,

        order: [[0, 'desc']],

        buttons: ['copy', 'excel', 'pdf'],

        ajax: "{{ route('Order.allData')}}",

        columns: [
            {data: 'checkBox', name: 'checkBox'},
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'type', name: 'type'},
            {data: 'cat_id', name: 'cat_id'},
            {data: 'technical_id', name: 'technical_id'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#formSubmit').submit(function (e) {
        e.preventDefault();
        saveOrUpdate( save_method == 'assign' ?"{{ route('Order.assign') }}" : "{{ route('Order.update') }}");
    });


    function assignFunction(id) {

        save_method = 'assign';
        $('#save').text('{{trans('basic.edit')}}');

        $('#titleOfModel').text('{{getChangeStatusTitle()   }}');

        $('#formSubmit')[0].reset();

        $('#formModel').modal();
        $('#id').val(id);

    }


    function deleteFunction(id,type) {
        if (type == 2 && checkArray.length == 0) {
            alert('no items marked to be deleted  ');
        } else if (type == 1){
            url =  "/Admin/Order/destroy/" + id;
            deleteProccess(url);
        }else{
            url= "/Admin/Order/destroy/" + checkArray + '?type=2';
            deleteProccess(url);
            checkArray=[];
        }
    }

    function showFunction(id) {
        location.href='/Admin/Order/show/'+id;
        {{--save_method = 'edit';--}}

        {{--$('#err').slideUp(200);--}}

        {{--$('#loadShow_' + id).css({'display': ''});--}}

        {{--$.ajax({--}}
        {{--    url: "/Admin/Order/edit/" + id,--}}
        {{--    type: "GET",--}}
        {{--    dataType: "JSON",--}}

        {{--    success: function (data) {--}}

        {{--        $('#loadShow_' + id).css({'display': 'none'});--}}

        {{--        $('#showData').modal();--}}

        {{--        $('#name').text(data.name);--}}
        {{--        $('#cat_idShow').text(data.cat_id);--}}
        {{--        $('#typeShow').text(data.type == 1 ? '{{trans('admins.Regular_maintenance')}}' : '{{trans('admins.Emergency_maintenance')}}');--}}
        {{--        $('#suggestDateShow').text(data.suggestDate);--}}
        {{--        $('#created_at').text(data.created_at);--}}
        {{--        $('#id').text(data.id);--}}
        {{--        $('#RequiredShow').val(data.content);--}}
        {{--        $('#priceShow').text(data.price);--}}
        {{--        $('#tenant_id').text(data.tenant_id);--}}
        {{--        $('#super_idShow').text(data.super_id);--}}
        {{--        $('#technical_idShow').text(data.technical_id);--}}
        {{--    }--}}
        {{--});--}}
    }
    
    function orderStatusFunction(id,status) {
        Toset('{{trans('basic.wait')}}','info','{{trans('basic.progress')}}',false);
        $.ajax({
            url : '/Admin/Order/ChangeStatus/' +id +'?status='+status,
            type : 'get',
            success : function(data){
                $.toast().reset('all');
                table.ajax.reload();
                Toset('order status changed successfully','success','',5000);
            }
        })
    }
</script>

<script>
    function ExchangeFunc(id) {
        $('#order_id').val(id);
        $('#ExchangeModel').modal();
    }

    $('#ExchangeForm').submit(function (e) {
        e.preventDefault();
        sendAjaxForm("{{route('Order.save_piece')}}",'ExchangeModel','saveExchange','ExchangeForm');
    })
</script>


<script>
    $('#seachForm').submit(function(e){
        e.preventDefault();
        var formData=$('#seachForm').serialize();
        table.ajax.url('/Admin/Order/allData?'+formData);
        table.ajax.reload();
        TosetV2('{{trans('basic.success')}}','success','',5000);

    })
</script>