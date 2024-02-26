<?php

namespace App\Model;

class Result
{
    private ?string $title;
    private ?string $description;
    private string  $department;
    private ?string $geographic_area;
    private ?string $structure_type;
    private ?string $establishment;
    private array   $ages;
    private array   $reception_terms;
    private array   $works;
    private array   $specialities;
    private array   $places;

    public function __construct()
    {
        $this->ages            = [];
        $this->reception_terms = [];
        $this->works           = [];
        $this->specialities    = [];
        $this->places          = [];
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Result
     */
    public function setTitle(?string $title): Result
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Result
     */
    public function setDescription(?string $description): Result
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDepartment(): string
    {
        return $this->department;
    }

    /**
     * @param string $department
     * @return Result
     */
    public function setDepartment(string $department): Result
    {
        $this->department = $department;
        return $this;
    }

    /**
     * @return array
     */
    public function getPlaces(): array
    {
        return $this->places;
    }

    /**
     * @param array $places
     * @return Result
     */
    public function setPlaces(array $places): Result
    {
        $this->places = $places;
        return $this;
    }

    /**
     * @param Place $place
     * @return Result
     */
    public function addPlace(Place $place): Result
    {
        $this->places[] = $place;
        return $this;
    }

    /**
     * @return array
     */
    public function getAges(): array
    {
        return $this->ages;
    }

    /**
     * @param array $ages
     * @return Result
     */
    public function setAges(array $ages): Result
    {
        $this->ages = $ages;
        return $this;
    }

    /**
     * @param string $age
     * @return Result
     */
    public function addAge(string $age): Result
    {
        $this->ages[] = $age;
        return $this;
    }

    /**
     * @return array
     */
    public function getReceptionTerms(): array
    {
        return $this->reception_terms;
    }

    /**
     * @param array $reception_terms
     * @return Result
     */
    public function setReceptionTerms(array $reception_terms): Result
    {
        $this->reception_terms = $reception_terms;
        return $this;
    }

    /**
     * @param string $reception_term
     * @return Result
     */
    public function addReceptionTerm(string $reception_term): Result
    {
        $this->reception_terms[] = $reception_term;
        return $this;
    }

    /**
     * @return array
     */
    public function getWorks(): array
    {
        return $this->works;
    }

    /**
     * @param array $works
     * @return Result
     */
    public function setWorks(array $works): Result
    {
        $this->works = $works;
        return $this;
    }

    /**
     * @param string $work
     * @return Result
     */
    public function addWork(string $work): Result
    {
        $this->works[] = $work;
        return $this;
    }

    /**
     * @return array
     */
    public function getSpecialities(): array
    {
        return $this->specialities;
    }

    /**
     * @param array $specialities
     * @return Result
     */
    public function setSpecialities(array $specialities): Result
    {
        $this->specialities = $specialities;
        return $this;
    }

    /**
     * @param string $speciality
     * @return Result
     */
    public function addSpeciality(string $speciality): Result
    {
        $this->specialities[] = $speciality;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGeographicArea(): ?string
    {
        return $this->geographic_area;
    }

    /**
     * @param string|null $geographic_area
     * @return Result
     */
    public function setGeographicArea(?string $geographic_area): Result
    {
        $this->geographic_area = $geographic_area;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStructureType(): ?string
    {
        return $this->structure_type;
    }

    /**
     * @param string|null $structure_type
     * @return Result
     */
    public function setStructureType(?string $structure_type): Result
    {
        $this->structure_type = $structure_type;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEstablishment(): ?string
    {
        return $this->establishment;
    }

    /**
     * @param string|null $establishment
     * @return Result
     */
    public function setEstablishment(?string $establishment): Result
    {
        $this->establishment = $establishment;
        return $this;
    }


}
