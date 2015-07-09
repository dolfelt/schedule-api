<?php
namespace App\Domain\Position;

use App\Data\Mapper\PositionMapper;
use App\Data\Paginate;
use Aura\Payload\Payload;
use Spark\Adr\DomainInterface;

class GetList implements DomainInterface
{

    /**
     * @var PositionMapper
     */
    protected $mapper;

    public function __construct(PositionMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function __invoke(array $input)
    {
        $input += [
            'q' => false,
        ] + Paginate::$defaultOptions;

        $payload = new Payload();
        $payload->setStatus(Payload::FOUND);

        $output = [];

        $options = array_filter([
            'search' => $input['q'],
            'limit'  => $input['limit'], // TODO: Simplify this so I don't need to pass the vars somehow.
            'page'   => $input['page'],
        ]);

        list($positions, $paginate) = $this->mapper->getPositions($options);

        $output['meta']['paginate'] = $paginate->getMeta();

        $output['positions'] = $positions;

        $payload->setOutput($output);

        return $payload;
    }
}