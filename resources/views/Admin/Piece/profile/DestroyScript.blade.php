@include('Admin.includes.scripts.dataTableHelper')

<script type="text/javascript">

    var table3 = $('#datatable3').DataTable({
        bLengthChange: false,
        searching: false,
        responsive: true,
        'processing': true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': '<div class="spinner"></div>',
            'sSearch': '{{trans("admins.search")}} :',
            "paginate": {
                //"next": "التالي",
                //"previous": "السابق"
            },
            //"sInfo": "عرض صفحة _PAGE_ من _PAGES_",
        },
        serverSide: true,

        order: [[0, 'desc']],

        buttons: ['copy', 'excel', 'pdf'],

        ajax: "{{ route('DestroyOrder.allData',['piece_id'=>$piece->id])}}",

        columns: [
            {data: 'id', name: 'id'},
            {data: 'admin_id', name: 'admin_id'},
            {data: 'super_id', name: 'super_id'},
            {data: 'quantity', name: 'quantity'},
            {data: 'date', name: 'date'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    function addFunction3(){
        newAddFunction('Destroy');
    }

    $('#formDestroy').submit(function (e) {
        e.preventDefault();
        newSaveOrUpdate(save_method == 'add' ? "{{ route('DestroyOrder.create') }}" : "{{ route('DestroyOrder.update') }}",'Destroy');
        table3.ajax.reload();
    });

    function deleteFunction3(id, type) {
        if (type == 2 && checkArray.length == 0) {
            alert('لم تقم بتحديد اي عناصر للحذف');
        } else if (type == 1) {
            url = "/Admin/DestroyOrder/destroy/" + id;
            deleteProccess(url);
            table3.ajax.reload();
        } else {
            url = "/Admin/DestroyOrder/destroy/" + checkArray + '?type=2';
            deleteProccess(url);
            table3.ajax.reload();
            checkArray = [];
        }
        table3.ajax.reload();
    }

</script>

