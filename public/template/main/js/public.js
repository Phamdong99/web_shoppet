$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//load sản phẩm
function loadMore()
{
    const page = $('#page').val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        data: { page },
        url: '/services/load-product',
        success : function (result){
            if(result.html !== ''){
                //append result vào chỗ sản phẩm
                $('#loadProduct').append(result.html);
                //tăng page lên
                $('#page').val(page +1);
            }
            else {
                alert('Đã load xong sản phẩm');
                $('#button-loadMore').css('display', 'none');
            }
        }
    })
}
//check số lượng sp

$(document).ready(function () {

    $(".num-product").on('change', function (e) {
        var max = $(this).attr('data-product-max');
        var input_product = e.target.value;
        if (parseInt(input_product) > parseInt(max)){
            alert('Vượt quá tồn kho');
            $(this).val(max);
        }
    })
    //parent() lấy ra phần tử đứng trc của phần tử hiện tại
    //parseInt() chuyển đổi kiểu string về int
    //find(): Giúp tìm thành phần trong thành phần cha.
    // attr() : ta đã lấy được giá trị thuộc tính href của thẻ a.
    $(".btn-num-product-up").on('click', function (e){
        var max = $(this).parent().find("input").attr('data-product-max');
        var input_product = $(this).parent().find("input").val();
        if (parseInt(input_product) > parseInt(max)){
            alert('Vượt quá tồn kho');
            $(this).parent().find("input").val(max);
        }
    })
})

//thanh toán
$("#check_all").change(function (){
    if(this.checked)
    {
         $("#table_product input").each(function (){
            $(this).attr("checked",true)
         })
    }else {
        $("#table_product input").each(function (){
            $(this).attr("checked",false)
        })
    }
})
$("#check_out").click(function (){
    let id_product = [];
    $("#table_product >tbody input:checked").each(function (){
        id_product.push($(this).val());
    })

    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        data: {
            id_product: id_product
        },
        url: '/check-out',
        success : function (result){
            if(result){
                window.location.href = "/checkout";
            }else {
                alert('Sai');
            }

        },
        error: function() {
            //
        }
    })
})
//update Active

function updateActive(id, url)
{
    if(confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')){
        $.ajax({
            type: 'POST',
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
                    alert('Hủy bị lỗi vui lòng thử lại');
                }
            },
            error: function (error) {
                console.log(error)
            }

        })
    }
}

