<?php

namespace Inspheric\Fields;

use Laravel\Nova\Fields\Text;

class SocialUrl extends Text
{

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'url-field';

    /**
     * The social media service.
     *
     * @var string
     */
    public $service = '';

    /**
     * The link label.
     *
     * @var string
     */
    public $label = '';

    /**
     * Any custom icons defined.
     *
     * @var array
     */
    public $customIcons = [];

    /**
     * Any custom overrides defined.
     *
     * @var array
     */
    public $customOverrides = [];

    /**
     * Specify the social media service to use,
     * otherwise it will be guessed from the URL, if possible.
     *
     * @param  string $service
     * @return $this
     */
    public function service(string $service)
    {
        $this->service = $service;

        return $this->withMeta(['service' => $service]);
    }

    /**
     * Specify the label for the link, otherwise it will be the
     * name of the social media service.
     *
     * @param  string $label
     * @return $this
     */
    public function label(string $label)
    {
        $this->label = $label;

        return $this->withMeta(['label' => $label]);
    }

    /**
     * Whether the social URL should be displayed as a clickable
     * link on the detail page.
     *
     * @param  bool $clickable
     * @return $this
     */
    public function clickable(bool $clickable = true)
    {
        return $this->withMeta(['clickable' => $clickable]);
    }

    /**
     * Whether the social URL should be displayed as a clickable
     * mailto link on the index page.
     *
     * @param  bool $clickable
     * @return $this
     */
    public function clickableOnIndex(bool $clickable = true)
    {
        return $this->withMeta(['clickableOnIndex' => $clickable]);
    }

    /**
     * Add a custom icon definition.
     *
     * @param  string $key     The key that will identify this icon.
     * @param  string|array $label   The label to display beside the link. Or the whole icon definition as an array.
     * @param  string|null $svg     The SVG content (excluding the outer <svg> element) for the icon
     * @param  string|null $hex     The colour of the icon
     * @param  int|null $size     The size of the icon in pixels
     * @param  string|null $pattern The regex that will identify URLs as belonging to this service
     *
     * @return $this
     */
    public function customIcon(string $key, $label, string $svg = null, string $hex = null, int $size = null, string $pattern = null)
    {
        if (is_array($label)) {
            return $this->customIcon($key, $label['label'], $label['svg'], @$label['hex'], @$label['size'], @$label['pattern']);
        }

        $svg = preg_replace([
            '~<svg[^>]+>~',
            '~</svg>~',
        ], '', $svg);

        $this->customIcons[$key] = [
            'label'   => $label,
            'svg'     => $svg,
            'hex'     => $hex,
            'size'    => $size,
            'pattern' => $pattern,
        ];

        return $this;
    }

    /**
     * Add multiple custom icons definitions at once.
     *
     * @param  array  $icons An array of icons like so:
     *     [
     *         $key => [
     *             'label' => $label,
     *             'svg' => $svg,
     *             ?'hex' => $hex
     *             ?'size' => $size
     *             ?'pattern' => $pattern
     *         ]
     *     ]
     *
     * @return $this
     */
    public function customIcons(array $icons)
    {
        foreach ($icons as $key => $icon) {
            $this->customIcon($key, $icon['label'], $icon['svg'], @$icon['hex'], @$icon['size'], @$icon['pattern']);
        }

        return $this;
    }

    /**
     * Override an attribute of a defined icon.
     *
     * @param  string $key   The icon to override
     * @param  string|array $attribute  The attribute (title, svg, hex, size, pattern) to override. OR An array of keys and values to override.
     * @param  string|null $value The value to override the attribute to
     *
     * @return $this
     */
    public function customOverride(string $key, $attribute, string $value = null)
    {
        if (is_array($attribute)) {
            foreach ($attribute as $attributeKey => $value) {
                $this->customOverride($key, $attributeKey, $value);
            }
            return $this;
        }

        $this->customOverrides[$key][$attribute] = $value;

        return $this;
    }

    /**
     * Guess the service from the URL.
     *
     * @return string
     */
    protected function guessService()
    {
        return $this->service ?: SocialIcon::withCustomIcons($this->customIcons)->guessService($this->value);
    }

    /**
     * Get additional meta information to merge with the element payload.
     *
     * @return array
     */
    public function meta()
    {
        $service = $this->guessService();
        $icon = SocialIcon::withCustomIcons($this->customIcons)->withCustomOverrides($this->customOverrides)->getIcon($service);

        return array_merge([
            'clickable' => true,
            'social'    => true,
            'service'   => $service,
            'label'     => $this->label ?: @$icon['label'],
            'icon'      => $icon['svg'],
            'color'     => @$icon['hex'] ? '#'.ltrim($icon['hex'], '#') : null,
            'size'      => @$icon['size'] ?: 24,
        ], $this->meta);
    }
}
