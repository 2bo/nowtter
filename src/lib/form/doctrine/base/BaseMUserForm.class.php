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
            'sf_guard_user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
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
            'sf_guard_user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'required' => false)),
            'user_name' => new sfValidatorString(array('max_length' => 255)),
            'email' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'profile' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
            'birthday' => new sfValidatorDate(array('required' => false)),
            'is_private' => new sfValidatorBoolean(array('required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->validatorSchema->setPostValidator(
            new sfValidatorAnd(array(
                new sfValidatorDoctrineUnique(array('model' => 'MUser', 'column' => array('sf_guard_user_id'))),
                new sfValidatorDoctrineUnique(array('model' => 'MUser', 'column' => array('user_name'))),
            ))
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
