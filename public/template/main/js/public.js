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
                $('#loadProduct').append(result.html);
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
    $("#table_product input:checked").each(function (){
        alert($(this).val())
    })
})
