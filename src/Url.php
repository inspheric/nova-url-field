<?php

namespace Inspheric\Fields;

use Laravel\Nova\Fields\Text;

class Url extends Text
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'url-field';

    /**
     * Whether the email should be displayed as a clickable
     * link on the detail page.
     *
     * @param  string $label
     * @return $this
     */
    public function label(string $label = null)
    {
        return $this->withMeta(['label' => $label]);
    }

    /**
     * Whether the email should be displayed as a clickable
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
     * Whether the email should be displayed as a clickable
     * mailto link on the index page.
     *
     * @param  bool $clickable
     * @return $this
     */
    public function clickableOnIndex(bool $clickable = true)
    {
        return $this->withMeta(['clickableOnIndex' => $clickable]);
    }
}
