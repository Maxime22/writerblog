<?php
namespace FormBuilder;

use \MiniFram\FormBuilder;
use \MiniFram\MaxLengthValidator;
use \MiniFram\NotNullValidator;
use \MiniFram\StringField;
use \MiniFram\TextField;

class ConnexionFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([ 
            'label' => 'Pseudo',
            'name' => 'login',
            'maxLength' => 50,
            'validators' => [
                new MaxLengthValidator('Le pseudo spécifié est trop long (50 caractères maximum)', 50),
                new NotNullValidator('Merci de spécifier le pseudo'),
            ],
        ]))
        ->add(new StringField([ 
            'label' => 'Mot de passe',
            'name' => 'password',
            'maxLength' => 50,
            'validators' => [
                new MaxLengthValidator('Le mot de passe est trop long (50 caractères maximum)', 50),
                new NotNullValidator('Merci de spécifier le mot de passe'),
            ],
        ]));
    }
}
