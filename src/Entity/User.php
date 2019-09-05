<?php

namespace App\Entity;

use App\Entity\Role;
use App\Entity\Datas;
use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Security\Core\Role\Role;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 */

class User implements UserInterface

{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 2,
     * max = 100,
     * minMessage = " Le Prénom doit comporter au minimum {{ limit }} caractères",
     * maxMessage = "Le Prénom doit comporter au maximum {{ limit }} caractères ")
     */
     
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 2,
     * max = 100,
     * minMessage = " Le Nom doit comporter au minimum {{ limit }} caractères",
     * maxMessage = "Le Nom doit comporter au maximum {{ limit }} caractères ")
     */
     
    private $lastName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Datas", mappedBy="author")
     */
    private $datas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hash;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", mappedBy="users")
     */
    private $userRoles;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $presentation;

    public $passwordConfirm;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eglise;
  
    public function __construct()
    {
        $this->datas = new ArrayCollection();
        $this->userRoles = new ArrayCollection(); 
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection|Datas[]
     */
    public function getDatas(): Collection
    {
        return $this->datas;
    }

    public function addData(Datas $data): self
    {
        if (!$this->datas->contains($data)) {
            $this->datas[] = $data;
            $data->setAuthor($this);
        }

        return $this;
    }

    public function removeData(Datas $data): self
    {
        if ($this->datas->contains($data)) {
            $this->datas->removeElement($data);
            // set the owning side to null (unless already changed)
            if ($data->getAuthor() === $this) {
                $data->setAuthor(null);
            }
        }

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    //implémentation de la UserInterface 

    public function getRoles(){
        $roles=$this->userRoles->map(function($role){
            return $role->getTitle();
         })->toArray();
         $roles[] = 'ROLE_USER';
         
         return $roles;
         dump($roles);
    }

    public function getPassword(){
        return $this->hash;
    }

    public function getSalt() {}

    public function getUsername() {
        return $this->email;
    }

    public function eraseCredentials() {}

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|Role[]
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(Role $userRole): self
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles[] = $userRole;
            $userRole->addUser($this);
        }
        return $this;
    }

    public function removeUserRole(Role $userRole): self
    {
        if ($this->userRoles->contains($userRole)) {
            $this->userRoles->removeElement($userRole);
            $userRole->removeUser($this);
        }

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(?string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getEglise(): ?string
    {
        return $this->eglise;
    }

    public function setEglise(string $eglise): self
    {
        $this->eglise = $eglise;

        return $this;
    }

    

    // EO implémentation UserInterface

}
