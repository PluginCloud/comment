<?php
return [
    'domains' => env("COMMENT_DOMAINS", "127.0.0.1|localhost"),
    'site_name' => env("COMMENT_SITE_NAME", "收藏屋"),
    'site_count_url' => env("COMMENT_SITE_COUNT_URL", 'https://new.cnzz.com/v1/login.php?siteid=1278840518'),
    'enable_page_share' => env("COMMENT_ENABLE_PAGE_SHARE", false),
    'enable_page_analytics' => env("COMMENT_ENABLE_PAGE_ANALYTICS", false)
];
