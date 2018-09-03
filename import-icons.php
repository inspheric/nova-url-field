<?php

$path = 'node_modules/simple-icons/index.js';

$source = json_decode(rtrim(str_replace('module.exports=', '', file_get_contents($path)), ';'), true);

$icons = [];

$keep = [
    'facebook', 'twitter', 'instagram', 'dribbble', 'pinterest', 'sinaweibo', 'airbnb', 'youtube',
    'tinder', 'npm', 'yelp', 'last-dot-fm', 'google-plus', 'gmail', 'patreon', 'soundcloud',
    'blogger', 'reddit', 'klout', 'eventbrite', 'strava', 'etsy', 'odnoklassniki', 'stackoverflow',
    'goodreads', 'rss', 'snapchat', 'kik', 'wechat', 'gumtree', 'glassdoor', 'deviantart', 'spotify',
    'kickstarter', 'slack', 'tripadvisor', 'about-dot-me', 'slashdot', 'runkeeper', 'fitbit', 'bandcamp',
    'vimeo', 'livejournal', 'skype', 'tencentqq', 'wordpress', 'gravatar', 'linkedin', 'googleplay',
    'trello', 'drupal', 'scribd', 'yammer', 'gov-dot-uk', 'renren', 'jsfiddle', 'messenger', 'delicious',
    'dailymotion', 'vk', 'stackexchange', 'tumblr', 'atlassian', 'bitbucket', 'hipchat', 'dropbox', 'jira',
    'microsoftonedrive', 'googledrive', 'behance', 'baidu', 'yahoo', 'apple', 'microsoft', 'sourceforge',
    'instapaper', 'medium', 'github', 'myspace', 'wikipedia', 'uber', 'stitcher', 'steam', 'squarespace',
    'discourse', 'digg', 'codepen', 'applemusic', 'meetup', 'justgiving',
];

foreach ($source as $title => $def) {
    $key = icon_key($title);

    if (in_array($key, $keep, true)) {

        $icon = [
            'label' => $def['title'],
            'hex'   => strtolower($def['hex']),
        ];
        $icon['pattern'] = base_url($key, $def['source']);

        $icon['svg'] = preg_replace([
            '~<svg aria-labelledby="simpleicons-.*" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-.*">.* icon</title>~',
            '~</svg>~',
        ], '', $def['svg']);

        $icons[$key] = $icon;
    }
}

$icons = preg_replace([
    '/=> \n\s+/',
    '/array \(/',
], [
    '=> ',
    'array(',
], var_export($icons, true));

$file = <<<STUB
<?php

namespace Inspheric\Fields;

class SocialIcon
{
    public static function guessService(\$url) {
        \$allIcons = static::allIcons();
        foreach (\$allIcons as \$key => \$icon) {
            if (\$icon['pattern'] && preg_match('~^https?://(.*\.)?'.\$icon['pattern'].'~', \$url)) {
                return \$key;
            }
        }
    }

    public static function getIcon(\$key) {

        \$allIcons = static::allIcons();

        if (array_key_exists(\$key, \$allIcons)) {
            return \$allIcons[\$key];
        }

        return [
            'svg' => '<path d="M19 6.41L8.7 16.71a1 1 0 1 1-1.4-1.42L17.58 5H14a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V6.41zM17 14a1 1 0 0 1 2 0v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2h5a1 1 0 0 1 0 2H5v12h12v-5z"/>',
        ];
    }

    public static function allIcons()
    {
        \$icons = array_merge(static::\$icons, static::\$customIcons);

        foreach (static::\$customOverrides as \$key => \$override) {
            \$icons[\$key] = array_merge(\$icons[\$key], \$override);
        }

        return \$icons;
    }

    protected static \$customIcons = [];

    public static function withCustomIcons(array \$customIcons)
    {
        static::\$customIcons = \$customIcons;

        return new static;
    }

    protected static \$customOverrides = [];

    public static function withCustomOverrides(array \$customOverrides)
    {
        static::\$customOverrides = \$customOverrides;

        return new static;
    }

    protected static \$icons = $icons;
}
STUB;

file_put_contents('src/SocialIcon.php', $file);

exit;

function icon_key($title)
{
    $replacements = [
        '/\+/'      => 'plus',
        '/^\./'     => 'dot-',
        '/\.$/'     => '-dot',
        '/\./'      => '-dot-',
        '/[ !’\']/' => '',
        '/microsoftonedrive/' => 'onedrive',
    ];

    return preg_replace(array_keys($replacements), array_values($replacements), strtolower($title));
}

function base_url($key, $source)
{
    $exceptions = [
        'apple'         => 'apple.com',
        'applemusic'    => 'itunes.apple.com',
        'baidu'         => 'baidu.com',
        'bitbucket'     => 'bitbucket.com',
        'dailymotion'   => 'dailymotion.com',
        'delicious'     => '(del.icio.us|delicious.com)',
        'deviantart'    => 'deviantart.com',
        'digg'          => 'digg.com',
        'facebook'      => '(facebook.com|fb.me)',
        'gmail'         => '(mail.google.com|gmail.com)',
        'googledrive'   => '(drive.google.com|googledrive.com)',
        'googleplay'    => 'play.google.com',
        'googleplus'    => 'plus.google.com',
        'gov-dot-uk'    => 'gov.uk',
        'gravatar'      => 'gravatar.com',
        'hipchat'       => 'hipchat.com',
        'jira'          => 'jira.com',
        'jsfiddle'      => 'jsfiddle.net',
        'linkedin'      => '(linkedin.com|lnkd.in)',
        'medium'        => 'medium.com',
        'messenger'     => '(messenger.facebook.com|messenger.com)',
        'microsoft'     => 'microsoft.com',
        'npm'           => 'npm.com',
        'odnoklassniki' => '(ok.ru|odnoklassniki.ru)',
        'pinterest'     => 'pinterest.com',
        'reddit'        => 'reddit.com',
        'renren'        => 'renren.com',
        'rss'           => '.*\.rss',
        'sinaweibo'     => 'weibo.com',
        'skype'         => 'skype.com',
        'slashdot'      => 'slashdot.org',
        'spotify'       => 'spotify.com',
        'stackexchange' => 'stackexchange.com',
        'steam'         => 'steam(community|powered).com',
        'strava'        => 'strava.com',
        'tripadvisor'   => 'tripadvisor.com',
        'tripadvisor'   => 'tripadvisor.com',
        'twitter'       => '(twitter.com|t.co)',
        'wechat'        => '(wechat.com|weixin.qq.com)',
        'wikipedia'     => 'wikipedia.com',
        'yahoo'         => 'yahoo.com',
        'yammer'        => 'yammer.com',
        'github'        => 'github.com',
        'wordpress'        => 'wordpress.(com|org)',
        'youtube'       => '(youtube.com|youtu.be)',
    ];

    if (array_key_exists($key, $exceptions)) {
        $url = $exceptions[$key];
    }
    else {
        $url = parse_url($source, PHP_URL_HOST);

        $url = preg_replace([
            '/^www\./'
        ], '', $url);

        if (false) {
            if (in_array($url, ['en.wikipedia.org', 'worldvectorlogo.com', 'seeklogo.com', 'github.com'])) {
                var_dump($key.' --> '.$url);
            }
            if (stripos($url, $key) === false) {
                var_dump($key.' --> '.$url);
            }
            if (count(explode('.', $url)) > 2) {
                var_dump($key.' --> '.$url);
            }
            var_dump($key.' --> '.$url);
        }

    }

    return $url;
}
