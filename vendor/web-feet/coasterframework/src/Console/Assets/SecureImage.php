<?php namespace CoasterCms\Console\Assets;

class SecureImage extends AbstractAsset
{

    public static $name = 'securimage';

    public static $version = '3.6.3';

    public static $description = 'Secureimage Captcha';

    public function run()
    {
        $this->downloadZip(
            'https://github.com/dapphp/securimage/archive/3.6.3.zip',
            ['securimage-3.6.3' => '']
        );
    }

}
