<?php

namespace App\Service;

class Settings
{
    private array $attributes;

    private array $settings;

    public function __construct($attributes)
    {
        if (!defined('API2WP_DIR')) {
            define('API2WP_DIR', WP_PLUGIN_DIR.'/api2wp/');
        }
        if (!defined('API2WP_TEMPLATE_DIR')) {
            define('API2WP_TEMPLATE_DIR', API2WP_DIR.'template/');
        }

        $this->attributes = $attributes;
    }

    public function getSettings(): array
    {
        return $this->buildSettingsFromAttributes();
    }

    private function buildSettingsFromAttributes(): array
    {
        $settings = [
            'page1' => [
                'search_options' => ['age', 'reception_term', 'department', 'speciality'],
                'titles'         => [
                    'age'            => 'Age ',
                    'reception_term' => 'Types de ressources',
                    'department'     => 'Territoires',
                    'speciality'     => 'Thématiques',
                ],
                'values'         => [
                    'age'            => 'age.id',
                    'reception_term' => 'receptionTerm.id',
                    'department'     => 'department.id',
                    'speciality'     => 'speciality.id',
                    'work_type'      => 'workType.id'
                ],
                'input_type'         => [
                    'age'            => 'checkbox',
                    'reception_term' => 'checkbox',
                    'department'     => 'checkbox',
                    'speciality'     => 'checkbox',
                    'work_type'      => 'checkbox'
                ],
            ],
            'page2' => [
                'search_options' => [
                    'age',
                    'reception_term',
                    'department',
                    'speciality',
                    'structure_type',
                    'postCode'
                ],
                'titles'         => [
                    'age'            => 'Age ',
                    'reception_term' => "Modalités d'accueil",
                    'department'     => 'Territoires',
                    'speciality'     => 'Spécialité',
                    'structure_type' => 'Type de structure',
                    'postCode'       => 'Rechercher avec votre code postal'
                ],
                'values'         => [
                    'age'            => 'age.id',
                    'reception_term' => 'receptionTerm.id',
                    'department'     => 'department.id',
                    'speciality'     => 'speciality.id',
                    'structure_type' => 'structureType.id',
                    'postCode'       => 'postCode',
                    'distance'       => 'distance'
                ],
                'input_type'         => [
                    'age'            => 'checkbox',
                    'reception_term' => 'checkbox',
                    'department'     => 'checkbox',
                    'speciality'     => 'checkbox',
                    'structure_type' => 'select',
                    'postCode'       => 'postCode'
                ],
            ],
        ];

        return $settings[$this->attributes['thematic']] ?? [];
    }
}
