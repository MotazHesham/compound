@include('Admin.includes.scripts.dataTableHelper')

<script type="text/javascript">

    var table = $('#datatable').DataTable({
        bLengthChange: false,
        searching: false,
        responsive: true,
        'processing': true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': '<div class="spinner"></div>'
        },
        serverSide: true,

        order: [[0, 'desc']],

        buttons: ['copy', 'excel', 'pdf'],

        ajax: "{{ route('OrderTenant.allData') }}",

        columns: [
            {data: 'checkBox', name: 'checkBox'},
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'type', name: 'type'},
            {data: 'cat_id', name: 'cat_id'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#formSubmit').submit(function (e) {
        e.preventDefault();
        saveOrUpdate( save_method == 'add' ?"{{ route('OrderTenant.create') }}" : "{{ route('OrderTenant.update') }}");
    });


    function editFunction(id) {

        save_method = 'edit';

        $('#err').slideUp(200);

        $('#loadEdit_' + id).css({'display': ''});

        $.ajax({
            url: "/Tenant/OrderTenant/edit/" + id,
            type: "GET",
            dataType: "JSON",

            success: function (data) {

                $('#loadEdit_' + id).css({'display': 'none'});

                $('#save').text('{{trans('basic.edit')}}');

                $('#titleOfModel').text('{{trans('basic.edit')}}');

                $('#formSubmit')[0].reset();

                $('#formModel').modal();

                $('#content').val(data.content);
                $('#type').val(data.type);
                $('#suggestDate').val(data.suggestDate);
                $('#cat_id').val(data.cat_id);

                $('#id').val(data.id);
            }
        });
    }


    function deleteFunction(id,type) {
        if (type == 2 && checkArray.length == 0) {
            alert('لم تقم بتحديد اي عناصر للحذف');
        } else if (type == 1){
            url =  "/Tenant/OrderTenant/destroy/" + id;
            deleteProccess(url);
        }else{
            url= "/Tenant/OrderTenant/destroy/" + checkArray + '?type=2';
            deleteProccess(url);
            checkArray=[];
        }
    }
</script>

<script>
    $('#seachForm').submit(function(e){
        e.preventDefault();
        var formData=$('#seachForm').serialize();
        table.ajax.url('/Tenant/OrderTenant/allData?'+formData);
        table.ajax.reload();
        TosetV2('{{trans('basic.success')}}','success','',5000);

    })
</script>
