<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 29/06/2018
 * Time: 11:23
 */

namespace App\Demande;


use App\Entity\Demande;

class DemandeFactory
{
    public function createFromDemandeRequest(DemandeRequest $request): Demande
    {
        return new Demande(
            $request->getId(),
            $request->getTitle(),
            $request->getSlug(),
            $request->getContent(),
            $request->getFeaturedImage(),
            $request->getDateCongeDebut(),
            $request->getDateCongeFin(),
            $request->getCreatedDate(),
            $request->getUser(),
            $request->getStatus(),
            $request->getDays(),
            $request->getObservation(),
            $request->getIfEvenementFamilial(),
            $request->getJoursEvenementFamilial(),
            $request->getNatureEvenementFamilial(),
            $request->getDateEvenementFamilial(),
            $request->getIfCongePaye(),
            $request->getJoursCongePaye(),
            $request->getIfRtt(),
            $request->getMoisAcquisitionRtt(),
            $request->getIfCongeSansSolde(),
            $request->getJoursCongeSansSolde(),
            $request->getIfAutre(),
            $request->getJoursAutre(),
            $request->getJanvier(),
            $request->getFevrier(),
            $request->getMars(),
            $request->getAvril(),
            $request->getMai(),
            $request->getJuin(),
            $request->getJuillet(),
            $request->getAout(),
            $request->getSeptembre(),
            $request->getOctobre(),
            $request->getNovembre(),
            $request->getDecembre()
        );
    }
}