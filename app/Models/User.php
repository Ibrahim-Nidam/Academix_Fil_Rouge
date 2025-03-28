<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'gender',
        'role',
        'status',
        'created_at',
        'updated_at',
        'date_of_birth',
        'additional_email',
        'profile_image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function($model){
            if(empty($model->id)){
                $model->id = (string) Str::orderedUuid();
            }
        });
    }

    public static function generateUsername ($firstname, $lastname)
    {
        $cleanFirstName = preg_replace('/[^a-zA-Z0-9]/', '', $firstname);
        $cleanLastName = preg_replace('/[^a-zA-Z0-9]/', '', $lastname);
        $username = strtolower($cleanFirstName) . ucfirst(strtolower($cleanLastName));
        
        return $username;
    }

    public static function generateEmail($firstname, $lastname){
        $cleanFirstName = preg_replace('/[^a-zA-Z0-9]/', '', $firstname);
        $cleanLastName = preg_replace('/[^a-zA-Z0-9]/', '', $lastname);

        return strtolower($cleanFirstName . '.' . $cleanLastName) . '@school.com';
    }

    public static function createBulkUsers($usersData, $roleType)
    {
        $createdUsers = [];
        $errors = [];

        foreach ($usersData as $userData) {
            try {
                if (empty($userData['username'])) {
                    $userData['username'] = self::generateUsername(
                        $userData['first_name'],
                        $userData['last_name']
                    );
                }

                $userData['email'] = self::generateEmail(
                    $userData['first_name'],
                    $userData['last_name']
                );

                $userData['password'] = bcrypt($userData['username']);
                $userData['role'] = $roleType;

                $user = self::create($userData);
                $createdUsers[] = $user;

            } catch (Exception $e) {
                $errors[] = [
                    'user' => $userData,
                    'error' => $e->getMessage()
                ];
            }
        }

        return [
            'created' => $createdUsers,
            'errors' => $errors
        ];
    }
}
