<?php

namespace App\Services;

use App\Http\Resources\SalesLeadResource;
use App\Models\Customer;
use App\Models\SalesLead;

class SalesLeadService
{
    public function store(array $salesLeadDetails)
    {
        $lead = SalesLead::create([
            'title' => $salesLeadDetails['title'],
            'message' => $salesLeadDetails['message'],
        ]);

        $tags = collect($salesLeadDetails['tags']);

        $formattedTag = $tags->map(function ($item) {
            return ['name' => $item];
        });

        $lead->tags()->createMany($formattedTag);

        return $lead;
    }

    public function update(array $salesLeadDetails, SalesLead $salesLead)
    {
        $salesLead->tags()->sync($salesLeadDetails['tags'], false);

        return new SalesLeadResource($salesLead);
    }
}
