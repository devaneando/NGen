<?php


namespace App\Model;

use App\Exception\Model\InvalidGenderException;
use App\Exception\Model\InvalidNameException;
use App\Exception\Model\InvalidTypeException;

/**
 * Represent a single name, be it a first, a middle or a last name.
 */
class NameModel
{
    public const GENDER_FEMALE = 'F';
    public const GENDER_MALE = 'M';
    public const GENDER_UNDEFINED = 'U';
    public const TYPE_FIRST_NAME = 'F';
    public const TYPE_LAST_NAME = 'L';
    public const TYPE_MIDDLE_NAME = 'M';
    public const MAX_NAME_LENGTH = 60;

    /** Is it male, female, etc... */
    private ?string $gender = null;

    /** Is it first, middle or last name. */
    private ?string $type = null;

    /** The name itself. */
    private ?string $name = null;

    public function __construct(string $gender = null, string $type = null, string $name = null)
    {
        if (!empty($gender)) {
            $this->setGender($gender);
        }

        if (!empty($type)) {
            $this->setType($type);
        }

        if (!empty($name)) {
            $this->setName($name);
        }
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = static::validateGender($gender);

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = static::validateType($type);

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name):self
    {
        $this->name = static::validateName($name);

        return $this;
    }

    /** Validate the NameModel. */
    public function isValid(): bool
    {
        if (!empty($this->gender)
            || !empty($this->type)
            || !empty($this->name)) {
            return false;
        }

        return true;
    }

    /**
     * Validate the gender.
     *
     * @throws InvalidGenderException
     */
    public static function validateGender(string $gender): string
    {
        if (in_array(trim($gender), [static::GENDER_FEMALE, static::GENDER_MALE, static::GENDER_UNDEFINED])) {
            return trim($gender);
        }

        throw new InvalidGenderException();
    }

    /**
     * Validate the type.
     *
     * @throws InvalidTypeException
     */
    public static function validateType(string $type): string
    {
        if (in_array(trim($type), [static::TYPE_FIRST_NAME, static::TYPE_LAST_NAME, static::TYPE_MIDDLE_NAME])) {
            return trim($type);
        }

        throw new InvalidTypeException();
    }

    /**
     * Validate the name.
     *
     * @throws InvalidNameException
     */
    public static function validateName(string $name): string
    {
        if (empty($name) || static::MAX_NAME_LENGTH < strlen(trim($name))) {
            throw new InvalidNameException();
        }

        return trim($name);
    }
}
