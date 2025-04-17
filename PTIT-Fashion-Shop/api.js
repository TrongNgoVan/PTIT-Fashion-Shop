const API_KEY = 'AIzaSyBmatT_dCNt9YEZGBAeEOEW1oVg-VyBhLE';
const SHEET_ID = '1AD_51pU_72TuEDkgaezQGaNNglbPuxNhtFJsw-0LCDM';
const RANGE = 'Trang tính1!A2:H'; // Bắt đầu từ hàng 2, bỏ hàng tiêu đề

async function checkPaidFromSheet() {
  try {
    const url = `https://sheets.googleapis.com/v4/spreadsheets/${SHEET_ID}/values/${RANGE}?key=${API_KEY}`;
    const response = await fetch(url);

    if (!response.ok) {
      throw new Error(`Lỗi khi lấy sheet: ${response.status} ${response.statusText}`);
    }

    const data = await response.json();
    const rows = data.values || [];

    // Chuyển từng dòng thành object
    const structuredData = rows.map(row => ({
      bank: row[0] || '',        // Tên ngân hàng
      date: row[1] || '',        // Ngày giờ
      stk: row[2] || '',         // Số tài khoản
      stk_phu: row[3] || '',     // Số tài khoản phụ
      code: row[4] || '',        // Mã giao dịch
      content: row[5] || '',     // Nội dung
      type: row[6] || '',        // Loại giao dịch (in/out)
      amount: parseFloat(row[7]?.replace(/[^0-9.-]+/g, '') || 0) // Số tiền
    }));

    return structuredData;

  } catch (error) {
    console.error('Lỗi khi gọi checkPaidFromSheet:', error);
    return [];
  }
}


checkPaidFromSheet().then(data => console.log(data));


