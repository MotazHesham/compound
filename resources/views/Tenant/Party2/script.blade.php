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

        ajax: "{{ route('TParty2.allData') }}",

        columns: [
            {data: 'checkBox', name: 'checkBox'},
            {data: 'id', name: 'id'},
            {data: 'date', name: 'date'},
            {data: 'time', name: 'time'},
            {data: 'type', name: 'type'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


        $('#formSubmit').submit(function (e) {
            e.preventDefault();
            $("#save").attr("disabled", true);
            Toset('{{trans('basic.wait')}}','info','{{trans('basic.progress')}}',false);
            var formData = $('#formSubmit').serialize();
            $.ajax({
                url : '/Tenant/TParty2/create',
                type: "get",
                data: formData,
                success : function(data){
                    $("#save").attr("disabled", false);
                    $.toast().reset('all');
                    swal(data.message, {
                        icon: data.icon,
                    });
                    table.ajax.reload();
                    $('#formModel').modal('toggle');
                    if(data.status == 1){

                    }
                }

            })

        });

    function deleteFunction(id,type) {
        if (type == 2 && checkArray.length == 0) {
            alert('لم تقم بتحديد اي عناصر للحذف');
        } else if (type == 1){
            url =  "/Tenant/TParty2/destroy/" + id;
            deleteProccess(url);
        }else{
            url= "/Tenant/TParty2/destroy/" + checkArray + '?type=2';
            deleteProccess(url);
            checkArray=[];
        }
    }


</script>

