<?php

namespace App\Model;

class Place
{
    private ?string $label;
    private ?string $street_number;
    private ?string $street;
    private ?string $additional_address;
    private ?string $post_code;
    private ?string $city;
    private array   $contacts;

    public function __construct()
    {
        $this->contacts = [];
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     * @return Place
     */
    public function setLabel(?string $label): Place
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreetNumber(): ?string
    {
        return $this->street_number;
    }

    /**
     * @param string|null $street_number
     * @return Place
     */
    public function setStreetNumber(?string $street_number): Place
    {
        $this->street_number = $street_number;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     * @return Place
     */
    public function setStreet(?string $street): Place
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdditionalAddress(): ?string
    {
        return $this->additional_address;
    }

    /**
     * @param string|null $additional_address
     * @return Place
     */
    public function setAdditionalAddress(?string $additional_address): Place
    {
        $this->additional_address = $additional_address;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostCode(): ?string
    {
        return $this->post_code;
    }

    /**
     * @param string|null $post_code
     * @return Place
     */
    public function setPostCode(?string $post_code): Place
    {
        $this->post_code = $post_code;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return Place
     */
    public function setCity(?string $city): Place
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return array
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * @param array $contacts
     * @return Place
     */
    public function setContacts(array $contacts): Place
    {
        $this->contacts = $contacts;
        return $this;
    }

    /**
     * @param Contact $contact
     * @return Place
     */
    public function addContact(Contact $contact): Place
    {
        $this->contacts[] = $contact;
        return $this;
    }


}
