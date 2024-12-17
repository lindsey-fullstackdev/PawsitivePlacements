<?php

/**
 * @method Valid()
 */
class Validate {
    private Fields $fields;

    public function __construct() {
        $this->fields = new Fields();
    }

    /**
     * Gets the fields object used for validation.
     * 
     * @return Fields Returns the fields object.
     */
    public function getFields(): Fields
    {
        return $this->fields;
    }

    /**
     * Validates a generic text field.
     * 
     * @param string $name The name of the field to validate.
     * @param string $value The value to validate.
     * @param bool $required Whether the field is required. Default is true.
     * @param int $min The minimum length of the field. Default is 1.
     * @param int $max The maximum length of the field. Default is 255.
     * @return void
     */
    public function text($name, $value, $required = true, $min = 1, $max = 255): void
    {
        $field = $this->fields->getField($name);

        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        if ($required && empty($value)) {
            $field->setErrorMessage('Required.');
        } elseif (strlen($value) < $min) {
            $field->setErrorMessage('Too short.');
        } elseif (strlen($value) > $max) {
            $field->setErrorMessage('Too long.');
        } else {
            $field->clearErrorMessage();
        }
    }

    /**
     * Validates a field with a given regular expression pattern.
     * 
     * @param string $name The name of the field to validate.
     * @param string $value The value to validate.
     * @param string $pattern The regular expression pattern to match.
     * @param string $message The error message to display if validation fails.
     * @param bool $required Whether the field is required. Default is true.
     * @return void
     */
    public function pattern($name, $value, $pattern, $message, $required = true): void
    {
        $field = $this->fields->getField($name);

        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        $match = preg_match($pattern, $value);
        if ($match === false) {
            $field->setErrorMessage('Error testing field.');
        } elseif ($match != 1) {
            $field->setErrorMessage($message);
        } else {
            $field->clearErrorMessage();
        }
    }

    /**
     * Validates the first line of an address.
     * 
     * @param string $name The name of the field to validate.
     * @param string $value The value to validate.
     * @param bool $required Whether the field is required. Default is true.
     * @return void
     */
    public function line1($name, $value, $required = true): void
    {
        $this->text($name, $value, $required);
    }

    /**
     * Validates the second line of an address.
     * 
     * @param string $name The name of the field to validate.
     * @param string $value The value to validate.
     * @param bool $required Whether the field is required. Default is false.
     * @return void
     */
    public function line2($name, $value, $required = false): void
    {
        $this->text($name, $value, $required, 0); // Optional field
    }

    /**
     * Validates the city field.
     * 
     * @param string $name The name of the field to validate.
     * @param string $value The value to validate.
     * @param bool $required Whether the field is required. Default is true.
     * @return void
     */
    public function city($name, $value, $required = true): void
    {
        $this->text($name, $value, $required);
    }

    /**
     * Validates the province field.
     * 
     * @param string $name The name of the field to validate.
     * @param string $value The value to validate.
     * @param bool $required Whether the field is required. Default is true.
     * @return void
     */
    public function province($name, $value, $required = true): void
    {
        $this->text($name, $value, $required);
    }

    /**
     * Validates the postal code field.
     * 
     * @param string $name The name of the field to validate.
     * @param string $value The value to validate.
     * @param bool $required Whether the field is required. Default is true.
     * @return void
     */
    public function postal_code($name, $value, $required = true): void
    {
        $field = $this->fields->getField($name);

        if ($required && empty($value)) {
            $field->setErrorMessage('Postal code is required.');
            return;
        }

        // Pattern for Canadian postal codes (A1A 1A1)
        $pattern = '/^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/';
        $message = 'Invalid postal code format (use A1A 1A1).';
        $this->pattern($name, $value, $pattern, $message, $required);
    }

    /**
     * Validates the phone number field.
     * 
     * @param string $name The name of the field to validate.
     * @param string $value The value to validate.
     * @param bool $required Whether the field is required. Default is false.
     * @return void
     */
    public function phone($name, $value, $required = false): void
    {
        $field = $this->fields->getField($name);
        $this->text($name, $value, $required);

        if ($field->hasError()) { return; }

        // Validate phone number format (e.g., 123-456-7890)
        $pattern = '/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/';
        $message = 'Invalid phone number format. Use 123-456-7890.';
        $this->pattern($name, $value, $pattern, $message, $required);
    }

    /**
     * Validates the email field.
     * 
     * @param string $name The name of the field to validate.
     * @param string $value The value to validate.
     * @param bool $required Whether the field is required. Default is true.
     * @return void
     */
    public function email($name, $value, $required = true): void
    {
        $field = $this->fields->getField($name);

        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        $this->text($name, $value, $required);
        if ($field->hasError()) { return; }

        // Email validation
        $parts = explode('@', $value);
        if (count($parts) != 2) {
            $field->setErrorMessage('Invalid email format.');
            return;
        }

        // Check lengths of local and domain parts
        if (strlen($parts[0]) > 64 || strlen($parts[1]) > 255) {
            $field->setErrorMessage('Email parts are too long.');
            return;
        }

        $localPattern = '/^[A-Za-z0-9._%+-]+$/';
        $domainPattern = '/^[A-Za-z0-9.-]+\.[A-Z|a-z]{2,7}$/';

        if (!preg_match($localPattern, $parts[0])) {
            $field->setErrorMessage('Invalid characters in email local part.');
            return;
        }

        if (!preg_match($domainPattern, $parts[1])) {
            $field->setErrorMessage('Invalid domain in email address.');
        }
    }
}

?>
