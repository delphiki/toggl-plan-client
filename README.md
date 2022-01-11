# Toggl Plan API client

A simple PHP client for the [Toggl Plan API](https://developers.plan.toggl.com/api-v5.html).

## Installation

```shell
composer require delphiki/toggl-plan-client
```

## Usage

You must register an application to retrieve your client ID & secret: https://developers.plan.toggl.com/applications

```php
$togglPlanClient = new TogglPlanClient(
    'USERNAME',
    'PASSWORD',
    'CLIENT ID',
    'CLIENT SECRET',
);

$togglPlanClient->getMe();
// ...
```
