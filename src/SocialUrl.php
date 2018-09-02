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
     * The the social media service.
     *
     * @var string
     */
    public $service = 'facebook';

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
     * Get additional meta information to merge with the element payload.
     *
     * @return array
     */
    public function meta()
    {
        return array_merge([
            'clickable' => true,
            'social' => true,
            'icon' => SocialIcon::getIcon($this->service),
        ], $this->meta);
    }
}
