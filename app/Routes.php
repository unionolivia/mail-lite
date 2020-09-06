<?php

declare(strict_types = 1);

return [
    [
        'POST', '/subs', 'App\Subscribers\SubscriberHandler#store'
    ],
    [
        'GET', '/subs', 'App\Subscribers\SubscriberHandler#index'
    ],
    [
        'GET', '/subs/{id:\d+}', 'App\Subscribers\SubscriberHandler#show'
    ],
    [
        'PATCH', '/subs/{id:\d+}', 'App\Subscribers\SubscriberHandler#update'
    ],
    [
        'DELETE', '/subs/{id:\d+}', 'App\Subscribers\SubscriberHandler#delete'
    ],
    [
        'GET', '/fields', 'App\Fields\FieldHandler#index'
    ],
    [
        'POST', '/fields', 'App\Fields\FieldHandler#store'
    ],
    [
        'GET', '/fields/{id:\d+}', 'App\Fields\FieldHandler#show'
    ],
    [
        'PATCH', '/fields/{id:\d+}', 'App\Fields\FieldHandler#update'
    ],
    [
        'DELETE', '/fields/{id:\d+}', 'App\Fields\FieldHandler#delete'
    ],
    [
        'POST', '/sub-fields', 'App\Subfields\SubfieldHandler#store'
    ],
    [
        'GET', '/sub-fields', 'App\Subfields\SubfieldHandler#index'
    ],
];
