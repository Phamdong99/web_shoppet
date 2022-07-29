$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url)
{
    if(confirm('Bạn có chắc chắn muốn xoá mục này?')){
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { id },
            url: url,
            success: function (result){

                if(result.error == false){
                    alert(result.message);
                    location.reload();
                }else {
                    alert('xoá bị lỗi vui lòng thử lại');
                }
            },
            error: function (error) {
                console.log(error)
            }

        })
    }
}

