<?php

/**
 * TFollow form base class.
 *
 * @method TFollow getObject() Returns the current form's model object
 *
 * @package    nowtter
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTFollowForm extends BaseFormDoctrine
{
    public function setup()
    {
        $this->setWidgets(array(
            'user_id' => new sfWidgetFormInputHidden(),
            'follow_user_id' => new sfWidgetFormInputHidden(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'user_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_id')), 'empty_value' => $this->getObject()->get('user_id'), 'required' => false)),
            'follow_user_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('follow_user_id')), 'empty_value' => $this->getObject()->get('follow_user_id'), 'required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->widgetSchema->setNameFormat('t_follow[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName()
    {
        return 'TFollow';
    }

}
