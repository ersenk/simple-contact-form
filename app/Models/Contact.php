<?php

namespace App\Models;

use App\Notifications\YouHaveNewContactFormEmailNotification;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Notification;

class Contact extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'contacts';

    protected $dates = [
        'meeting_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const NUMBER_OF_BEDROOMS_SELECT = [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '6' => '5+',
    ];

    public const BUDGET_SELECT = [
        '1' => '0-  200 pound',
        '2' => '200 - 350 pound',
        '3' => '350 - 500 pound',
        '4' => '500 - 750 pound',
        '5' => '750+ pound',
    ];

    protected $fillable = [
        'responsible_user_id',
        'first_name',
        'last_name',
        'country_id',
        'phone',
        'meeting_date',
        'budget',
        'number_of_bedrooms',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function boot()
    {
        parent::boot();
        self::observe(new \App\Observers\ContactActionObserver);

    }

    public function contactSendEmails()
    {
        return $this->hasMany(SendEmail::class, 'contact_id', 'id');
    }

    public function responsible_user()
    {
        return $this->belongsTo(User::class, 'responsible_user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function getMeetingDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setMeetingDateAttribute($value)
    {
        $this->attributes['meeting_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
