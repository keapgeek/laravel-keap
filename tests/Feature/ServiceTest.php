<?php
use KeapGeek\Keap\Services\Service;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

beforeEach(function() {
    setTokens();
});
it('cashes get requests', function () {
    Http::fake([
        '*' => Http::response(['foo' => 'bar'], 200),
    ]);

    $service = new class extends Service {
        public function testGet() {
            $this->get();
        }
    };

    $service->testGet();
    expect(Cache::has('http_get_7537522503d2f1b7c461ef78c6687451'))->toBe(true);
});
