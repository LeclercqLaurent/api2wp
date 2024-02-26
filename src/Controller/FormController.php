<?php

namespace App\Controller;

use App\Service\Api;
use App\Service\Settings;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class FormController
{
    private string $formUrl;
    private array $attributes;
    private array $settings;

    public function __construct($attributes)
    {
        $settings = new Settings($attributes);
        $this->attributes = $attributes;
        $this->formUrl    = site_url().$attributes['url'];
        $this->settings   = $settings->getSettings();
    }

    /**
     */
    public function getForm(): ?string
    {
        try {
            $loader = new FilesystemLoader(API2WP_TEMPLATE_DIR);
            $twig   = new Environment($loader);

            $sections = [];
            foreach($this->settings['search_options'] as $search_option) {
                $sections[] = $this->buildOptions($search_option);
            }

            return $twig->render($this->attributes['thematic'].'/form.html.twig', [
                'get'      => $_GET,
                'form_url' => $this->formUrl,
                'settings' => $this->settings,
                'sections' => $sections
            ]);
        } catch(SyntaxError|RuntimeError|LoaderError $e) {
            return $e->getMessage();
        }
    }

    private function buildOptions($search_option): array
    {
        $url     = API::getApiUrl() . $search_option . '?structureThematic.slug='.$this->attributes['thematic'];
        $data    = API::get($url);
        $data    = is_array($data) ? $data : [];
        $members = $data['hydra:member'] ?? [];
        $options = [
            'label'   => $search_option,
            'options' => []
        ];

        foreach ($members as $tmp) {
            $id           = $tmp['id']     ?? 0;
            $weight       = $tmp['weight'] ?? 0;
            $option_value = $tmp['value']  ?? null;
            if ('structure_type' === $search_option) {
                $option_value = $tmp['code'] ?? null;
            }
            if (is_null($option_value)) {
                $option_value = $tmp['label'] ?? null;
            }
            if (is_null($option_value)) {
                $option_value = $tmp['name'] ?? 'NC';
            }
            $options['options'][] = [
                'id'     => $id,
                'weight' => $weight,
                'value'  => $option_value
            ];
        }
        usort($options['options'], "cmp");

        return $options;
    }
}
