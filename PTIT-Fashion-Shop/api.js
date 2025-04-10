const API_KEY = "AK_CS.3151e0e00ee311f097089522635f3f80.k5z2MThu2xCIbyhiVnKDibyo6AH9sVJMC4pyEm1LFtn5mIPE168AdTjxmsLsA2wclH6QPqle";
const API_GET_PAID = "https://oauth.casso.vn/v2/transactions";

async function checkPaid() {
  try {
    const response = await fetch(`${API_GET_PAID}?sort=DESC&pageSize=10&page=1`, {
      method: 'GET',
      headers: {
        Authorization: `Apikey ${API_KEY}`,
        'Content-Type': 'application/json'
      }
    });

    if (!response.ok) {
      throw new Error(`Lỗi server: ${response.status} ${response.statusText}`);
    }

    const data = await response.json();
    console.log('Các giao dịch mới nhất:', data);
    return data;

  } catch (error) {
    console.error('Lỗi khi gọi checkPaid:', error);
    return null;
  }
}

// setInterval(checkPaid, 15000); 
