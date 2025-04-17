function updateShippingFee() {
    // Lấy giá trị hiện tại của địa chỉ, phương thức và mã giảm giá
    const address = $('input[name="address"]').val();
    const shippingMethod = $('#shipping_method').val();
    const discountAmount = parseFloat($('#discountAmountInput').val()) || 0;

    // Tách tỉnh từ địa chỉ
    const province = address.split(',').pop().trim();
    
    // Tính phí cơ bản
    let baseFee = 0;
    
    if (province === 'Thành phố Hà Nội') {
        baseFee = 15000;
    } else if (province === 'Tỉnh Thanh Hóa') {
        baseFee = 25000;
    } else if (province === 'Tỉnh Nam Định') {
        baseFee = 20000;
    } else {
        baseFee = 30000; // Mặc định
    }
    
    // Tính phí hỏa tốc
    if (shippingMethod === 'Nhận tại cửa hàng') {
        baseFee = 0;
    } else if (shippingMethod === 'Vận Chuyển Hỏa Tốc') {
        baseFee += 10000;
    }
    
    // Cập nhật DOM
    $('#shippingFee').text(formatCurrency(baseFee));
    
    // Tính toán tổng cuối
    const orderTotal = parseFloat($('#orderTotal').data('amount'));
    const finalTotal = orderTotal - discountAmount + baseFee;
    
    $('#finalTotal').text(formatCurrency(finalTotal));
}

// Gọi hàm update khi có bất kỳ thay đổi nào
$(document).ready(function() {
    // Chạy lần đầu
    updateShippingFee();
    
    // Theo dõi các sự kiện
    $('#shipping_method, input[name="address"]').on('change input', updateShippingFee);
    
    // Thêm sự kiện cho mã giảm giá
    $('#discountAmountInput').on('change', updateShippingFee);
    
    // Trigger khi chọn địa chỉ từ modal
    $(document).on('click', '.btn-select-address', function() {
        setTimeout(updateShippingFee, 100);
    });
});

// Hàm định dạng tiền
function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', { 
        style: 'currency', 
        currency: 'VND' 
    }).format(amount);
}