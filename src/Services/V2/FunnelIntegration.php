<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class FunnelIntegration extends Service
{
    protected $uri = '/v2/funnelIntegration';

    public function create(array $data)
    {
        $this->post('/', $data);
    }

    public function delete(array $data)
    {
        $this->del('/', $data);
    }

    public function achieveGoal(int $contact_id, int $trigger_id, string $schema_data)
    {
        $this->post('/trigger', [
            'contact_id' => $contact_id,
            'funnel_integration_trigger_id' => (string) $trigger_id,
            'schema_data' => $schema_data,
        ]);
    }
}
