<?php

/*
 * load site controllers
 */
if (!function_exists('makeView')) {
    function makeView($controller, $view)
    {
        $ctr = explode('@', $controller, 2);

        require_once __DIR__.'/../app/Controllers/'.$ctr[0].'.php';

        $data = $d->{$ctr[1]}();
        // $data = $d::$ctr[1];

        $v = 'views/'.$view.'.twig';
        Timber::render($v, $data);
        exit;
    }
}

/*
 * helper function die and dump
 */
if (!function_exists('dd')) {
    function dd($data)
    {
        echo '<pre style="background-color: #252424; color: #33ff00; padding: 15px; font-size: 16px; line-height: 2; overflow: hidden; clear: both;">';
        die(var_dump($data));
        echo '</pre>';
    }
}

if (!function_exists('crb_get_i18n_suffix')) {
    function crb_get_i18n_suffix()
    {
        $suffix = '';
        if (!defined('ICL_LANGUAGE_CODE')) {
            return $suffix;
        }
        $suffix = '_'.ICL_LANGUAGE_CODE;

        return $suffix;
    }
}

/*
 * Translate string
 */
if (!function_exists('crb_get_i18n_theme_option')) {
    function crb_get_i18n_theme_option($option_name)
    {
        $suffix = crb_get_i18n_suffix();

        return carbon_get_theme_option($option_name.$suffix);
    }
}

/*
 * Write log helper
 */
if (!function_exists('write_log')) {
    function write_log($log)
    {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}

    // multilang
if (!function_exists('trans_string')) {
    function trans_string($string)
    {
        return pll_e($string);
    }
}

if (!function_exists('trans_string_var')) {
    function trans_string_var($string)
    {
        return pll_($string);
    }
}

if (!function_exists('loadMail')) {
    function loadMail($filename, $data)
    {
        ob_start();
        require_once __DIR__.'/../views/mails/'.$filename.'.php';
        $data['php_mailer']->Body = ob_get_contents();
        ob_end_clean();
    }
}
