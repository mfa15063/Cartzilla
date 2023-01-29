<?php
    use App\Models\Setting;
    if(!function_exists('getSetting')){
        function getSetting($key){
            $set = Setting::whereSettingKey($key)->first();
            return $set != null ? $set->setting_value : '';
        }
    }
    /**
     * Update Env file
     * @param array $data
     */

    if (!function_exists('update_env')) {
        function update_env( $data = [] ) : void
        {
            $path = base_path('.env');
            if (file_exists($path)) {
                foreach ($data as $key => $value) {
                    file_put_contents($path, str_replace(
                        $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
                    ));
                }
            }
        }
    }
?>
