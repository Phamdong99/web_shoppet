$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//load sản phẩm
function loadMore() {
    const page = $('#page').val();
    $.ajax({
        type: 'POST', dataType: 'JSON', data: {page}, url: '/services/load-product', success: function (result) {
            if (result.html !== '') {
                //append result vào chỗ sản phẩm
                $('#loadProduct').append(result.html);
                //tăng page lên
                $('#page').val(page + 1);
            } else {
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
        if (parseInt(input_product) > parseInt(max)) {
            alert('Vượt quá tồn kho');
            $(this).val(max);
        }
        if (parseInt(input_product) == 0) {
            alert('Số lượng đặt hàng tối thiểu là một sản phẩm');
            $(this).val(1);
        }
    })
    //parent() lấy ra phần tử đứng trc của phần tử hiện tại
    //parseInt() chuyển đổi kiểu string về int
    //find(): Giúp tìm thành phần trong thành phần cha.
    // attr() : ta đã lấy được giá trị thuộc tính href của thẻ a.
    $(".btn-num-product-up").on('click', function (e) {
        var max = $(this).parent().find("input").attr('data-product-max');
        var input_product = $(this).parent().find("input").val();
        if (parseInt(input_product) > parseInt(max)) {
            alert('Vượt quá tồn kho');
            $(this).parent().find("input").val(max);
        }
        if (parseInt(input_product) == 0) {
            alert('Số lượng đặt hàng tối thiểu là một sản phẩm');
            $(this).parent().find("input").val(1);
        }
    })
})

//thanh toán
// $("#check_all").change(function (){
//     if(this.checked)
//     {
//          $("#table_product input").each(function (){
//             $(this).attr("checked",true)
//          })
//     }else {
//         $("#table_product input").each(function (){
//             $(this).attr("checked",false)
//         })
//     }
// })
$("#check_out").click(function () {
    let arrProduct = [];
    //var id_size;
    $("#table_product input:checked").each(function () {
        let id_size = $(this).data('size');
        let id_product = $(this).val();
        if (arrProduct[id_product]) {
            arrProduct[id_product].push(id_size);
        } else {
            arrProduct[id_product] = [];
            arrProduct[id_product].push(id_size);
        }
    })

    $.ajax({

        type: 'POST',
        dataType: 'JSON',
        data: {
            arrProduct: arrProduct
        },
        url: '/check-out',
        success : function (result){
            if(result){
                window.location.href = "/checkout";
            }
            console.log(result)
        },
        error: function(error) {
            console.log(error)
        }
    })
})

//update Active

function updateActive(id, url) {
    if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')) {
        $.ajax({
            type: 'POST', datatype: 'JSON', data: {id}, url: url, success: function (result) {
                if (result.error == false) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert('Hủy bị lỗi vui lòng thử lại');
                }
            }, error: function (error) {
                console.log(error)
            }

        })
    }
}

function show_pro_detail(id_pro_detail, url) {
    $.ajax({
        type: 'POST', datatype: 'JSON', data: {id_pro_detail}, url: url, success: function (result) {

            return (result)
        }, error: function (error) {
            console.log(error)
        }

    })
}

//checkbox ptvc
$("input:radio").click(function () {
    var cost = ($(this).val());
    var total = $('#total').val();
    $.ajax({
        type: 'POST',
        datatype: 'JSON',
        data: {cost, total},
        url: '/transport/price',
        success: function (result) {
             // $('#price_transport').text(result[0]['price'] + " VND");
             $('#total_order').text(result['total'] + " VND");
            console.log(result)
        }, error: function (error) {
            console.log(error)
        }
    })
});

// MGG
$(document).ready(function () {
    $("#discount_id").on('change', function () {
        var id_discount = $(this).val()
        var total = $('#total').val();

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            data: {id_discount , total},
            url: '/discount/price', success: function (result) {
                console.log(result)
                // $("#discount").text(result[0]['discount'] + ' Vnd');
                $("#total_order").text(result + ' Vnd')
            }, error: function (error) {
                console.log(error)
            }
        })
    })
})
//size

$(document).ready(function () {

    $("#size_id").on('change', function (e) {
        // var pro_id =  e.target.getAttribute("data-product");
        var size_id = ($(this).val())

        $.ajax({
            type: 'POST', dataType: 'JSON', data: {size_id}, url: '/update_price_size', success: function (result) {
                $('#p-price').text(result[0]['price'] + " VND")
                console.log(result[0]['price']);
            }, error: function ($err) {
                console.log($err)
            }
        })
    })
})
//check trả hàng
$("#btn_return_good").click(function () {
    var id_order = $("#id_order").val()
    let id_product = [];
    $("#table_pro_return input:checked").each(function () {
        id_product.push($(this).val());
    })
    alert(id_product)
    $.ajax({
        type: 'POST', dataType: 'JSON', data: {
            id_product: id_product
        }, url: '/orders/return_goods/{id_order}', success: function (result) {
            console.log(result)
            if (result) {
                window.location.href = "/history";
            }
        }, error: function (error) {
            console.log(error)
        }
    })
})
