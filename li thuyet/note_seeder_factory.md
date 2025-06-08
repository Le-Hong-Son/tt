## Seeder

- Là công cụ giúp tạo, sửa, xóa dữ liệu trong datable một cách dễ dàng và hiệu quả
- Vị trí: database/seeders

### Lệnh tạo seeder mới

```cmd
php artisan make:seeder SeederNameFile
```

Trong hàm run của Seeder ta có thể viết các đoạn mã: chèn, sửa, xóa dữ liệu trên database (Builder or Eloquent)

### Chạy Seeder

```cmd
php artisan db:seed
php artisan db:seed --class=SeederNameClass
```

Lệnh 'php artisan db:seed' chỉ chạy file DatabaseSeeder (nếu muốn chạy các file khác ta phải call nó trong DatabaseSeeder)
Có thể sử dụng vòng lặp và các hàm random để tạo nhiều dữ liệu mẫu cho database

## Models

- Model là một lớp (class) đại diện cho các bảng trong database
- Nó giúp chúng ta truy vấn, chèn, sửa, xóa dữ liệu trên database
- Vị trí: app/Models
- Model trong laravel sửa dụng cấu trúc Eloquent ORM
- Câu lệnh Eloquent ORM về cơ bản giống QueryBuilder tuy nhiên sẽ có vài khác biệt

### Tạo Model

```cmd
php artisan make:model ModelFileName
```

### Kết nối table

```php
protected $table = 'users';
public $primaryKey = 'id'; // Mặc định là id nên không cần khai báo
public $incrementing = true; // Nếu primary không phải số thì đặt false
public $timestamps = true; // Nếu không muốn ghi created_at và updated_at thì đặt false
protected $attributes = [
    'name' => 'abc',
    'email' => 'abc@gmail.com'
]; // dữ liệu default khi insert | update
protected $fillable = [
    'id', 'name', 'email'
]; // Các cột được tương tác trong table
```

## Factory

- Factory là công cụ tạo fake data dựa trên Eloquent ORM, với sự trợ giúp đắc lực của thư viện faker
- Chú ý: Tên Factory luôn luôn trùng tên với Model
  (Nếu không cần chỉ rõ model kết nối, ví dụ `protected $model = User::class;`)
- Factory sẽ được gọi trong Seeder để tạo dữ liệu

```php
Model::factory()->count(10)->create(); // Khai báo trong Seeder
```

**Các dữ liệu của fake:**

**Thông tin cá nhân**

```text
name: Tên đầy đủ
firstName: Tên riêng,
lastName: Họ,
title: Mr., Mrs., Dr., ...
```

**Địa chỉ**

```text
address:Địa chỉ đầy đủ
streetAddress: Địa chỉ đường phố
city:Thành phố
state:Bang
postcode:Mã bưu chính
country:Quốc gia
latitude:Vĩ độ
longitude:Kinh độ
```

**Thông tin liên hệ**

```text
phoneNumber: Số điện thoại
email: Địa chỉ email
safeEmail: Địa chỉ email an toàn
freeEmail: Địa chỉ email miễn phí (gmail.com, yahoo.com, ...)
userName: Tên người dùng
domainName: Tên miền
```

**Ngày giờ**

```text
dateTime:  Ngày giờ ngẫu nhiên
date: Ngày ngẫu nhiên
time: Giờ ngẫu nhiên
```

**Văn bản và chuỗi ký tự**

```text
word: Từ ngẫu nhiên
words: Mảng từ ngẫu nhiên
sentence: Câu ngẫu nhiên
sentences: Mảng câu ngẫu nhiên
paragraph: Đoạn văn ngẫu nhiên
paragraphs: Mảng đoạn văn ngẫu nhiên
text: Văn bản ngẫu nhiên
```

**Internet**

```text
url: URL ngẫu nhiên
slug: Đường dẫn ngẫu nhiên
ipv4:  Địa chỉ IPv4
ipv6: Địa chỉ IPv6
macAddress:  Địa chỉ MAC
```

**Các loại dữ liệu khác**

```text
randomNumber: Số ngẫu nhiên
randomFloat: Số thực ngẫu nhiên
randomDigit: Chữ số ngẫu nhiên (0-9)
randomLetter: Chữ cái ngẫu nhiên
boolean: Giá trị boolean (true/false)
uuid:  UUID ngẫu nhiên
hexcolor: Màu hex ngẫu nhiên
rgbcolor: Màu RGB ngẫu nhiên
locale: Locale ngẫu nhiên (ví dụ: "en_US", "fr_FR", ...)
timezone: Múi giờ ngẫu nhiên
numberBetween: Nằm giữa khoảng
unique:Duy nhất
randomElement(['1', '2']): Fake cho enum
```

Lấy dữ liệu khóa ngoại:

```
Role::inRandomOrder()->first()->role_id ?? 1,
```
