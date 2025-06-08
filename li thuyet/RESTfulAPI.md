## RESTful API

**RESTful API (Representational State Transfer):** là chuẩn thiết kế dùng để giao tiếp giữa những ứng dụng webtite với những ứng dụng khác (website, mobile app, ...)

RESTful API sử dụng các phương thức của giao thức HTTP (GET, POST, PUT, PATCH, DELETE, ...) để trao đổi với các tài nguyên trên máy chủ

Dữ liệu truyền tải qua lại giữa các API là JSON, XML

Các HTTP method:
1. GET: Xem chi tiết tài nguyên, lấy danh sách tài nguyên
2. POST: Thêm một tài nguyên mới
3. PUT/PATCH: Cập nhật một tài nguyên đã có trên server
4. DELETE: Xóa một tài nguyên đã có trên server

(Kiểu giao tiếp khác: Graph API)

## JSON
Ví dụ: 
```json
{
  "product": {
    "id": 123,
    "name": "Điện thoại XYZ",
    "price": 299.99,
    "currency": "USD",
    "description": "Điện thoại thông minh XYZ với màn hình 6.5 inch và camera 12MP.",
    "category": "Điện thoại và phụ kiện",
    "brand": "XYZ Corp",
    "stock": 150,
    "images": [
      {
        "url": "https://example.com/images/product1_1.jpg",
        "alt": "Mặt trước của điện thoại XYZ"
      },
      {
        "url": "https://example.com/images/product1_2.jpg",
        "alt": "Mặt sau của điện thoại XYZ"
      }
    ],
    "specifications": {
      "screen_size": "6.5 inch",
      "camera": "12MP",
      "battery": "4000mAh"
    },
    "ratings": {
      "average": 4.5,
      "count": 128
    }
  }
}
```


## Status code
Mã trạng thái HTTP có ý nghĩa rất quan trọng khi làm việc với API. Nó cho người dùng biết trạng thái của request từ đó đưa ra các hành động hợp lý

**2xx: Thành công (Yêu cầu thành công.)**
- 200 OK: Yêu cầu đã thành công, máy chủ đã trả về dữ liệu, hoặc xác nhận sự thay đổi đã thành công (POST, PUT, PATCH)
- 201 Created: Yêu cầu thêm mới một tài nguyên đã thành công (thường được dùng với POST)
- 202 Accepted: Yêu cầu đã được chấp nhận để xử lý, nhưng chưa hoàn tất
- 204 No Content: Yêu cầu xử lý đã thành công nhưng không có nội dung trả về (thường được xử dụng với yêu cầu DELETE)


**3xx: Chuyển hướng (Chuyển hướng yêu cầu đến một URL khác.)**
- 301 Moved Permanently: Tài nguyên đã bị di chuyển vĩnh viễn đến một URL khác. Các yêu cầu tiếp theo nên được gửi đến URL mới.
- 302 Found: Tài nguyên hiện tại đã được di chuyển tạm thời đến một URL khác.
- 304 Not Modified: Tài nguyên chưa thay đổi kể từ lần yêu cầu trước đó. Thường được sử dụng với các yêu cầu conditional GET để cải thiện hiệu suất.

**4xx: Lỗi Client (Lỗi từ phía client, thường là lỗi của người dùng hoặc vấn đề về dữ liệu.)**
- 400 Bad Request: Yêu cầu không hợp lệ hoặc thiếu thông tin cần thiết.
- 401 Unauthorized: Yêu cầu xác thực nhưng không có thông tin xác thực hợp lệ hoặc không có quyền truy cập.
- 403 Forbidden: Máy chủ hiểu yêu cầu nhưng từ chối thực hiện. Người dùng không có quyền truy cập tài nguyên.
- 404 Not Found: Tài nguyên yêu cầu không được tìm thấy trên máy chủ.
- 405 Method Not Allowed: Phương thức HTTP được sử dụng không được hỗ trợ cho tài nguyên yêu cầu.
- 409 Conflict: Xung đột xảy ra khi xử lý yêu cầu. Thường được sử dụng khi có xung đột với trạng thái hiện tại của tài nguyên.

**5xx: Lỗi server (Lỗi từ phía server, thường là vấn đề với máy chủ hoặc cấu hình.)**
- 500 Internal Server Error: Máy chủ gặp phải lỗi không xác định và không thể hoàn thành yêu cầu.
- 501 Not Implemented: Máy chủ không hỗ trợ chức năng cần thiết để thực hiện yêu cầu
- 502 Bad Gateway: Máy chủ nhận được phản hồi không hợp lệ từ máy chủ phía sau.
- 503 Service Unavailable: Máy chủ hiện tại không có sẵn để xử lý yêu cầu, thường do quá tải hoặc bảo trì.
- 504 Gateway Timeout: Máy chủ không nhận được phản hồi kịp thời từ máy chủ phía sau.

## Viết API cơ bản (bài tập)
Sử dụng Postman để check API hoặc một phần mềm bên thứ 3
1. Viết API trả lại danh sách product
2. Viết API trả lại thông tin 1 product nhất định
3. Viết API thêm mới một product
4. Viết API cập nhật một product
5. Viết API xóa một product
6. Viết API login trả lại token 
```cmd
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
"config/auth.php" 
    'api' => [
        'driver' => 'sanctum',
        'provider' => 'users',
    ],
"Kernel.php => $middlewareGroups"
\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class
```

7. Bảo vệ tất cả API CRUD product bằng token 