<?php

use Mr4Lc\JsonExporter\File;
use Mr4Lc\JsonExporter\Writer;

it('creates a full JSON file', function() {

    Writer::$SAVE = true;

    $file = new File('php://memory');
    $collection = $file->collection('users');

    for ($i = 0; $i < 10; $i++) {
        $item = [
            'name' => 'supun',
            'title' => 'Founder & CEO',
            'company' => 'Hyvor',
            'website' => 'https://supun.io'
        ];
        $item2 = [
            'name' => 'ishini',
            'title' => 'Designer & Marketer',
            'company' => 'Hyvor',
            'website' => null
        ];
        $collection->addItems([$item, $item2]);
    }

    $file->value('version', '1.0.0');

    $file->end();

    $json = json_decode($file->written(), true);

    expect($json['users'])->toBeArray();
    expect(count($json['users']))->toBe(20);
    expect($json['version'])->toBe('1.0.0');

});
