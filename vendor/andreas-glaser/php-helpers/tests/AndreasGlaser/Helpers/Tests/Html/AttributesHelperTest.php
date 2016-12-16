<?php

namespace AndreasGlaser\Helpers\Tests\Html;

use AndreasGlaser\Helpers\Html\AttributesHelper;
use AndreasGlaser\Helpers\Tests\BaseTest;

/**
 * Class AttributesHelperTest
 *
 * @package AndreasGlaser\Helpers\Tests\Html
 * @author  Andreas Glaser
 */
class AttributesHelperTest extends BaseTest
{

    /**
     * @author Andreas Glaser
     */
    public function testAttributes()
    {
        $attributesHelper = new AttributesHelper();
        $attributesHelper
            ->setId('myid')
            ->addClass('myclass')
            ->addData('mydata1', 'cheese')
            ->addData('mydata2', 'bacon')
            ->addStyle('height', '100%')
            ->addStyle('width', '200px')
            ->set('href', 'http://andreas.glaser.me');

        $this->assertEquals(
            ' id="myid" class="myclass" href="http://andreas.glaser.me" data-mydata1="cheese" data-mydata2="bacon" style="height:100%;width:200px;"',
            $attributesHelper->render()
        );

        $attributesHelper->removeClass('myclass');
        $attributesHelper->removeData('mydata2');
        $attributesHelper->removeId();

        $this->assertEquals(
            ' href="http://andreas.glaser.me" data-mydata1="cheese" style="height:100%;width:200px;"',
            $attributesHelper->render()
        );

        $this->assertEquals(
            ' id="my-id" class="testclass" data-important="info" data-cheese="delicious" style="color:red;font-size:1em;"',
            AttributesHelper::f(['id' => 'my-id', 'CLASS' => 'testclass', 'data-important' => 'info', 'data-cheese' => 'delicious', 'style' => 'color:red;font-size:1em'])->render()
        );
    }
}
 