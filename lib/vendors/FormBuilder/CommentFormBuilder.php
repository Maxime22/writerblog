<?php
namespace FormBuilder;

use \MiniFram\FormBuilder;
use \MiniFram\MaxLengthValidator;
use \MiniFram\NotNullValidator;
use \MiniFram\StringField;
use \MiniFram\TextField;

class CommentFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([ // the data will be checked by the validator when we post a form
            'label' => 'Auteur',
            'name' => 'author',
            'maxLength' => 50,
            'validators' => [
                new MaxLengthValidator('L\'auteur spécifié est trop long (50 caractères maximum)', 50),
                new NotNullValidator('Merci de spécifier l\'auteur du commentaire'),
            ],
        ]))
            ->add(new TextField([
                'label' => 'Contenu',
                'name' => 'content',
                'rows' => 7,
                'cols' => 50,
                'validators' => [
                    new NotNullValidator('Merci de spécifier votre commentaire'),
                ],
            ]));
    }
}
