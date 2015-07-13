<?php
namespace App\Domain\Shift;

use App\Data\Authenticator;
use App\Data\Mapper\ShiftMapper;
use App\Data\Paginate;
use Aura\Payload\Payload;
use Spark\Adr\DomainInterface;

class GetList implements DomainInterface
{

    protected $shifts;
    /**
     * @var ShiftMapper
     */
    protected $mapper;

    protected $auth;

    public function __construct(ShiftMapper $mapper, Authenticator $auth)
    {
        $this->mapper = $mapper;
        $this->auth   = $auth;
    }

    public function __invoke(array $input)
    {
        // Force a user to be able to use this.
        $this->auth->ensureLogin();

        $input += [
            'user_id' => false,
        ] + Paginate::$defaultOptions;

        $payload = new Payload();
        $payload->setStatus(Payload::FOUND);

        $output = [];

        $options = array_filter([
            'user_id' => $input['user_id'],
            'limit'   => $input['limit'], // TODO: Simplify this so I don't need to pass the vars somehow.
            'page'    => $input['page'],
        ]);

        list($shifts, $paginate) = $this->mapper->getShifts($options);

        $output['meta']['paginate'] = $paginate->getMeta();

        $output['shifts'] = $shifts;

        $payload->setOutput($output);

        return $payload;
    }
}