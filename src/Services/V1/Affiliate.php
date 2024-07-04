<?php

namespace KeapGeek\Keap\Services\V1;

use KeapGeek\Keap\Services\Service;

class Affiliate extends Service
{
    protected $uri = '/v1/affiliates';

    public function list(array $data = [])
    {
        $list = $this->get('/', $data);

        return $list['affiliates'];
    }

    public function count(array $data = [])
    {
        $list = $this->get('/', $data);

        return (int) $list['count'];
    }

    public function find(int $id)
    {
        return $this->get("/$id");
    }

    public function create(string $code, int $contact_id, string $password,
        ?string $name = null,
        bool $notify_on_lead = true,
        bool $notify_on_sale = true,
        ?int $parent_id = null,
        bool $active = true,
        ?int $track_leads_for = null)
    {

        $status = $active ? 'active' : 'inactive';

        return $this->post('/', [
            'code' => $code,
            'contact_id' => $contact_id,
            'password' => $password,
            'name' => $name,
            'notify_on_lead' => $notify_on_lead,
            'notify_on_sale' => $notify_on_sale,
            'parent_id' => $parent_id,
            'status' => $status,
            'track_leads_for' => $track_leads_for,
        ]);
    }

    public function model()
    {
        return $this->get('/model');
    }

    public function commissions(array $data = [])
    {
        $this->switch('affiliate_id', 'affiliateId', $data);

        $this->parseDatetime('since', $data);
        $this->parseDatetime('until', $data);

        $data['order'] = 'DATE_EARNED';

        $list = $this->get('/commissions', $data);

        return $list['commissions'];
    }

    public function programs(array $data = [])
    {
        $list = $this->get('/programs', $data);

        return $list['programs'];
    }

    public function redirects(array $data = [])
    {
        $list = $this->get('/redirectlinks', $data);

        return $list['redirects'];
    }

    public function summaries(array $data = [])
    {
        $list = $this->get('/summaries', $data);

        return $list['summaries'];
    }

    public function clawbacks(int $affiliate_id, array $data = [])
    {
        $data['order'] = 'DATE_EARNED';

        $this->parseDatetime('since', $data);
        $this->parseDatetime('until', $data);

        $list = $this->get("/$affiliate_id/clawbacks", $data);

        return $list['clawbacks'];
    }

    public function payments(int $affiliate_id, array $data = [])
    {

        $this->parseDatetime('since', $data);
        $this->parseDatetime('until', $data);

        $list = $this->get("/$affiliate_id/payments", $data);

        return $list['payments'];
    }
}
