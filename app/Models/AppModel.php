<?php
// app/Models/AppModel.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppModel extends Model
{
    use HasFactory;

    protected $table = 'wins'; // Table name

    protected $fillable = [
        'description',
        'is_win',
        'risk',
        'risk_reward_ratio',
        'hour_session',
        'user_id', // Add user_id to fillable
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class); // A win belongs to a user
    }
}
