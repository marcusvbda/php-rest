<?php

namespace MyRest\Model;

use OpenApi\Attributes as OA;

/**
 * Class ExampleCrud
 * @package MyRest\Model
 */
#[OA\Schema(required: ["id", "name"], type: "object", xml: new OA\Xml(name: "ExampleCrud"))]
class ExampleCrud
{

    /**
     * @var int|null
     */
    #[OA\Property(type: "integer", format: "int32")]
    protected ?int $id = null;

    /**
     * @var string|null
     */
    #[OA\Property(type: "string", format: "string")]
    protected ?string $name = null;

    /**
     * @var string|null
     */
    #[OA\Property(type: "string", format: "date-time", nullable: true)]
    protected ?string $birthdate = null;

    /**
     * @var int|null
     */
    #[OA\Property(type: "integer", format: "int32", nullable: true)]
    protected ?int $code = null;

    /**
     * @var string|null
     */
    #[OA\Property(type: "string", format: "string", nullable: true)]
    protected ?string $status = null;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return ExampleCrud
     */
    public function setId(?int $id): ExampleCrud
    {
        $this->id = $id;
        return $this;
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
     * @return ExampleCrud
     */
    public function setName(?string $name): ExampleCrud
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBirthdate(): ?string
    {
        return $this->birthdate;
    }

    /**
     * @param string|null $birthdate
     * @return ExampleCrud
     */
    public function setBirthdate(?string $birthdate): ExampleCrud
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCode(): ?int
    {
        return $this->code;
    }

    /**
     * @param int|null $code
     * @return ExampleCrud
     */
    public function setCode(?int $code): ExampleCrud
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @var string|null
     */
    #[OA\Property(type: "string", format: "string", nullable: true)]
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return ExampleCrud
     */
    public function setStatus(?string $status): ExampleCrud
    {
        $this->status = $status;
        return $this;
    }
}
