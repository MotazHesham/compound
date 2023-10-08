@include('Admin.includes.scripts.dataTableHelper')

<script type="text/javascript">

    $('#formSubmit').submit(function (e) {
        e.preventDefault();
        $("#save").attr("disabled", true);
        Toset('{{trans('basic.wait')}}','info','{{trans('basic.progress')}}',false);
        var formData = $('#formSubmit').serialize();
        $.ajax({
            url : '/Tenant/BookingParty/create',
            type: "get",
            data: formData,
            success : function(data){
                $("#save").attr("disabled", false);
                $.toast().reset('all');
                swal(data.message, {
                    icon: data.icon,
                });
                if(data.status == 1){
                    $('#formModel').modal('toggle');
                }
            },error :function(){
                $("#save").attr("disabled", false);
            }

        })

    });


</script>

<script>
    function bookParty(id) {
        save_method = 'add';

        $('#save').text('{{trans('basic.save')}}');

        $('#titleOfModel').text('book now');

        $('#formSubmit')[0].reset();

        $('#formModel').modal();
        $('#party_id').val(id);

    }
</script>
