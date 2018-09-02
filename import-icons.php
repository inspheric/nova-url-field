<?php

$path = 'node_modules/simple-icons/index.js';

$source = json_decode(rtrim(str_replace('module.exports=', '', file_get_contents($path)), ';'), true);

$icons = [];

$keep = [
    'facebook', 'twitter', 'instagram', 'dribbble', 'pinterest', 'sinaweibo', 'airbnb', 'youtube',
    'tinder', 'npm', 'yelp', 'last-dot-fm', 'google-plus', 'gmail', 'patreon', 'soundcloud',
    'blogger', 'reddit', 'klout', 'eventbrite', 'strava', 'etsy', 'odnoklassniki', 'stackoverflow',
    'goodreads', 'rss', 'snapchat', 'kik', 'wechat', 'gumtree', 'glassdoor', 'deviantart', 'spotify', 'kickstarter', 'slack', 'tripadvisor', 'about-dot-me', 'slashdot', 'runkeeper', 'fitbit', 'bandcamp',
    'vimeo', 'livejournal', 'skype', 'tencentqq', 'wordpress', 'gravatar', 'linkedin', 'googleplay', 'trello', 'drupal', 'scribd', 'yammer', 'gov.uk', 'renren', 'jsfiddle', 'messenger', 'delicious',
    'dailymotion', 'vk', 'stackexchange', 'tumblr', 'atlassian', 'bitbucket', 'hipchat', 'dropbox', 'jira', 'microsoftonedrive', 'googledrive', 'behance', 'baidu', 'yahoo', 'apple', 'microsoft', 'sourceforge',
    'instapaper', 'medium', 'github', 'myspace', 'wikipedia', 'uber', 'stitcher', 'steam', 'squarespace', 'discourse', 'digg', 'codepen', 'applemusic',
];

foreach ($source as $title => $icon) {
    $key = icon_key($title);

    if (in_array($key, $keep, true)) {
        unset($icon['source']);
        $icon['svg'] = preg_replace([
            '~<svg aria-labelledby="simpleicons-.*" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-.*">.* icon</title>~',
            '~</svg>~',
        ], '', $icon['svg']);
        $icons[$key] = $icon;
    }
}

var_dump($icons);

function icon_key($title)
{
    $replacements = [
        '/\+/' => 'plus',
        '/^\./' => 'dot-',
        '/\.$/' => '-dot',
        '/\./' => '-dot-',
        '/[ !’\']/' => '',
    ];

    return preg_replace(array_keys($replacements), array_values($replacements), strtolower($title));
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
    public static function getIcon(\$key) {
        return static::\$icons[\$key];
    }

    protected static \$icons = $icons;
}
STUB;

file_put_contents('src/SocialIcon.php', $file);
