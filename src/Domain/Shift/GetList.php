<?php
namespace App\Domain\Shift;

use App\Data\Mapper\ShiftMapper;
use Aura\Payload\Payload;
use Spark\Adr\DomainInterface;

class GetList implements DomainInterface
{

    protected $shifts;
    /**
     * @var ShiftMapper
     */
    protected $mapper;

    public function __construct(ShiftMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function __invoke(array $input)
    {
        $payload = new Payload();
        $payload->setStatus(Payload::FOUND);

        $output = [];

        $this->shifts = $this->mapper->getShifts();

        if (!empty($input['user_id']) && ($user_id = $input['user_id'])) {
            $shifts = array_values(array_filter($this->shifts, function($shift) use ($user_id) {
                return $shift['user_id'] == $user_id;
            }));
            $output["meta"]["filters"]["user_id"] = (int)$user_id;
        } else {
            $shifts = $this->shifts;
        }

        $output["shifts"] = $shifts;

        $payload->setOutput($output);

        return $payload;
    }
}