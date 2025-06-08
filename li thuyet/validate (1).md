## Validate trong laravel

**Validate trong laravel được sử dụng thông qua validate method của Request**

```php
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ]);
```

**Các rules mặc định của validate**
```text
    // Quy tắc chung
    'bail': Ngừng chạy các quy tắc validate sau lỗi đầu tiên (giảm số lượng thông báo lỗi trả về)
    'accepted': Phải là yes, on, 1, hoặc true.
    'active_url': Phải là một URL hợp lệ (một địa chỉ url còn hoạt động)
    'alpha': Chỉ cho phép ký tự chữ cái.
    'alpha_dash': Chỉ cho phép chữ cái, số, dấu gạch ngang và gạch dưới.
    'alpha_num': Chỉ cho phép chữ cái và số.
    'array': Phải là một mảng.
    'nullable': Trường có thể null

    // Quy tắc số và chuỗi
    'boolean': Phải là true hoặc false.
    'confirmed': Phải khớp với trường '*_confirmation'.
    'date': Phải là một ngày hợp lệ (YYYY-MM-DD|MM/DD/YYYY|DD-MM-YYYY)
    'date_format': Phải khớp với định dạng ngày. (date_format:Y-m-d)
    'different': Phải khác với trường xác định. (different:old_password)
    'digits': Phải có số chữ số xác định. (digits:6 => bắt buộc có 6 chữ số)
    'digits_between:min,max' :Phải có số chữ số nằm trong khoảng min và max. (digits_between:4,8)
    'distinct': Phải không chứa các giá trị trùng lặp.

    // Quy tắc email và URL
    'email': Phải là một địa chỉ email hợp lệ.
    'exists:table,column': Giá trị phải tồn tại trong bảng và cột xác định. (exists:users,email)
    'file': Phải là một tệp đã tải lên
    'image': Phải là một hình ảnh (jpeg, png, bmp, gif, svg, hoặc webp).
    'in:value': Phải là một trong các giá trị xác định. (in:pending,approved,rejected)
    'integer': Phải là số nguyên.
    'ip': Phải là một địa chỉ IP hợp lệ.
    'ipv4': Phải là một địa chỉ IPv4 hợp lệ.
    'ipv6': Phải là một địa chỉ IPv6 hợp lệ.

    // Quy tắc JSON và file
    'json': Phải là một chuỗi JSON hợp lệ.
    'max:value': Giá trị tối đa. (đối với chuỗi thì max là số ký tự tối đa)
    'mimes': Phải là tệp có một trong các loại MIME xác định. (mimes:pdf,doc,docx)
    'mimetypes': Phải là tệp có một trong các loại MIME xác định. (mimetypes:text/plain,image/jpeg,application/pdf)
    'min:value': Giá trị tối thiểu.
    'not_in:value': Không được là một trong các giá trị xác định. (not_in:banned,deleted)
    'numeric': Phải là số. (số nguyên, thập phân, số âm, số dương,...)
    'present': Phải có mặt, nhưng có thể rỗng (kiểm tra sự có mặt, nhưng không quan tâm đến giá trị dữ liệu)
    'regex:/pattern/': Phải khớp với biểu thức chính quy (regex:/^\(\d{3}\) \d{3}-\d{4}$/)
    'required': Bắt buộc phải có.
    'required_if:another_field,value': Bắt buộc phải có nếu trường khác có giá trị xác định (required_if:delivery_method,shipping)
    'required_unless:another_field,value': Bắt buộc phải có trừ khi trường khác có giá trị xác định ('required_unless:delivery_method,pickup')
    'required_with:other_field1,other_field2,...': Bắt buộc phải có khi có mặt bất kỳ trường nào trong số xác định.
    'required_without:other_field1,other_field2,...': Bắt buộc phải có khi không có mặt bất kỳ trường nào trong số xác định.
    'same:other_field': Phải khớp với trường xác định.
    'size:value': Phải có kích thước chính xác với giá trị xác định. (độ dài của chuổi | số phần tử mảng | kích thước tệp tin | )
    'starts_with:value1,value2,...': Phải bắt đầu bằng một trong các giá trị xác định. (starts_with:https://)
    'string': Phải là một chuỗi.
    'unique:table,column': Phải là duy nhất trong bảng và cột xác định (unique:users,username,id_exclude: id_exclude là có thể trùng với bản ghi này)
    'url': Phải là một URL hợp lệ (hợp lệ với 1 cấu trúc url thông thường)
    'uuid': Phải là một UUID hợp lệ (xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx - Universally Unique Identifier)
    'timezone': Phải là một múi giờ hợp lệ. (America/New_York, Europe/London, Asia/Tokyo, Asia/Ho_Chi_Minh,...)
```

## Request Class 
**Lợi ích của request class:**
```cmd
php artisan make:request StoreUserRequest
```

- Tách biệt Logic xác thực (validate)
- Tái sử dụng và kiểm soát logic xác thực tại nhiều nơi khác nhau
- Dễ dàng bảo trì
- Tăng cường khả năng mở rộng

**Cấu trúc của một Request class**
- authorize method: Xác định xem người dùng có quyền thực hiện yêu cầu này không.
```php
public function authorize()
{
    return true; // Để true nếu muốn tất cả người dùng có quyền thực hiện request
}
```

- rules method: Xác định quy tắc cho các request 
```php
public function rules()
{
    return [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ];
}
```

- messages method: Tùy chỉnh các thông điệp lỗi khi gửi về cho client
```php
public function messages()
{
    return [
        'name.required' => 'Tên là bắt buộc',
        'email.required' => 'Email là bắt buộc',
        'email.email' => 'Email không hợp lệ',
        'password.required' => 'Mật khẩu là bắt buộc',
        'password.confirmed' => 'Mật khẩu xác nhận không khớp',
    ];
}
```

## Bài tập
Bài 1: Tạo form đăng ký gồm: name, email, password, password_confirmation
    name: bắt buộc nhập, tối đa 100 ký tự
    email: bắt buộc nhập, là một email hợp lệ, không tồn tại trong bảng users
    password: bắt buộc, tối thiểu 8 ký tự, khớp với trường password_confirmation

Bài 2: Tạo form update hồ sơ người dùng gồm: email, age, avatar
    email: bắt buộc nhập, phải là định dạng email hợp lệ, không trùng với bất kỳ email nào khác trong bảng users
    age: Có thể trống, nếu có thì phải là số từ 18 đến 100
    avatar: Có thể trống, nếu có thì phải là một tệp hình ảnh (jpeg, png, jpg), không quá 2MB

Bài 3: Tạo form xác thực thông tin đặt hàng gồm: shipping_address, is_shipping_address_same
    shipping_address: Bắt buộc phải có nếu 'is_shipping_address_same' là true
    is_shipping_address_same: bắt buộc, có giá trị true hoặc false

Bài 4: Tạo form nhận phản hồi của người dùng: user_id, vote_star, feedback
    user_id: bắt buộc nhập, phải tồn tại ở trường id trong bảng users
    vote_star: bắt buộc nhập, là một số nguyên trong khoảng 1 đến 5
    feedback: bắt buộc nhập, có số ký tự không dưới 50 và không quá 500 ký tự

Bài 5: Tạo form đăng ký khóa học: name, birth_day, province, district
    name: bắt buộc nhập, số ký tự trong khoảng 5 đến không quá 20
    birth_day: bắt buộc nhập, phải là ngày tháng hợp lệ, có định dạng d/m/Y (ví dụ: 30/07/2024)
    province: là một chuỗi, không bắt buộc nhập
    district: là một chuỗi, bắt buộc phải nhập nếu province có giá trị

Bài 6: Thay đổi thông tin người dùng: username, phone_number
    username: bắt buộc, không được trùng với bất kỳ username nào đã có trong bảng users
    phone_number: có thể trống, nếu có thì phải là một số điện thoại hợp lệ (/^(\+?[\d\s\-()]{7,15})$/)