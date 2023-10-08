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
            //"sInfo": "عرض صفحة _PAGE_ من _PAGES_",
        },
        serverSide: true,

        order: [[0, 'desc']],

        buttons: ['copy', 'excel', 'pdf'],

        ajax: "{{ route('Tenant.allData')}}",

        columns: [
            {data: 'checkBox', name: 'checkBox'},
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'phone', name: 'phone'},
            {data: 'contractNumber', name: 'contractNumber'},
            {data: 'villa_id', name: 'villa_id '},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#formSubmit').submit(function (e) {
        e.preventDefault();
        saveOrUpdate( save_method == 'add' ?"{{ route('Tenant.create') }}" : "{{ route('Tenant.update') }}");
    });


    function editFunction(id) {

        save_method = 'edit';

        $('#err').slideUp(200);

        $('#loadEdit_' + id).css({'display': ''});

        $.ajax({
            url: "/Admin/Tenant/edit/" + id,
            type: "GET",
            dataType: "JSON",

            success: function (data) {

                $('#loadEdit_' + id).css({'display': 'none'});

                $('#save').text('{{trans('basic.edit')}}');

                $('#titleOfModel').text('{{trans('basic.edit')}}');

                $('#formSubmit')[0].reset();

                $('#formModel').modal();

                $('#nationality').val(data.nationality);
                $('#companyName').val(data.companyName);
                $('#phone').val(data.phone);
                $('#anotherPhone').val(data.anotherPhone);
                $('#name').val(data.name);
                $('#id_number').val(data.id_number);
                $('#roleType').val(data.roleType);
                $('#Tenantistration').val(data.Tenantistration);
                $('#companyManger').val(data.companyManger);
                $('#companyMangerPhone').val(data.companyMangerPhone);
                $('#companyMangerEmail').val(data.companyMangerEmail);
                $('#contractNumber').val(data.contractNumber);
                $('#contractDate').val(data.contractDate);
                $('#villa_id').val(data.villa_id );
                $('#status_id').val(data.status_id);
                $('#contractType').val(data.contractType);
                $('#contractAmount').val(data.contractAmount);
                $('#email').val(data.email);
                $('#id').val(data.id);
            }
        });
    }


    function deleteFunction(id,type) {
        if (type == 2 && checkArray.length == 0) {
            alert('no items marked to be deleted  ');
        } else if (type == 1){
            url =  "/Admin/Tenant/destroy/" + id;
            deleteProccess(url);
        }else{
            url= "/Admin/Tenant/destroy/" + checkArray + '?type=2';
            deleteProccess(url);
            checkArray=[];
        }
    }


</script>

<script>
    function sendEmails() {
        $('#ids').val(checkArray);
        $('#emailModel').modal('toggle');
    }

    $('#emailSubmit').submit(function (e) {
        e.preventDefault();
        sendAjaxForm('{{route("Tenant.sendEmails")}}','emailModel','mailSave','emailSubmit');
    })
</script>

<script>
    $('#seachForm').submit(function(e){
        e.preventDefault();
        var formData=$('#seachForm').serialize();
        table.ajax.url('/Admin/Tenant/allData?'+formData);
        table.ajax.reload();
        TosetV2('{{trans('basic.success')}}','success','',5000);

    })
</script>