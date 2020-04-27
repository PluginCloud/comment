<?php
return [
    'domains' => env("COMMENT_DOMAINS", "127.0.0.1|localhost"),
    'site_name' => env("COMMENT_SITE_NAME", "网站名称"),
    'site_count_url' => env("COMMENT_SITE_COUNT_URL", ''),
    'enable_page_share' => env("COMMENT_ENABLE_PAGE_SHARE", false),
    'enable_page_analytics' => env("COMMENT_ENABLE_PAGE_ANALYTICS", false)
];
