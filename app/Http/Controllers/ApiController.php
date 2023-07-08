<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class ApiController extends Controller
{
    //
    public function getDataFromApi()
    {
        $url = "https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=1"; // Đường dẫn API của bạn

        $client = new Client();
        $response = $client->request('GET', $url);

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            $movie = $data['items'];
            // Xử lý dữ liệu theo nhu cầu của bạn
            // Ví dụ: in ra tên của các phần tử trong danh sách
            foreach ($movie as $key => $movi) {
                echo $movi['name'];
            }
        } else {
            echo "Lỗi trong quá trình gửi yêu cầu: " . $response->getStatusCode();
        }
    }
}
