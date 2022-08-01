$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// delete
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

// upload

$('#upload').change(function (){
    //khởi tạo form
    const form = new FormData();
    var ins = document.getElementById('upload').files.length;
    for (var x = 0; x < ins; x++) {
        form.append("file[]", document.getElementById('upload').files[x]);
    }
    //append
    // form.append('file[]',$(this)[0].files[0]);
    console.log(form.getAll('file[]'))
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        datatype: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            Accept : 'Application/json'
        },
        data: form,
        url: '/admin/upload/services',
        success: function (result){
            if(result.error === false){
                $('#image_show').html('<a href="'+ result.url +'" target="_blank">' +
                    '<img src="'+ result.url +'" width="100px"></a>')

                $('#file').val(result.url);
            }else {
                alert('Upload file lỗi');
            }
        },
        error: function (error) {
        console.log(error)
        }
    })
})
