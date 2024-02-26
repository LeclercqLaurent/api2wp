<?php

namespace App\Controller;

use App\Model\Contact;
use App\Model\Place;
use App\Model\Result;
use App\Service\Api;
use App\Service\Settings;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class ResultController
{
    private array $attributes;
    private array $settings;

    public function __construct($attributes)
    {
        $settings = new Settings($attributes);

        $this->attributes = $attributes;
        $this->settings   = $settings->getSettings();
    }

    private function getApiContent(): array
    {
        $params = [];
        foreach ($this->settings['values'] as $id => $value) {
            $chaine[$value][] = $_GET[$id];
            if (isset ($_GET[$id])) {
                if (is_array($_GET[$id])) {
                    foreach ($_GET[$id] as $value_unique) {
                        $params[] = $value . "[]=" . $value_unique;
                    }
                } else {$params[] = $value . "=" . $_GET[$id];
                }
            }
        }
        $params  = implode('&', $params);
        $params .= "&go=1";

        $url  = API::getApiUrl() . "structure?structureThematic.slug=".$this->attributes['thematic'].'&'.$params;
        $data = API::get($url);
        $data = is_array($data) ? $data : [];

        return $data['hydra:member'] ?? [];
    }

    public function getResults(): ?string
    {
        if ($_GET['go'] == 1) {
            try {
                $members    = $this->getApiContent();
                $structures = $this->buildStructures($members);

                $loader = new FilesystemLoader(API2WP_TEMPLATE_DIR);
                $twig   = new Environment($loader);

                return $twig->render($this->attributes['thematic'].'/results.html.twig', ['results' => $structures]);
            } catch(SyntaxError|RuntimeError|LoaderError $e) {
                return $e->getMessage();
            }
        }
        return null;
    }

    private function buildStructures($structures): array
    {
        $tmp = [];
        foreach ($structures as $structure) {
            $departmentText = $structure['department']['label'] . " - (" . $structure['department']['code'] . ")";
            if ($structure['department']['code'] === '00') {
                $departmentText = $structure['department']['label'] . " ";
            }
            $establishment = $structure['establishment']['name'] ?? null;
            if ('' !== trim($establishment)) {
                $establishmentStatus = $structure['establishment']['status'] ?? null;
                if ('private' === $establishmentStatus) {
                    $establishment .= " (Privé)";
                } else {
                    $establishment .= " (Public)";
                }
            }
            $structureType = $structure['structureType']['label'] ?? null;
            if ('' !== trim($structureType)) {
                $structureTypeCode = $structure['structureType']['code'] ?? null;
                if(!is_null($structureTypeCode)) {
                    $structureType = "$structureTypeCode - $structureType";
                }
            }

            $result = new Result();
            $result->setTitle($structure['title'])
                ->setDescription($structure['description'])
                ->setDepartment($departmentText)
                ->setEstablishment($establishment)
                ->setStructureType($structureType);

            if (isset($structure['receptionTerm'])) {
                foreach ($structure['receptionTerm'] as $receptionTerm) {
                    $result->addReceptionTerm($receptionTerm['label']);
                }
            }

            if (isset($structure['workType'])) {
                foreach ($structure['workType'] as $work) {
                    $result->addWork($work['label']);
                }
            }


            if (isset($structure['speciality'])) {
                foreach ($structure['speciality'] as $speciality) {
                    $result->addSpeciality($speciality['label']);
                }
            }


            if (isset($structure['age'])) {
                foreach ($structure['age'] as $age) {
                    $result->addAge($age['value']);
                }
            }

            foreach ($structure['place'] as $structure_place) {
                $place = new Place();
                $place->setLabel($structure_place['title'])
                    ->setStreetNumber($structure_place['number'])
                    ->setStreet($structure_place['street'])
                    ->setAdditionalAddress($structure_place['additionalAddress'])
                    ->setPostCode($structure_place['zipCode'])
                    ->setCity($structure_place['city']);

                foreach ($structure_place['contact'] as $structure_contact) {
                    $contact = new Contact();
                    $contact->setType($structure_contact['type'])
                        ->setValue($structure_contact['value']);
                    $place->addContact($contact);
                }
                $result->addPlace($place);
            }
            $tmp[] = $result;
        }
        return $tmp;
    }
}
