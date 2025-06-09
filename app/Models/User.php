<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'address', 'phone'];

    // Ẩn password và token khỏi kết quả trả về
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Tự động mã hóa password khi gán
    public function setPasswordAttribute($password)
    {
        // Nếu password đã được mã hóa thì không mã hóa lại
        if (\Illuminate\Support\Facades\Hash::needsRehash($password)) {
            $this->attributes['password'] = bcrypt($password);
        } else {
            $this->attributes['password'] = $password;
        }
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
