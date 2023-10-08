@include('Admin.includes.scripts.dataTableHelper')

<script type="text/javascript">

    var table2 = $('#datatable2').DataTable({
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

        ajax: "{{ route('exchangeOrder.allData',['piece_id'=>$piece->id])}}",

        columns: [
            {data: 'checkBox', name: 'checkBox'},
            {data: 'id', name: 'id'},
            {data: 'admin_id', name: 'admin_id'},
            {data: 'quantity', name: 'quantity'},
            {data: 'technical_id', name: 'technical_id'},
            {data: 'piece_id', name: 'piece_id'},
            {data: 'villa_id', name: 'villa_id'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    function addFunction2(){
        newAddFunction('exchangeOrder');
    }

    $('#formexchangeOrder').submit(function (e) {
        e.preventDefault();
        newSaveOrUpdate(save_method == 'add' ? "{{ route('exchangeOrder.create') }}" : "{{ route('exchangeOrder.update') }}",'exchangeOrder','table2');
        table2.ajax.reload();
    });

    function deleteFunction2(id, type) {
        if (type == 2 && checkArray.length == 0) {
            alert('لم تقم بتحديد اي عناصر للحذف');
        } else if (type == 1) {
            url = "/Admin/exchangeOrder/destroy/" + id;
            deleteProccess(url);
            table2.ajax.reload();
        } else {
            url = "/Admin/exchangeOrder/destroy/" + checkArray + '?type=2';
            deleteProccess(url);
            table2.ajax.reload();
            checkArray = [];
        }
    }

</script>

