<?php
/**
 * UseSslTrait.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\helpers;

trait UseSslTrait
{

    public function checkUseSsl($send_redirect = false)
    {
        $redirect = true === USE_SSL && (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on');

        if (true === $send_redirect) {
            if (true === $redirect) {
                Response()
                    ->redirect('https://' . Request()->serverName . Request()->url)
                    ->send();
                exit;
            }
        }

        return $redirect;
    }
}