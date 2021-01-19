<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @UniqueEntity(
 *     fields={"code","name"},
 *     message="Este dato ya esta registrado"
 * ) 
 */
class Product
{

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @ORM\JoinColumn(name="category", referencedColumnName="id",nullable=true)
     */
    private $category;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Este dato es obligatorio")    
     * @Assert\Length(
     *      min = 4,
     *      max = 10,
     *      minMessage = "Este dato debe ser mayor a 4 carácter"
     * )
     * @Assert\Regex(
     *     pattern="/^[A-Za-z0-9]+$/",
     *     match=true,
     *     message="Solo Letras o Números"
     * )             
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $code;

    /**
     * @Assert\NotBlank(message="Este dato es obligatorio")   
     * @Assert\Length(
     *      min = 4,
     *      max = 255,
     *      minMessage = "Este dato debe ser mayor a 4 carácter"
     * )       
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @Assert\NotBlank(message="Este dato es obligatorio")          
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @Assert\NotBlank(message="Este dato es obligatorio")          
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $mark;

    /**
     * @Assert\NotBlank(message="Este dato es obligatorio") 
     * @Assert\Regex(
     *     pattern="/^([0-9])*$/",
     *     match=true,
  *      message = "Ingrese un Número"
     * )     
     * @ORM\Column(type="float")
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(?string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
