// Hàm lấy phí ship dựa trên address và radio đang checked
function updateShippingFee() {
    // 1. Lấy giá trị
    const address = $('input[name="address"]').val() || '';
    const shippingMethod = $('input[name="shipping_method"]:checked').val();
    const discountAmount  = parseFloat($('#discountAmountInput').val()) || 0;
  
    // 2. Tách tỉnh từ cuối address
    const parts   = address.split(',');
    const province = parts.length ? parts[parts.length - 1].trim() : '';
  
    // 3. Tính phí cơ bản theo tỉnh
    let baseFee = 0;
    switch (province) {
      case 'Thành phố Hà Nội':   baseFee =   15000; break;
      case 'Tỉnh Thanh Hóa':      baseFee =   25000; break;
      case 'Tỉnh Nam Định':       baseFee =   20000; break;
      default:                    baseFee =   30000; break;
    }
  
    // 4. Điều chỉnh nếu là phương thức khác
    if (shippingMethod === 'Nhận tại cửa hàng') {
      baseFee = 0;
    } else if (shippingMethod === 'Vận Chuyển Hỏa Tốc') {
      baseFee += 10000;
    }
    // (Nếu có thêm phương thức mới, thêm case ở đây)
  
    // 5. Cập nhật lên giao diện
    $('#shippingFee').text(formatCurrency(baseFee));
    $('#shippingFeeInput').val(baseFee);         // hidden input
  
    // 6. Tính tổng cuối và update
    const orderTotal = parseFloat($('#orderTotal').data('amount')) || 0;
    const finalTotal = orderTotal + baseFee - discountAmount;
  
    $('#finalTotal').text(formatCurrency(finalTotal));
    $('#finalTotalInput').val(finalTotal);
  }
  
  // Khởi chạy và lắng nghe thay đổi
  $(document).ready(function() {
    updateShippingFee();
  
    // Khi user chọn radio mới
    $('input[name="shipping_method"]').on('change', updateShippingFee);
  
    // Khi user chỉnh address hoặc mã giảm giá
    $('input[name="address"], #discountAmountInput').on('change input', updateShippingFee);
  
    // Nếu bạn có nút chọn address từ modal
    $(document).on('click', '.btn-select-address', function() {
      setTimeout(updateShippingFee, 100);
    });
  });
  
  // Định dạng tiền VND
  function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN',{
      style: 'currency',
      currency: 'VND'
    }).format(amount);
  }
  