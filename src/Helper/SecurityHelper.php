<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Helper;

use Core\Application\Controller\AbstractController;

class SecurityHelper extends AbstractController
{
    /**
     * @return string
     */
    public function generateToken()
    {
//        bin2hex(random_bytes(32));
        return md5(uniqid(strval(mt_rand()), true));
    }
}
