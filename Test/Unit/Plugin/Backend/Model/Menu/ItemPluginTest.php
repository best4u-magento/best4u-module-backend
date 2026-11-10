<?php
/**
 * Copyright © Best4u Media B.V. All rights reserved.
 */
declare(strict_types=1);

namespace Best4u\Backend\Test\Unit\Plugin\Backend\Model\Menu;

use ArrayIterator;
use Best4u\Backend\Plugin\Backend\Model\Menu\ItemPlugin;
use Magento\Backend\Model\Menu;
use Magento\Backend\Model\Menu\Item;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

/**
 * Unit test for the plugin hiding the empty "Best4u" admin menu
 */
class ItemPluginTest extends TestCase
{
    /**
     * @var ItemPlugin
     */
    private ItemPlugin $plugin;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        $this->plugin = new ItemPlugin();
    }

    /**
     * Other menu items are never changed by the plugin
     *
     * @return void
     */
    public function testOtherItemsAreNotAffected(): void
    {
        $item = $this->createItemMock('Magento_Backend::dashboard');
        $item->expects($this->never())->method('hasChildren');

        $this->assertFalse($this->plugin->afterIsDisabled($item, false));
        $this->assertTrue($this->plugin->afterIsDisabled($item, true));
    }

    /**
     * A root item disabled by Magento stays disabled
     *
     * @return void
     */
    public function testAlreadyDisabledRootStaysDisabled(): void
    {
        $root = $this->createItemMock(ItemPlugin::MENU_ROOT_ID);
        $root->expects($this->never())->method('hasChildren');

        $this->assertTrue($this->plugin->afterIsDisabled($root, true));
    }

    /**
     * The root item is hidden when no extension added child items
     *
     * @return void
     */
    public function testRootWithoutChildrenIsDisabled(): void
    {
        $root = $this->createItem(ItemPlugin::MENU_ROOT_ID);
        $root->method('hasChildren')->willReturn(false);

        $this->assertTrue($this->plugin->afterIsDisabled($root, false));
    }

    /**
     * The root item is visible when at least one child item is visible
     *
     * @return void
     */
    public function testRootWithVisibleChildIsEnabled(): void
    {
        $root = $this->createRootWithChildren([
            $this->createChild(false, false),
            $this->createChild(true, false),
        ]);

        $this->assertFalse($this->plugin->afterIsDisabled($root, false));
    }

    /**
     * The root item is hidden when the admin user is not allowed to see any child item
     *
     * @return void
     */
    public function testRootWithOnlyNotAllowedChildrenIsDisabled(): void
    {
        $root = $this->createRootWithChildren([
            $this->createChild(false, false),
            $this->createChild(false, false),
        ]);

        $this->assertTrue($this->plugin->afterIsDisabled($root, false));
    }

    /**
     * The root item is hidden when all child items are disabled
     *
     * @return void
     */
    public function testRootWithOnlyDisabledChildrenIsDisabled(): void
    {
        $root = $this->createRootWithChildren([
            $this->createChild(true, true),
        ]);

        $this->assertTrue($this->plugin->afterIsDisabled($root, false));
    }

    /**
     * Create menu item mock (with expectations) with the given identifier
     *
     * @param string $id
     * @return Item&MockObject
     */
    private function createItemMock(string $id): Item
    {
        $item = $this->createMock(Item::class);
        $item->method('getId')->willReturn($id);

        return $item;
    }

    /**
     * Create menu item stub with the given identifier
     *
     * @param string $id
     * @return Item&Stub
     */
    private function createItem(string $id): Item
    {
        $item = $this->createStub(Item::class);
        $item->method('getId')->willReturn($id);

        return $item;
    }

    /**
     * Create child menu item mock
     *
     * @param bool $isAllowed
     * @param bool $isDisabled
     * @return Item&Stub
     */
    private function createChild(bool $isAllowed, bool $isDisabled): Item
    {
        $child = $this->createItem('Best4u_Test::child');
        $child->method('isAllowed')->willReturn($isAllowed);
        $child->method('isDisabled')->willReturn($isDisabled);

        return $child;
    }

    /**
     * Create "Best4u" root menu item mock with the given child items
     *
     * @param Item[] $children
     * @return Item&Stub
     */
    private function createRootWithChildren(array $children): Item
    {
        $menu = $this->createStub(Menu::class);
        $menu->method('getIterator')->willReturn(new ArrayIterator($children));

        $root = $this->createItem(ItemPlugin::MENU_ROOT_ID);
        $root->method('hasChildren')->willReturn(true);
        $root->method('getChildren')->willReturn($menu);

        return $root;
    }
}
