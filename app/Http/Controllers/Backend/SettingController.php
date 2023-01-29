<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use DOMDocument;
use File;
use Illuminate\Http\Request;
use App\Models\Setting;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use mysql_xdevapi\Exception;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Throwable;

class SettingController extends Controller
{
    public function website_settings()
    {
        //
        $settings = Setting::all();
        $data['main_menu_title'] = "Settings";
        $data['sub_menu_title'] = "Viewing current website settings";
        foreach($settings as $setting)
            $data[$setting->setting_key] = $setting;

        return view('backend.settings', $data);
    }

    public function website_settings_update(Request $request)
    {
        //
        $data = [];
        foreach ($request->all() as $key => $value) {
            if (in_array($key, ['files']) || in_array($key, ['_token']))
                continue;
            $setting = Setting::where(['setting_key' => $key])->first();
            if (empty($setting->id)) {
               $setting = new Setting;
            }
            if(trim($value) != ''){
                if($key == 'privacy_policy' || $key == 'terms_and_condition' || $key == 'return_policy'){
                    $value = $this->addSummerNote($value);
                }if($key == "paypal_mode"){
                    $data['PAYPAL_MODE'] = " PAYPAL_MODE=".$value;
                }if($key == "paypal_username"){
                    $data['PAYPAL_SANDBOX_API_USERNAME'] = " PAYPAL_SANDBOX_API_USERNAME=".$value;
                }if($key == "paypal_password"){
                    $data['PAYPAL_SANDBOX_API_PASSWORD'] = " PAYPAL_SANDBOX_API_PASSWORD=".$value;;
                }if($key == "paypal_secret"){
                    $data['PAYPAL_SANDBOX_API_SECRET'] = " PAYPAL_SANDBOX_API_SECRET=".$value;
                }if($key == "stripe_key"){
                    $data['STRIPE_KEY'] = " STRIPE_KEY=".$value;
                }if($key == "stripe_secret"){
                    $data['STRIPE_SECRET'] = " STRIPE_SECRET=".$value;
                }
                $setting->setting_key = $key;
                $setting->setting_name = ucfirst(str_replace("_" , " " , $key));
                $setting->setting_value = $value;
                $setting->save();
             }
        }
        $path = base_path()."/editor.py";
        $data['path']= base_path()."/.env";
        $process = new Process([
            'python3',
            $path ,
            $data['path'] ,
            $data['PAYPAL_MODE'] ,
            $data['PAYPAL_SANDBOX_API_USERNAME'] ,
            $data['PAYPAL_SANDBOX_API_PASSWORD'] ,
            $data['PAYPAL_SANDBOX_API_SECRET'],
            $data['STRIPE_KEY'],
            $data['STRIPE_SECRET']
        ]);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        return redirect()->back()->with('success', 'Settings saved successfully.');
    }

    public function addSummerNote($des){
        $dom = new DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($des, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $image_file = $dom->getElementsByTagName('img');
        if (!File::exists(public_path('uploads'))) {
            File::makeDirectory(public_path('uploads'));
        }
        foreach($image_file as $key => $image) {
            $data = $image->getAttribute('src');
            if (strpos($data, 'data') !== false) {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $img_data = base64_decode($data);
                $image_name = "/uploads/" . time() . $key . '.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $img_data);
                $image->removeAttribute('src');
                $image->setAttribute('src', $image_name);
            }
        }

        $des = $dom->saveHTML();
        return $des;
    }
    public function upload_image(Request $request){
        $file = $request->file('files');
        $extension = $file->extension();
        $image = Image::make($file)->stream($extension, 80);
        $fileName = time() . ".".$extension; // You can also get file extenssion here, I just don't need pngs

        Storage::put("public/blog/images/{$fileName}", $image);
        return response()->json([
        'uploaded' => 1,
        'fileName' => $fileName,
        'url'      => asset("public/blog/images/{$fileName}"), // You can also use Storage::url() here, but I needed the full url and not the path.
        ]);
    }
}
