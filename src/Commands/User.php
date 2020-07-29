<?php


namespace Merus\WAB\Commands;


use InvalidArgumentException;
use Merus\WAB\Database\DB;

class User
{
    protected ?string $name;
    protected string $number;

    public function __construct(string $number, ?string $name)
    {
        $this->number = $number;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * Updates the user's information
     *
     * @param DB $db
     * @return mixed
     */
    public function update(DB $db)
    {
        if (!$this->getNumber()) {
            throw new InvalidArgumentException("User's UID is not defined");
        }

        return $db->update('users', [
            'name' => $this->getName()
        ], [
            'uid' => $this->getNumber()
        ]);
    }

    public static function fromObject(object $user)
    {
        return new User($user->uid, $user->name);
    }
}