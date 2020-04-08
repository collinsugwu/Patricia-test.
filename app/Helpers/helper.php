<?php


/**
 * @param $boolean
 * @param $code
 * @param string $message
 */
function abort_unless($boolean, $code, $message = '')
{
    if (!$boolean) {
        abort($code, $message);
    }
}

/**
 * @param $boolean
 * @param $code
 * @param string $message
 */
function abort_if($boolean, $code, $message = '')
{
    if ($boolean) {
        abort($code, $message);
    }
}


function setting($key, $default = null, $cast = null)
{
    try {
        if (is_array($key)) {
            foreach ($key as $s_key => $s_value) {
                \App\Models\Setting::set($s_key, $s_value);
            }
            return true;
        } else {
            $value = env($key);
            return $value ?: \App\Models\Setting::get($key, $default, $cast);
        }
    } catch (Exception $e) {
        return $default;
    }
}

/**
 * @return \Illuminate\Http\Request
 */
function request()
{
    return app('request');
}

function usernameRegex()
{
    return '/^\w+([.\-_]\w*)*$/';
}
