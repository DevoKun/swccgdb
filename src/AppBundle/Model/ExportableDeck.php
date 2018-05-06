<?php

namespace AppBundle\Model;

class ExportableDeck
{
    public function getArrayExport($withUnsavedChanges = false)
    {
        $slots = $this->getSlots();
        $agendas = $slots->getAgendas();
        $agendas_code = [];
        $agenda_urls = [];
        foreach ($agendas as $agenda) {
            $agendas_code[] = $agenda->getCard()->getCode();
            $agendas_urls[] = $agenda->getCard()->getImageUrl();
        }
        $array = [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'date_creation' => $this->getDateCreation()->format('c'),
            'date_update' => $this->getDateUpdate()->format('c'),
            'description_md' => $this->getDescriptionMd(),
            'user_id' => $this->getUser()->getId(),
            'side_code' => $this->getSide()->getCode(),
            'side_name' => $this->getSide()->getName(),
            'slots' => $slots->getContent(),
            'agendas' => $agendas_code,
            'agendaurls' => $agenda_urls,
            'version' => $this->getVersion(),
        ];

        return $array;
    }

    public function getTextExport()
    {
        $slots = $this->getSlots();
        return [
            'name' => $this->getName(),
            'version' => $this->getVersion(),
            'agendas' => $slots->getAgendas(),
            'side' => $this->getSide(),
            'draw_deck_size' => $slots->getDrawDeck()->countCards(),
            'plot_deck_size' => $slots->getPlotDeck()->countCards(),
            'included_packs' => $slots->getIncludedPacks(),
            'slots_by_type' => $slots->getSlotsByType()
        ];
    }
}
