<?php

/**
 * MUser form base class.
 *
 * @method MUser getObject() Returns the current form's model object
 *
 * @package    nowtter
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMUserForm extends BaseFormDoctrine
{
    public function setup()
    {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'user_name' => new sfWidgetFormInputText(),
            'email' => new sfWidgetFormInputText(),
            'profile' => new sfWidgetFormTextarea(),
            'birthday' => new sfWidgetFormDate(),
            'is_private' => new sfWidgetFormInputCheckbox(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'user_name' => new sfValidatorString(array('max_length' => 255)),
            'email' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'profile' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
            'birthday' => new sfValidatorDate(array('required' => false)),
            'is_private' => new sfValidatorBoolean(array('required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->validatorSchema->setPostValidator(
            new sfValidatorDoctrineUnique(array('model' => 'MUser', 'column' => array('user_name')))
        );

        $this->widgetSchema->setNameFormat('m_user[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName()
    {
        return 'MUser';
    }

}
