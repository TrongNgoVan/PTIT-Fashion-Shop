const API_KEY = "AK_CS.3151e0e00ee311f097089522635f3f80.k5z2MThu2xCIbyhiVnKDibyo6AH9sVJMC4pyEm1LFtn5mIPE168AdTjxmsLsA2wclH6QPqle"
const API_GET_PAID = "https://oauth.casso.vn/v2/transactions"
async function checkPaid() {
    try {
      const response = await fetch(API_GET_PAID, {
        method: 'GET',
        headers: {
          Authorization: `apikey ${API_KEY}`,
          'Content-Type': 'application/json'
        }
      });
  
      // Kiểm tra xem response có thành công hay không
      if (!response.ok) {
        throw new Error(`Lỗi server: ${response.status} ${response.statusText}`);
      }
  
      // Chuyển đổi dữ liệu phản hồi sang JSON
      const data = await response.json();
      console.log('hihi:', data);
      return data; 
  
    } catch (error) {
      console.error('Lỗi khi gọi checkPaid:', error);
      // Tuỳ theo logic của bạn, có thể trả về null hoặc throw error
      return null; 
    }
} 
// setInterval(checkPaid, 30000); // nếu không gọi hàm này mà chỉ để nó trong code thì nó mặc định 30 giây gọi 1 lần.

  