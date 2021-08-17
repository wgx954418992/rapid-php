<?php


namespace apps\openapi\classier\config;


use enum\classier\Enum;

class ExportConfig extends Enum
{

    /**
     * android config
     * @param array $options
     * @return string[]
     */
    public static function getAndroidConfig(array $options = []): array
    {
        return array_merge([
            'library' => 'retrofit2',
            'useRxJava2' => 'true',
            'developerName' => 'Renew',
            'developerEmail' => '954418992@qq.com',
            'developerOrganization' => 'app.com',
            'invokerPackage' => 'com.renew.app',
            'modelPackage' => 'com.renew.app.model',
            'apiPackage' => 'com.renew.app.api',
            'groupId' => 'com.renew.app.model',
            'artifactId' => 'app',
            'serializableModel' => true
        ], (array)$options);
    }
}
