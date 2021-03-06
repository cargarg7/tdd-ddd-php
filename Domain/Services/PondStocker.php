<?php
namespace Domain\Services;
use Domain\Services\Pond;
use Domain\Entities\Fish;
/**
 * @author Brian Scaturro
 */
class PondStocker
{
    private $pond;

    public function __construct(Pond $pond)
    {
        $this->pond = $pond;
    }

    public function getPond()
    {
        return $this->pond;
    }

    public function stock($numNewFish)
    {
        $this->stockExisting();

        $i = 0;
        while($i < $numNewFish) {
            $this->pond->stock(new Fish());
            $i++;
        }
    }

    public function pondIsEmpty()
    {
        return $this->pond->getFishCount() == 0;
    }

    private function stockExisting()
    {
        $uncaught = $this->pond->getRepo()->all();
        foreach ($uncaught as $fish) {
            $this->pond->stock($fish);
        }
    }
}
