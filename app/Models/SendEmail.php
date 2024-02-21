<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SendEmail extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'send_emails';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'contact_id',
        'email_template_id',
        'title',
        'body',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function email_template()
    {
        return $this->belongsTo(EmailTemplate::class, 'email_template_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
