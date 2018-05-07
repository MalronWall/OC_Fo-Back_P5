<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Helper;

use Core\Application\Controller\AbstractController;

class RenameHelper extends AbstractController
{
    public function moveImageUserUploaded($image, $pseudo)
    {
        $dir = __DIR__.'/../../public/images/database/user/';
        return move_uploaded_file($image, $dir.$pseudo.'.png');
    }
    
    public function renameImageUser($oldPseudo, $newPseudo)
    {
        $dir = __DIR__.'/../../public/images/database/user/';
        $oldFile = $dir.$oldPseudo.'.png';
        if (file_exists($oldFile)) {
            $newFile = $dir.$newPseudo.'.png';
            return rename($oldFile, $newFile);
        }
        return false;
    }
}
