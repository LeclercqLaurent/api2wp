<?php

namespace App\Model;

class Contact
{
    private string $type;
    private string $value;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Contact
     */
    public function setType(string $type): Contact
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return Contact
     */
    public function setValue(string $value): Contact
    {
        $this->value = $value;
        return $this;
    }

}
