<?php
namespace MiniFram;

class Form
{
    protected $entity;
    protected $fields = [];

    public function __construct(Entity $entity)
    {
        $this->setEntity($entity);
    }

    public function add(Field $field)
    {
        $attr = $field->name(); // We take the name of the field
        $field->setValue($this->entity->$attr()); // We assign the value to the field

        $this->fields[] = $field; // We add the field to the table fields
        return $this;
    }

    public function createView()
    {
        $view = '';

        // We create one by one each field of the form
        foreach ($this->fields as $field) {
            $view .= $field->buildWidget() . '<br />';
        }

        return $view;
    }

    public function isValid()
    {
        $valid = true;

        // We check if all the fields are valid
        foreach ($this->fields as $field) {
            if (!$field->isValid()) {
                $valid = false;
            }
        }

        return $valid;
    }

    public function entity()
    {
        return $this->entity;
    }

    public function setEntity(Entity $entity)
    {
        $this->entity = $entity;
    }
}
