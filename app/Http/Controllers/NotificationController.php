<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Activitylog\Models\Activity;

class NotificationController extends Controller
{
    public function index(Request $request, $channel = "web")
    {
        // $data = $this->activityMapper(Activity::where('seen', 0)->latest()->take(40)->get());
        $data = $this->activityMapper(Activity::where('seen', 0)->latest()->get());
        if ($channel === 'api') {
            return ApiResponseController::successWithJustData($data);
        }

        return $data;
    }


    public function activitySeen(Request $request, $channel = "web")
    {
        $validator = Validator::make($request->all(), [
            'notification_id' => 'required',
        ]);


        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }


        $activity = Activity::findOrFail($request->notification_id);
        $activity->seen = 1;
        $activity->save();
        if ($channel == "api") {
            return ApiResponseController::success("Notification seen");
        }
        return true;
    }


    public function activityMapper($activities)
    {

        return $activities->map(function ($activity) {
            $causer = $activity->causer;
            $changes = $activity->changes;

            if (method_exists($activity->subject_type, "getRouteName")) {
                $url = route($activity->subject_type::getRouteName(), $activity->subject_id);
            } else {
                $url = "";
            }
            if ($changes->count() > 0) {
                if ($changes->has('attributes')) {
                    $changes = collect($changes['attributes'])->map(function ($newValue, $attribute) use ($changes) {
                        if ($attribute === 'updated_at') {
                            return null; // Skip the 'updated_at' attribute
                        }
                        if ($attribute === 'actions') {
                            return "Some <strong>{$attribute}</strong> were changed <br>";
                        }
                        if ($attribute === 'persons') {
                            return "Some <strong>{$attribute}</strong> were changed <br>";
                        }
                        if ($attribute === 'loss_calculation') {
                            return "Some <strong>{$attribute}</strong> were changed <br>";
                        }

                        // if action is update
                        if ($changes->has('old')) {
                            $oldValue = $changes['old'][$attribute];
                            if (is_array($oldValue)) {
                                return "Some <strong>{$attribute}</strong> were changed</strong>" . "<br>";
                            }
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