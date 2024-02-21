<?php

namespace App\Observers;

use App\Mail\ThankyouContactForm;
use App\Models\Contact;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\NewContactFormEmailNotification;
use App\Notifications\ThankYouEmailNotification;
//NewContactFormEmailNotification
use App\Notifications\YouHaveNewContactFormEmailNotification;
use Illuminate\Support\Facades\Notification;

class ContactActionObserver
{
    public function created(Contact $model)
    {
        try {
            $users = \App\Models\User::whereHas('roles', function ($q) {
                return $q->where('title', 'Admin');
            })->get();
            Notification::send($users, new NewContactFormEmailNotification($model));
            if($model->responsible_user){
                $users = \App\Models\User::where('id', $model->responsible_user)->get(); //only one record will be fetched
                Notification::send($users, new YouHaveNewContactFormEmailNotification($model));
            }
        } catch (\Throwable $e) {
            \Log::error('send contact created email error: '.$e);
        }
    }

    public function updated(Contact $model)
    {
        try {
            $data  = ['action' => 'updated', 'model_name' => 'Contact'];
            $users = \App\Models\User::whereHas('roles', function ($q) {
                return $q->where('title', 'Admin');
            })->get();
            Notification::send($users, new DataChangeEmailNotification($data));
            if($model->responsible_user_id){

                $users = \App\Models\User::where('id', $model->responsible_user_id)->get(); //only one record will be fetched
                Notification::send($users, new YouHaveNewContactFormEmailNotification($model));
            }
        } catch (\Throwable $e) {
            \Log::error('send contact updated email error: '.$e);
        }
    }
    public function deleting(Contact $model)
    {
        try {
            $data  = ['action' => 'deleted', 'model_name' => 'Contact'];
            $users = \App\Models\User::whereHas('roles', function ($q) {
                return $q->where('title', 'Admin');
            })->get();
            Notification::send($users, new DataChangeEmailNotification($data));
        } catch (\Throwable $e) {
            \Log::error('send contact deleted email error: '.$e);
        }
    }
}
