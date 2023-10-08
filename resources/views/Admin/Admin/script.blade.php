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
            //"sInfo":  "عرض صفحة _PAGE_ من _PAGES_",
        },
        serverSide: true,

        order: [[0, 'desc']],

        buttons: ['copy', 'excel', 'pdf'],

        ajax: "{{ route('Admin.allData')}}",

        columns: [
            {data: 'checkBox', name: 'checkBox'},
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'roleType', name: 'roleType'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#formSubmit').submit(function (e) {
        e.preventDefault();
        saveOrUpdate( save_method == 'add' ?"{{ route('Admin.create') }}" : "{{ route('Admin.update') }}");
    });


    function editFunction(id) {

        save_method = 'edit';

        $('#err').slideUp(200);

        $('#loadEdit_' + id).css({'display': ''});

        $.ajax({
            url: "/Admin/Admin/edit/" + id,
            type: "GET",
            dataType: "JSON",

            success: function (data) {

                $('#loadEdit_' + id).css({'display': 'none'});

                $('#save').text('{{trans('basic.edit')}}');

                $('#titleOfModel').text('{{trans('basic.edit')}}');

                $('#formSubmit')[0].reset();

                $('#formModel').modal(); 
                
                if(data.contract_type == 'on_bail'){
                    $('#on_bail').css('display','block');
                    $('#subcontractor').css('display','none');
                }else if(data.contract_type == 'subcontractor'){
                    $('#on_bail').css('display','none');
                    $('#subcontractor').css('display','block');
                }

                if(data.contract_by == 'external'){
                    $('#contact_dates').css('display','block'); 
                }else if(data.contract_by == 'ajir'){
                    $('#contact_dates').css('display','none'); 
                }

                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#phone').val(data.phone); 
                $('#nationality').val(data.nationality);
                $('#id_number').val(data.id_number);
                $('#job').val(data.job);
                $('#administration').val(data.administration); 
                $('#roleType').val(data.roleType);

                $('#contract_type').val(data.contract_type);
                $('#job_num').val(data.job_num);
                $('#company_name').val(data.company_name);
                $('#company_field').val(data.company_field);
                $('#commerical_num').val(data.commerical_num);
                $('#manager_name').val(data.manager_name);
                $('#manager_phone').val(data.manager_phone);
                $('#manager_email').val(data.manager_email);
                $('#company_address').val(data.company_address);
                $('#company_website').val(data.company_website);
                $('#contract_by').val(data.contract_by);
                $('#contract_start').val(data.contract_start);
                $('#contract_end').val(data.contract_end);
                $('#commissioner_name').val(data.commissioner_name);
                $('#commissioner_nationality').val(data.commissioner_nationality);
                $('#commissioner_id_number').val(data.commissioner_id_number);
                $('#commissioner_id_start').val(data.commissioner_id_start);
                $('#commissioner_id_end').val(data.commissioner_id_end);
                $('#commissioner_job').val(data.commissioner_job);
                $('#commissioner_phone').val(data.commissioner_phone);
                $('#commissioner_email').val(data.commissioner_email);

                $('#id').val(data.id);
            }
        });
    }


    function deleteFunction(id,type) {
        if (type == 2 && checkArray.length == 0) {
            alert('no items marked to be deleted  ');
        } else if (type == 1){
            url =  "/Admin/Admin/destroy/" + id;
            deleteProccess(url);
        }else{
            url= "/Admin/Admin/destroy/" + checkArray + '?type=2';
            deleteProccess(url);
            checkArray=[];
        }
    }

    $('#contract_type').on('change',function(){
        if(this.value == 'on_bail'){
            $('#on_bail').css('display','block');
            $('#subcontractor').css('display','none');
        }else if(this.value == 'subcontractor'){
            $('#on_bail').css('display','none');
            $('#subcontractor').css('display','block');
        }
    });

    $('#contract_by').on('change',function(){
        if(this.value == 'external'){
            $('#contact_dates').css('display','block'); 
        }else if(this.value == 'ajir'){
            $('#contact_dates').css('display','none'); 
        }
    });

</script>
