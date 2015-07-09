<?php
namespace App\Data;

abstract class Transformer
{
    /**
     * @param Entity $entity
     * @return array
     */

    protected function getDefaults(Entity $entity)
    {
        $output = [];

        if ($entity->has('updated_at')) {
            $output['updated_at'] = $entity->getDate('updated_at')->format('r');
        }
        if ($entity->has('created_at')) {
            $output['created_at'] = $entity->getDate('created_at')->format('r');
        }

        return $output;
    }
}