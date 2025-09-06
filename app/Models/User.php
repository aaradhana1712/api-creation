<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class User extends Authenticatable



{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Hash password automatically when setting
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Scope a query to only include verified users.
     */
    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    /**
     * Check if user is active (always true for basic users)
     */
    public function isActive()
    {
        return true; // All users are considered active in basic setup
    }

    /**
     * Check if email is verified
     */
    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Update last login timestamp (placeholder for future implementation)
     */
    public function updateLastLogin()
    {
        // Placeholder - could be implemented with a separate table or session tracking
        return true;
    }

    /**
     * Get user's full profile data
     */
    public function getProfileData()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'is_active' => $this->isActive(),
            'email_verified' => $this->hasVerifiedEmail(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Get user's basic data for responses
     */
    public function getBasicData()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Generate API token for user
     */
    public function generateToken($name = 'auth_token', $abilities = ['*'], $expiresAt = null)
    {
        if (!$expiresAt) {
            $expiresAt = now()->addDays(7); // Default 7 days
        }

        return $this->createToken($name, $abilities, $expiresAt)->plainTextToken;
    }

    /**
     * Revoke all tokens for user
     */
    public function revokeAllTokens()
    {
        $this->tokens()->delete();
    }

    /**
     * Search users by name or email
     */
    public static function search($query)
    {
        return self::where(function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('email', 'LIKE', "%{$query}%");
        });
    }

    /**
     * Get users registered in last N days
     */
    public static function recentUsers($days = 7)
    {
        return self::where('created_at', '>=', Carbon::now()->subDays($days));
    }

    /**
     * Get active users count
     */
    public static function getActiveUsersCount()
    {
        return self::active()->count();
    }

    /**
     * Boot method for model events
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-set email to lowercase
        static::creating(function ($user) {
            if ($user->email) {
                $user->email = strtolower(trim($user->email));
            }
        });

        // Clean up tokens when user is deleted
        static::deleting(function ($user) {
            $user->tokens()->delete();
        });
    }
}