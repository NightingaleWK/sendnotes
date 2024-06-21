<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Octopy\Impersonate\Concerns\HasImpersonation;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasImpersonation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * @return string
     */
    public function getImpersonateDisplayText(): string
    {
        return $this->name;
    }

    /**
     * This following is useful for performing user searches through the interface,
     * You can use fields in relations freely using dot notation,
     * 
     * example: posts.title, department.name.   
     */
    public function getImpersonateSearchField(): array
    {
        return [
            'name', 'notes.title',
        ];
    }
}
