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
            $widget .= '<input class="form-control" type='.$this->type.' name="' . $this->name . '"';
        } else {
            $widget .= '<label class="labelInput" >' . $this->label . '</label><input class="form-control" type="text" name="' . $this->name . '"';
        }

        if (!empty($this->value)) {
            $widget .= ' value="' . htmlspecialchars($this->value) . '"';
        }

        if (!empty($this->maxLength)) {
            $widget .= ' maxlength="' . $this->maxLength . '"';
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
