<?php
namespace MiniFram;

class StringField extends Field
{
    protected $maxLength;
    protected $type;

    public function buildWidget()
    {
        $widget = '';

        if (!empty($this->errorMessage)) {
            $widget .= $this->errorMessage . '<br />';
        }

        if (!empty($this->type)) {
            $widget .= '<input type='.$this->type.' name="' . $this->name . '"';
        } else {
            $widget .= '<label>' . $this->label . '</label><input type="text" name="' . $this->name . '"';
        }

        if (!empty($this->value)) {
            $widget .= ' value="' . htmlspecialchars($this->value) . '"';
        }

        if (!empty($this->maxLength)) {
            $widget .= ' maxlength="' . $this->maxLength . '"';
        }

        if (!empty($this->type)) {
            $widget .= ' type="' . $this->type . '"';
        }

        return $widget .= ' />';
    }

    public function setMaxLength($maxLength)
    {
        $maxLength = (int) $maxLength;

        if ($maxLength > 0) {
            $this->maxLength = $maxLength;
        } else {
            throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
        }
    }

    public function setType($type)
    {
        if (is_string($type)) {
            $this->type = $type;
        }
    }
}
