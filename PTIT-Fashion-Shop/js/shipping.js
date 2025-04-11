function updateShippingFee() {
    // Lấy giá trị hiện tại của địa chỉ và phương thức
    const address = $('input[name="address"]').val();
    const shippingMethod = $('#shipping_method').val();
    
    // Tách tỉnh từ địa chỉ
    const province = address.split(',').pop().trim();
    
    // Tính phí cơ bản
    let baseFee = 0;
    if (province === 'Hà Nội') {
        baseFee = 15000;
    } else if (province === 'Thanh Hóa') {
        baseFee = 25000;
    } else if (province === 'Nam Định') {
        baseFee = 20000;
    } else {
        baseFee = 30000; // Mặc định
    }
    
    // Tính phí hỏa tốc
    if (shippingMethod === 'Nhận tại cửa hàng') {
        baseFee = 0;
    }
    if (shippingMethod === 'Vận Chuyển Hỏa Tốc') {
        baseFee += 10000;
    }
    
    // Cập nhật DOM
    $('#shippingFee').text(formatCurrency(baseFee));
    
    // Tính toán tổng cuối
    const orderTotal = parseFloat($('#orderTotal').data('amount'));
    const discount = parseFloat($('#discountAmountInput').val()) || 0;
    const finalTotal = orderTotal - discount + baseFee;
    
    $('#finalTotal').text(formatCurrency(finalTotal));
}

// Gọi hàm update khi có bất kỳ thay đổi nào
$(document).ready(function() {
    // Chạy lần đầu
    updateShippingFee();
    
    // Theo dõi mọi thay đổi
    $('#shipping_method, input[name="address"]').on('change input', updateShippingFee);
    
    // Thêm trigger khi chọn địa chỉ từ modal
    $(document).on('click', '.btn-select-address', function() {
        setTimeout(updateShippingFee, 100); // Trigger sau 100ms để đảm bảo DOM đã cập nhật
    });
});

// Hàm định dạng tiền
function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', { 
        style: 'currency', 
        currency: 'VND' 
    }).format(amount);
}