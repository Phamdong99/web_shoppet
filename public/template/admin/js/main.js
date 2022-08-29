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

//add size add price
$(document).ready(function (){
    var max_fields = 10;
    var wrapper_size = $(".wrapper_size");
    var add_button = $(".add_field_button");

    var x = 1;
    $(add_button).click(function (e){
        e.preventDefault();//để ngăn trặn việc gửi nội dung trên form đến nơi xử lý khi nhấn vào button
        if(x < max_fields){
            x++
            $(wrapper_size).append('<tr>' +
                '<td width="70%">' +
                '<label>Nhập size :  </label>' +
                '<input type="text" name="size[]" placeholder="Nhập size cho sản phẩm"/>' +
                '<label>Nhập giá : </label>' +
                '<input type="number" name="price[]" placeholder="Nhập giá theo size"/> ' +
                '<label>Nhập số lượng : </label>' +
                '<input type="number" name="qty[]" placeholder="Nhập số lượng"/> ' +
                '</td> '+
                '<td width="10%"><span class="remove btn btn-danger" style="cursor:pointer;">Xóa</span></td></tr>')
        }
    });
    $(wrapper_size).on("click",".remove", function (e){
        e.preventDefault() ;
        //parents lấy thành phần cha của div để remove
        $(this).parents('tr').remove();
    });
});
