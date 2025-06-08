## Mô hình MVC trong Laravel

Vị trí

- Model: app/models/
- Controllers: app/controllers
- View: resource/views
- Router web: routes/web.php

### 1. Routing (routes/web.php)

Cấu tạo của một route

- method (Get, Post, Put, Patch ,Delete)
- url ('/users', '/products', ...)
- function xử lý

```php
// Base use (Đường dẫn gốc)
// http://127.0.0.1:8000/
Route::get('/', function () {
    echo 'Trang chủ';
});

```

### 2. Controllers

Lệnh tạo Controller

```bash
# TenController phải tuân theo quy tắc PascalCase
php artisan make:controller TenController
```

Cấu hình router gọi sang function của controller để xử lý

Trong Router

```php
use App\Http\Controllers\ProductController;

Route::get('list-products', [ProductController::class, 'showProduct']);
```

Trong Controller

```php
namespace App\Http\Controllers;
class ProductController{
    public function showProduct(){
        echo "Show List Product";
    }
}
```

### 3. Gửi dữ liệu từ Router qua Controller

Cách 1: Slug

```php
use App\Http\Controllers\ProductController;
Route::get('get-product/{id}', [ProductController::class, 'findProduct']);
```

```php
namespace App\Http\Controllers;
class ProductController{
    public function findProduct($id){
        echo "Find Product following $id";
    }
}
```

Cách 2: Params

```php
use App\Http\Controllers\ProductController;
Route::get('update-product?id=4&name=iPhone', [ProductController::class, 'updateProduct']);
```

```php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class ProductController{
    public function findProduct(Request $req){
        echo "id $req->id";
        echo "name $req->name";
    }
}
```

### 4. Gọi view, truyền dữ liệu qua view từ Controller

Lệnh tạo view

```bash
# Lệnh này sẽ tạo file list-products.blade.php
php artisan make:view list-products
```

```php
// Router
use App\Http\Controllers\ProductController;

Route::get('list-products', [ProductController::class, 'showProduct']);
```

```php
// Controller
namespace App\Http\Controllers;
class ProductController{
    public function showProduct(){
        $products = [
            [
                'id' => 1,
                'name' => 'iPhone 14',
                'price' => 15000000
            ], [
                'id' => 2,
                'name' => 'iPhone 15',
                'price' => 30000000
            ]
        ];
        return view('list-products')->with([
            'products' => $products
        ]);
    }
}
```

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Products</title>
  </head>

  <body>
    <table>
      <thead>
        <tr>
          <th>STT</th>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $key => $product)
        <tr>
          <td>{{ $key + 1 }}</td>
          <td>{{ $product->id }}</td>
          <td>{{ $product->name }}</td>
          <td>{{ number_format($product->price, 2) }} $</td>
          <td>
            <a>View</a>
            <a>Edit</a>
            <a>Delete</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
```
