<?php
return [
    'domains' => env("COMMENT_DOMAINS", "127.0.0.1"),
    'base_url' => env("COMMENT_BASE_URL", "http://127.0.0.1/"),
    'site_name' => env("COMMENT_SITE_NAME", "网站名称"),
    'site_count_url' => env("COMMENT_SITE_COUNT_URL", ''),
    'enable_page_share' => env("COMMENT_ENABLE_PAGE_SHARE", false),
    'enable_page_analytics' => env("COMMENT_ENABLE_PAGE_ANALYTICS", false),
    'seo' => [
        'keywords' => env("COMMENT_SEO_KEYWORDS", "内容分享,内容创作,网赚,广告收入"),
        'description' => env("COMMENT_SEO_DESCRIPTION", "一个简约的内容分享平台，通过发布内容和浏览点击广告可获得一定的收益"),
    ]
];
