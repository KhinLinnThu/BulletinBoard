$(function(e) {

    $('#select_all_id').click(function(){
        $('.checked_id').prop('checked',$(this).prop('checked'))
    });
    $('.checked_id').on('click', function() {
        if ($('.checked_id:checked').length == $('.checked_id').length) {
            $('#select_all_id').prop('checked', true);
        } else {
            $('#select_all_id').prop('checked', false);
        }
    });
    $('#deleteallrecord').click(function(e){
        e.preventDefault();
        var all_ids = [];
        $('input:checkbox[name=ids]:checked').each(function(){
            all_ids.push($(this).val());
        });
        $.ajax({
            url: "{{ route('user#delete') }}",
            type: "DELETE",
            data: {
                ids:all_ids,
                _token : "{{ csrf_token() }}"
            },
            success:function(response){
                $.each(all_ids,function(key,val){
                    $('#sid'+val).remove();
                })
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    });
});
