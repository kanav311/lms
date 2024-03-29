<?php

declare(strict_types=1);

namespace Laminas\Form\Element;

use Laminas\Form\Exception\InvalidArgumentException;
use Laminas\Validator\Explode as ExplodeValidator;
use Laminas\Validator\InArray as InArrayValidator;
use Laminas\Validator\ValidatorInterface;

use function assert;
use function is_array;
use function is_iterable;
use function trigger_error;

use const E_USER_DEPRECATED;

/**
 * @psalm-type ValueOptionSpec = array<string, string>|list<array{
 *     label: non-empty-string,
 *     value: non-empty-string,
 *     selected?: bool,
 *     disabled?: bool,
 *     attributes?: array<string, scalar|null>,
 *     label_attributes?: array<string, scalar|null>,
 * }>
 */
class MultiCheckbox extends Checkbox
{
    /** @var array<string, scalar|null>  */
    protected $attributes = [
        'type' => 'multi_checkbox',
    ];

    /** @var bool */
    protected $disableInArrayValidator = false;

    /** @var bool */
    protected $useHiddenElement = false;

    /** @var null|string */
    protected $uncheckedValue;

    /** @var ValueOptionSpec */
    protected $valueOptions = [];

    /**
     * @return ValueOptionSpec
     */
    public function getValueOptions(): array
    {
        return $this->valueOptions;
    }

    /**
     * @param ValueOptionSpec $options
     * @return $this
     */
    public function setValueOptions(array $options)
    {
        $this->valueOptions = $options;

        // Update Explode validator haystack
        if ($this->validator instanceof ExplodeValidator) {
            $validator = $this->validator->getValidator();
            assert($validator instanceof InArrayValidator);
            $validator->setHaystack($this->getValueOptionsValues());
        }

        return $this;
    }

    /**
     * Unset a value option
     *
     * This method will only unset a value option when the element was created with a simple array of key-value pairs
     * for value options, for example ['value1' => 'label1', 'value2' => 'label2']
     *
     * @return $this
     */
    public function unsetValueOption(string $key)
    {
        if (isset($this->valueOptions[$key])) {
            unset($this->valueOptions[$key]);
        }

        return $this;
    }

    /**
     * Set options for an element. Accepted options are:
     * - label: label to associate with the element
     * - label_attributes: attributes to use when the label is rendered
     * - value_options: list of values and labels for the select options
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setOptions(iterable $options)
    {
        parent::setOptions($options);

        if (isset($this->options['value_options'])) {
            $this->setValueOptions($this->options['value_options']);
        }
        // Alias for 'value_options'
        if (isset($this->options['options'])) {
            $this->setValueOptions($this->options['options']);
        }
        if (isset($this->options['disable_inarray_validator'])) {
            $this->setDisableInArrayValidator($this->options['disable_inarray_validator']);
        }

        return $this;
    }

    /** @inheritDoc */
    public function setAttribute(string $key, $value)
    {
        /** @psalm-suppress DocblockTypeContradiction */
        if ($key === 'options' && is_iterable($value)) {
            trigger_error(
                'Providing multi-checkbox value options via attributes is deprecated and will be removed in '
                . 'version 4.0 of this library',
                E_USER_DEPRECATED,
            );
            $this->setValueOptions($value);
            return $this;
        }
        return parent::setAttribute($key, $value);
    }

    /**
     * Set the flag to allow for disabling the automatic addition of an InArray validator.
     *
     * @return $this
     */
    public function setDisableInArrayValidator(bool $disableOption)
    {
        $this->disableInArrayValidator = $disableOption;
        return $this;
    }

    /**
     * Get the disable in array validator flag.
     */
    public function disableInArrayValidator(): bool
    {
        return $this->disableInArrayValidator;
    }

    /**
     * Get validator
     */
    protected function getValidator(): ?ValidatorInterface
    {
        if (null === $this->validator && ! $this->disableInArrayValidator()) {
            $inArrayValidator = new InArrayValidator([
                'haystack' => $this->getValueOptionsValues(),
                'strict'   => false,
            ]);
            $this->validator  = new ExplodeValidator([
                'validator'      => $inArrayValidator,
                'valueDelimiter' => null, // skip explode if only one value
            ]);
        }
        return $this->validator;
    }

    /**
     * Get only the values from the options attribute
     *
     * @return array
     */
    protected function getValueOptionsValues(): array
    {
        $values  = [];
        $options = $this->getValueOptions();
        foreach ($options as $key => $optionSpec) {
            $value    = is_array($optionSpec) ? $optionSpec['value'] : $key;
            $values[] = $value;
        }
        if ($this->useHiddenElement()) {
            $values[] = $this->getUncheckedValue();
        }
        return $values;
    }

    /**
     * Sets the value that should be selected.
     *
     * @param  mixed $value The value to set.
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
