<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title inertia>{{ config('app.name', 'Laravel') }}</title>

  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

  @routes
  @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
  @inertiaHead
</head>

<body class="font-sans antialiased text-brand-dark-blue relative">
  @inertia
</body>

</html>
