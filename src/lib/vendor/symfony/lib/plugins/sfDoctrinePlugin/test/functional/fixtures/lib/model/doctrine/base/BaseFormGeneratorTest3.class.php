<?php

/**
 * BaseFormGeneratorTest3
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property string $name
 *
 * @method string             getName() Returns the current record's "name" value
 * @method FormGeneratorTest3 setName() Sets the current record's "name" value
 *
 * @package    symfony12
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFormGeneratorTest3 extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('form_generator_test3');
        $this->hasColumn('name', 'string', 255, array(
            'type' => 'string',
            'length' => 255,
        ));

        $this->option('symfony', array(
            'form' => false,
            'filter' => false,
        ));
    }

    public function setUp()
    {
        parent::setUp();
        $i18n0 = new Doctrine_Template_I18n(array(
            'fields' =>
                array(
                    0 => 'name',
                ),
        ));
        $this->actAs($i18n0);
    }
}