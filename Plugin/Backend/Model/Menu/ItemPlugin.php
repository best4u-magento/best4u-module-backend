<?php
/**
 * Copyright © Best4u Media B.V. All rights reserved.
 */
declare(strict_types=1);

namespace Best4u\Backend\Plugin\Backend\Model\Menu;

use Magento\Backend\Model\Menu\Item;

/**
 * Hides the "Best4u" admin menu root when it has no visible child items.
 *
 * The root item has no action of its own; it only groups the menu items added by other Best4u extensions.
 * Without any child item the current admin user is allowed to see, it would be rendered as an empty menu.
 */
class ItemPlugin
{
    /**
     * Identifier of the "Best4u" admin menu root declared in etc/adminhtml/menu.xml
     */
    public const MENU_ROOT_ID = 'Best4u::best4u_elements';

    /**
     * Treat the "Best4u" menu root as disabled when none of its child items is visible
     *
     * @param Item $subject
     * @param bool $result
     * @return bool
     */
    public function afterIsDisabled(Item $subject, $result): bool
    {
        if ($result || $subject->getId() !== self::MENU_ROOT_ID) {
            return (bool)$result;
        }

        return !$this->hasVisibleChildren($subject);
    }

    /**
     * Check whether the menu item has at least one child item that is allowed and enabled
     *
     * @param Item $item
     * @return bool
     */
    private function hasVisibleChildren(Item $item): bool
    {
        if (!$item->hasChildren()) {
            return false;
        }

        /** @var Item $child */
        foreach ($item->getChildren() as $child) {
            if ($child->isAllowed() && !$child->isDisabled()) {
                return true;
            }
        }

        return false;
    }
}
