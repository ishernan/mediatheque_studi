<?php

namespace App\Classe;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DocsReservation
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function add($id)
    {
        $reservation = $this->session->get('reservation', []);

        if(!empty($reservation[$id])){ //une fois reservé il faut qu'ils ne soit plus dispo sur reservation pendant 3 jours.
            $reservation[$id]++;
        } else $reservation[$id] = 1;

        $this->session->set('reservation', $reservation);
    }

    public function get()
    {
        return $this->session->get('reservation');
    }

    public function remove()
    {
        return $this->session->remove('reservation');
    }

    public function remove_item($id){

        $reservation = $this->session->get('reservation', []);

        unset($reservation[$id]);

        return $this->session->set('reservation', $reservation);
    }

}