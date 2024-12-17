<?php
// Class to represent a single form field
class Field {
    private string $name; // the name of the field
    private ?string $message; // optional error message for the field, null if no error
    private bool $hasError = false; // flag to indicate if there's an error

    // Constructor to initialize the field
    public function __construct(string $name, string $message = null) {
        $this->name = $name; // initialize the field name
        $this->message = $message ?? ''; // initialize the error message (null is converted to an empty string)
    }

    // Get the field name
    public function getName(): string {
        return $this->name;
    }

    // Check if the field has an error
    public function hasError(): bool {
        return $this->hasError;
    }

    // Set the error message for the field
    public function setErrorMessage(string $message): void {
        $this->message = $message; // set the error message
        $this->hasError = true; // mark the field as having an error
    }

    // Clear the error message for the field
    public function clearErrorMessage(): void {
        $this->message = ''; // clear the error message
        $this->hasError = false; // mark the field as error-free
    }

    // Get the sanitized HTML for displaying the error message
    public function getHTML(): string {
        $message = htmlspecialchars($this->message, ENT_QUOTES, 'UTF-8'); // sanitize the message for output
        if ($this->hasError()) {
            return '<span class="error">' . $message . '</span>'; // return error message
        } else {
            return '<span>' . $message . '</span>'; // return sanitized message
        }
    }
}

// Class to represent a collection of fields
class Fields {
    private array $fields = []; // array to hold multiple fields

    // Add a new field to the collection
    public function addField(string $name, string $message = ''): void {
        try {
            $field = new Field($name, $message); // create a new Field object
            $this->fields[$field->getName()] = $field; // add the field to the array
        } catch (Exception $e) {
            // Log the error (this can be done to a log file or a service)
            error_log("Error adding field: " . $e->getMessage());
        }
    }

    // Get a field by its name
    public function getField(string $name): ?Field {
        return $this->fields[$name] ?? null; // return the field or null if it doesn't exist
    }

    // Check if any field has an error
    public function hasErrors(): bool {
        foreach ($this->fields as $field) {
            if ($field->hasError()) {
                return true; // return true if any field has an error
            }
        }
        return false; // return false if no errors found
    }
}
