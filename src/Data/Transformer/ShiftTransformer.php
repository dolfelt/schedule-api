<?php
namespace App\Data\Transformer;

use App\Data\Entity\Shift;
use App\Data\Transformer;

class ShiftTransformer extends Transformer
{
    public function __invoke(Shift $entity)
    {
        return [
            'id'          => (int) $entity->getId(),
            'account_id'  => (int) $entity->getAccountId(),
            'user_id'     => (int) $entity->getUserId(),
            'location_id' => (int) $entity->getLocationId(),
            'position_id' => (int) $entity->getPositionId(),
            'start_time'  => $entity->getDate('start_time')->format('r'),
            'end_time'    => $entity->getDate('end_time')->format('r'),
        ] + $this->getDefaults($entity);
    }
}