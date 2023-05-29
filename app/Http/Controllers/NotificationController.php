<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class NotificationController extends Controller
{
    public function index()
    {
        return $this->activityMapper(Activity::where('seen', 0)->latest()->get());
    }

    public function activitySeen(Request $request)
    {
        $activity = Activity::findOrFail($request->notification_id);
        $activity->seen = 1;
        $activity->save();
        return true;
    }


    public function activityMapper($activities)
    {

        return $activities->map(function ($activity) {
            $causer = $activity->causer;
            $changes = $activity->changes;
            $url = route($activity->subject_type::getRouteName(), $activity->subject_id);
            if ($changes->count() > 0) {
                if ($changes->has('attributes')) {
                    $changes = collect($changes['attributes'])->map(function ($newValue, $attribute) use ($changes) {
                        if ($attribute === 'updated_at') {
                            return null; // Skip the 'updated_at' attribute
                        }
                        if ($attribute === 'actions') {
                            return "Some <strong>{$attribute}</strong> were changed <br>";
                        }
                        if ($attribute === 'loss_calculation') {
                            return "Some <strong>{$attribute}</strong> were changed <br>";
                        }
                        // if action is update
                        if ($changes->has('old')) {
                            $oldValue = $changes['old'][$attribute];
                            return "The <strong>{$attribute}</strong> was changed from <strong>{$oldValue}</strong> to <strong>{$newValue}</strong>" . "<br>";
                        } else {
                            // if action is created
                            return "The <strong>{$attribute}</strong> were created to <strong>{$newValue}</strong>" . "<br>";
                        }
                    })->implode(' ');
                } else {
                    // if action is delete this is how we map
                    $url = "";
                    $changes = collect($changes['old'])->map(function ($oldValue, $attribute) {
                        if ($attribute === 'updated_at') {
                            return null; // Skip the 'updated_at' attribute
                        }
                        if ($attribute === 'actions') {
                            return "Some <strong>{$attribute}</strong> were changed <br>";
                        }
                        if ($attribute === 'loss_calculation') {
                            return "Some <strong>{$attribute}</strong> were changed <br>";
                        }

                        return "The <strong>{$attribute}</strong> was <strong>{$oldValue}</strong>" . "<br>";
                    })->filter()->implode(' ');
                }
            }
            return [
                'id' => $activity->id,
                'causer_id' => $activity->causer_id,
                'subject_id' => $activity->subject_id,
                'log_name' => $activity->log_name,
                'causer' => $causer->first_name,
                'causer_image' => ($causer->image != "") ? asset('images/profile/' . $causer->image) : asset('images/profile/User.ico'),
                'description' => $activity->description,
                'created_at' => $activity->created_at,
                'event' => $activity->event,
                'affects' => $changes,
                'url' => $url,

            ];
        });
    }
}