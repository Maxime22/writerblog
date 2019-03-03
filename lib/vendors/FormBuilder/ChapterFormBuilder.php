<?php
namespace FormBuilder;

use \MiniFram\FormBuilder;
use \MiniFram\MaxLengthValidator;
use \MiniFram\NotNullValidator;
use \MiniFram\StringField;
use \MiniFram\TextField;

class ChapterFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form // the data will be checked by the validator when we post a form
            ->add(new StringField([
                'label' => 'Auteur',
                'name' => 'author',
                'type' => 'hidden',
                'value' => 'Jean Forteroche',
                'maxLength' => 20,
                'validators' => [
                    new MaxLengthValidator('L\'auteur spécifié est trop long (20 caractères maximum)', 20),
                    new NotNullValidator('Merci de spécifier l\'auteur du chapitre'),
                ],
            ]))
            ->add(new StringField([
                'label' => 'Titre',
                'name' => 'title',
                'maxLength' => 100,
                'validators' => [
                    new MaxLengthValidator('Le titre spécifié est trop long (100 caractères maximum)', 100),
                    new NotNullValidator('Merci de spécifier le titre du chapitre'),
                ],
            ]))
            ->add(new TextField([
                'label' => 'Contenu',
                'name' => 'content',
                'rows' => 8,
                'cols' => 60,
                'validators' => [
                    new NotNullValidator('Merci de spécifier le contenu du chapitre'),
                ],
            ]));
    }
}
