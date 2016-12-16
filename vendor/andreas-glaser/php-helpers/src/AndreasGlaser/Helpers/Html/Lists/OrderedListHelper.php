<?php

namespace AndreasGlaser\Helpers\Html\Lists;

use AndreasGlaser\Helpers\Html\AttributesHelper;
use AndreasGlaser\Helpers\Interfaces\RendererInterface;

/**
 * Class OrderedListHelper
 *
 * @package AndreasGlaser\Helpers\Html\Lists
 * @author  Andreas Glaser
 */
class OrderedListHelper extends BaseListHelper
{
    /**
     * @param \AndreasGlaser\Helpers\Interfaces\RendererInterface|null $renderer
     *
     * @return string
     * @author Andreas Glaser
     */
    public function render(RendererInterface $renderer = null)
    {
        if ($renderer) {
            return $renderer->render($this);
        }

        $html = '<ol' . $this->attributes . '>';

        $itemCount = count($this->items);
        $itemIndex = 0;

        foreach ($this->items AS $item) {

            /** @var AttributesHelper $attributes */
            $attributes = $item['attributes'];

            if ($itemIndex === 0) {
                $attributes->addClass('item-first');
            }

            if ($itemIndex === $itemCount - 1) {
                $attributes->addClass('item-last');
            }

            $attributes->addClass('item-index-' . $itemIndex);

            $html .= '<li' . $attributes . '>' . $item['content'] . '</li>';

            $itemIndex++;
        }

        $html .= '</ol>';

        return $html;
    }
}