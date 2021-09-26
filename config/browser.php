<?php

return [
    'executable' => 'chromium',
    'headless' => false,
    'links' => [
        'huawei' => [
            'mainPage' => 'https://eu5.fusionsolar.huawei.com/',
            'dataPage' => 'https://eu5.fusionsolar.huawei.com/rest/pvms/web/station/v1/overview/energy-balance?stationDn=%s&timeDim=2&queryTime=%s&timeZone=2&timeZoneStr=Europe/Warsaw&_=1631653656094'
        ]
    ],
    'selectors' => [
        'huawei' => [
            'loginInput' => 'input#username',
            'passwordInput' => 'input#value',
            'loginSubmitButton' => 'span#submitDataverify',
            'restResponseContent' => 'pre'
        ]
    ]
];
