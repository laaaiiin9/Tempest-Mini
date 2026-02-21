<?php

class Validator
{
    protected array $data;
    protected array $rules;
    protected array $errors = [];

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
        $this->validate();
    }

    public static function make(array $data, array $rules): self
    {
        return new static($data, $rules);
    }

    protected function validate(): void
    {
        foreach ($this->rules as $field => $rules) {
            $value = $this->data[$field] ?? null;

            foreach ($rules as $rule) {
                $rule = strtolower((string) $rule);

                if (str_contains($rule, ':')) {
                    [$ruleName, $parameter] = explode(':', $rule, 2);
                } else {
                    $ruleName = $rule;
                    $parameter = null;
                }

                $method = 'validate' . ucfirst($ruleName);

                if (method_exists($this, $method)) {
                    $this->$method($field, $value, $parameter);
                }
            }
        }
    }

    protected function validateRequired(string $field, mixed $value): void
    {
        if ($value === null) {
            $this->errors[$field][] = "$field is required.";
            return;
        }

        if (is_string($value) && trim($value) === '') {
            $this->errors[$field][] = "$field is required.";
            return;
        }

        if (is_array($value) && count($value) === 0) {
            $this->errors[$field][] = "$field is required.";
        }
    }

    protected function validateEmail(string $field, mixed $value): void
    {
        if ($this->shouldSkipTypeValidation($value)) {
            return;
        }

        if (!is_string($value) || !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "Invalid email format.";
        }
    }

    protected function validateMin(string $field, mixed $value, mixed $parameter): void
    {
        if ($this->shouldSkipTypeValidation($value)) {
            return;
        }

        if (!is_numeric($parameter)) {
            return;
        }

        $min = (int) $parameter;

        if (is_string($value) && strlen($value) < $min) {
            $this->errors[$field][] = "$field must be at least $min characters.";
            return;
        }

        if (is_numeric($value) && (float) $value < $min) {
            $this->errors[$field][] = "$field must be at least $min.";
        }
    }

    protected function validateString(string $field, mixed $value): void
    {
        if ($this->shouldSkipTypeValidation($value)) {
            return;
        }

        if (!is_string($value)) {
            $this->errors[$field][] = "$field must be a string.";
        }
    }

    protected function validateNumber(string $field, mixed $value): void
    {
        if ($this->shouldSkipTypeValidation($value)) {
            return;
        }

        if (!is_numeric($value)) {
            $this->errors[$field][] = "$field must be a number.";
        }
    }

    protected function validateInteger(string $field, mixed $value): void
    {
        if ($this->shouldSkipTypeValidation($value)) {
            return;
        }

        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            $this->errors[$field][] = "$field must be an integer.";
        }
    }

    protected function validateFloat(string $field, mixed $value): void
    {
        if ($this->shouldSkipTypeValidation($value)) {
            return;
        }

        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            $this->errors[$field][] = "$field must be a decimal number.";
        }
    }

    protected function validateDecimal(string $field, mixed $value): void
    {
        $this->validateFloat($field, $value);
    }

    protected function shouldSkipTypeValidation(mixed $value): bool
    {
        return $value === null || $value === '';
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
