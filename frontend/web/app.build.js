{
    "appDir": "./www",
    "dir": "./build",
    "mainConfigFile": "./www/js/lib/config.js",
    "paths": {
        "page.params": "empty:"
    },
    "baseUrl": "./js",
    "useStrict": true,
    "removeCombined": true,
    "findNestedDependencies": true,
    "optimizeCss": "standard",
    "waitSeconds": 0,
    "modules": [
        {
            "name": "../pages/index/index",
            "include": [
                "jquery"
            ],
            "exclude": [
                "../js/lib/config"
            ]
        },
        {
            "name": "../pages/live/watcher",
            "include": [
                "jquery",
                "ckplayer"
            ],
            "exclude": [
                "../js/lib/config"
            ]
        },
        {
            "name": "../pages/socket/index",
            "include": [
                "jquery"
            ],
            "exclude": [
                "../js/lib/config"
            ]
        },
        {
            "name": "../pages/socket/look",
            "include": [
                "jquery"
            ],
            "exclude": [
                "../js/lib/config"
            ]
        }
    ]
}