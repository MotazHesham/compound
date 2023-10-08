@include('Admin.includes.scripts.dataTableHelper')

<script type="text/javascript">

    var table = $('#datatable').DataTable({
        bLengthChange: false,
        searching: false,
        responsive: true,
        'processing': true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': '<div class="spinner"></div>',
            'sSearch': 'بحث :',
            "paginate": {
                //"next": "التالي",
                //"previous": "السابق"
            },
           // "sInfo": "عرض صفحة _PAGE_ من _PAGES_",
        },
        serverSide: true,

        order: [[0, 'desc']],

        buttons: ['copy', 'excel', 'pdf'],

        ajax: "{{ route('Invoice.allData',['piece_id'=>$piece->id])}}",

        columns: [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'supplierName', name: 'supplierName'},
            {data: 'price', name: 'price'},
            {data: 'quantity', name: 'quantity'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#formSubmit').submit(function (e) {
        e.preventDefault();
        saveOrUpdate(save_method == 'add' ? "{{ route('Invoice.create') }}" : "{{ route('Invoice.update') }}");
    });


    function editFunction(id) {

        save_method = 'edit';

        $('#err').slideUp(200);

        $('#loadEdit_' + id).css({'display': ''});

        $.ajax({
            url: "/Admin/Invoice/edit/" + id,
            type: "GET",
            dataType: "JSON",

            success: function (data) {

                $('#loadEdit_' + id).css({'display': 'none'});

                $('#save').text('Edit');

                $('#titleOfModel').text('Edit Invoice');

                $('#formSubmit')[0].reset();

                $('#formModel').modal();

                $('#supplierName').val(data.supplierName);
                $('#quantity').val(data.quantity);
                $('#price').val(data.price);
                $('#piece_id').val(data.piece_id);
                $('#id').val(data.id);
            }
        });
    }


    function deleteFunction(id, type) {
        if (type == 2 && checkArray.length == 0) {
            alert('لم تقم بتحديد اي عناصر للحذف');
        } else if (type == 1) {
            url = "/Admin/Invoice/destroy/" + id;
            deleteProccess(url);
        } else {
            url = "/Admin/Invoice/destroy/" + checkArray + '?type=2';
            deleteProccess(url);
            checkArray = [];
        }
    }

</script>

{{-- ChangeStatus Function --}}
<script>
    function ChangeStatus(status, id) {
        Toset('طلبك قيد التنفيذ', 'info', '', false);
        $.ajax({
            url: '/Admin/Invoice/ChangeStatus/' + id + '?status=' + status,
            type: 'get',
            success: function (data) {
                $.toast().reset('all');
                table.ajax.reload();
                Toset('تمت العملية بنجاح', 'success', '', 5000);
            }
        })
    }

    function profile(id) {
        window.open('/Admin/Invoice/view/'+id);
    }
</script>