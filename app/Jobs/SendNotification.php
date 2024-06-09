<?php

namespace App\Jobs;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use App\Models\FirebaseNotifications;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $id = $this->data['id'];
        $message = $this->data['message'];
        $payload = $this->data['payload'];

        $title = getSettings()->app_name;
        $accesstoken = getSettings()->notification_key;

        $URL = 'https://fcm.googleapis.com/fcm/send';
        Notification::create(['notification' => $message, 'user_id' => $id]);

        $notification_status = get_row_by_id($id,'users','id');
        if(!empty($notification_status)) {
            if($notification_status->notification == '1'){
                // $array = get_array_by_column($id,'user_firebase','user_id');
                $array = DB::table('user_firebase')->where('user_id',$id)->groupBy('fcm_token')->get();

                foreach ($array as $key => $value) {

                    if($value->platform == 'ios') {
                        $fields = array (
                            'registration_ids' => array (
                                $value->fcm_token
                            ),
                            'notification' => array (
                                "title" => $title,
                                "body" => $message,
                                "sound" => "default",
                            ),'data' => ['data' => $payload]
                        );
                    } else {
                        $fields = array('registration_ids' => [$value->fcm_token],"priority" => "high",'data' => ['title' => $title,'body' => $message,'type' => 'android','nid' => time(),'data' => $payload]);
                    }
                    $post_data = '{
                        "to" : "' . $value->fcm_token . '",
                        "data" : {
                        "body" : "",
                        "title" : "' . $title . '",
                        "type" : "' . $value->platform . '",
                        "id" : "' . $id . '",
                        "message" : "' . $message . '",
                        },
                        "notification" : {
                            "body" : "' . $message . '",
                            "title" : "' . $title . '",
                            "type" : "' . $value->platform . '",
                            "id" : "' . $id . '",
                            "message" : "' . $message . '",
                            "icon" : "new",
                            "sound" : "default"
                        },
                    }';

                    $crl = curl_init();

                    $headr = array();
                    $headr[] = 'Content-type: application/json';
                    $headr[] = 'Authorization: key=' . $accesstoken;
                    curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);

                    curl_setopt($crl, CURLOPT_URL, $URL);
                    curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);

                    curl_setopt($crl, CURLOPT_POST, true);
                    curl_setopt($crl, CURLOPT_POSTFIELDS, json_encode($fields));
                    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

                    $rest = curl_exec($crl);
                }
            }
        }
    }
}
