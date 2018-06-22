<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Helper;

use Core\Application\Controller\AbstractController;

class RenameHelper extends AbstractController
{
    /**
     * @param $image
     * @param $pseudo
     * @return bool
     */
    public function moveImageUserUploaded($image, $pseudo)
    {
        $dir = __DIR__.'/../../public/images/database/user/';
        return move_uploaded_file($image, $dir.$pseudo.'.png');
    }

    /**
     * @param $image
     * @param $slug
     * @return bool
     */
    public function moveImagePostUploaded($image, $slug)
    {
        $dir = __DIR__.'/../../public/images/database/post/';
        return move_uploaded_file($image, $dir.$slug.'.png');
    }

    /**
     * @param $oldPseudo
     * @param $newPseudo
     * @return bool
     */
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

    /**
     * @param $oldSlug
     * @param $newSlug
     * @return bool
     */
    public function renameImagePost($oldSlug, $newSlug)
    {
        $dir = __DIR__.'/../../public/images/database/post/';
        $oldFile = $dir.$oldSlug.'.png';
        if (file_exists($oldFile)) {
            $newFile = $dir.$newSlug.'.png';
            return rename($oldFile, $newFile);
        }
        return false;
    }

    /**
     * @param $title
     * @return mixed
     */
    public function renameTitleInSlug($title)
    {
        $slug = strtolower($this->removeAccents($title));

        $slug = $this->safeURL($slug);
        
        return $this->replaceBlanks($slug);
    }

    /**
     * @param $pseudo
     * @return mixed
     */
    public function renamePseudo($pseudo)
    {
        $newPseudo = $this->removeAccents($pseudo);
        
        $newPseudo = $this->safeURL($newPseudo);
        
        return $this->removeBlanks($newPseudo);
    }

    /**
     * @param $var
     * @return mixed
     */
    private function removeAccents($var)
    {
        $accents = array('@','À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ò','Ó','Ô','Õ',
            'Ö','Ù','Ú','Û','Ü','Ý','à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ð','ò','ó','ô',
            'õ','ö','ù','ú','û','ü','ý','ÿ');
        $replaceAccents = array('a','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','O','O','O','O',
            'O','U','U','U','U','Y','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o',
            'o','o','u','u','u','u','y','y');
        return str_replace($accents, $replaceAccents, $var);
    }

    /**
     * @param $var
     * @return mixed
     */
    private function safeURL($var)
    {
        $speCharac = array(
            '<','>','\'','#','%','{','}','|','"','^',',','~','[',']','`',';','/','?',':','@','=','&'
        );
        return str_replace($speCharac, '', $var);
    }

    /**
     * @param $var
     * @return mixed
     */
    private function replaceBlanks($var)
    {
        $blanks = array(' ', '--', '_');
        return str_replace($blanks, '-', $var);
    }

    /**
     * @param $var
     * @return mixed
     */
    private function removeBlanks($var)
    {
        return str_replace(' ', '', $var);
    }
}
