<?php
$data = array();

// Đường dẫn thư mục tương đối trên server
$uploadDir = 'upload/';

// Tiền tố công khai (URL) để CKEditor chèn vào src
$publicPrefix = '/PTIT_SHOP/quantri/' . $uploadDir;

if (isset($_FILES['upload']['name'])) {
    $file_name      = $_FILES['upload']['name'];
    $file_tmp       = $_FILES['upload']['tmp_name'];
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Chỉ cho phép jpg|jpeg|png
    if (in_array($file_extension, ['jpg','jpeg','png'])) {
        // Tạo đường dẫn lưu server
        $file_path = $uploadDir . $file_name;

        if (move_uploaded_file($file_tmp, $file_path)) {
            $data['file']     = $file_name;
            // Trả về URL có thêm tiền tố /PTIT_SHOP/quantri/upload/...
            $data['url']      = $publicPrefix . $file_name;
            $data['uploaded'] = 1;
        } else {
            $data['uploaded']         = 0;
            $data['error']['message'] = 'Error! File not uploaded';
        }
    } else {
        $data['uploaded']         = 0;
        $data['error']['message'] = 'Error! Invalid file extension';
    }
} else {
    $data['uploaded']         = 0;
    $data['error']['message'] = 'Error! File not received';
}

echo json_encode($data);

?>
